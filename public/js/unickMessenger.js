// Uelmar Ortega author
// Feb. 14, 2018
// this is a messaging app; implementing redis socket.io

(function(){
	$.fn.unickMessenging = function(options){
		var settings = $.extend({
			fetch_user_messages_url:false,
			fetch_chatables_url:false,
			auth_id:false
		},options);

		var loading = false;

		var socket = io('http://192.168.10.10:3000');

		var $this = $(this);

		fetchChatables();

		socket.emit('client add',settings.auth_id);

		$this.find('.send_message').click(function(){
			sendMessage();
		});

		$this.find('.message-box').find('.box').keydown(function(ev){
			if(ev.which == 13){
				sendMessage();
			}
		});

		$this.find('.message-box').click(function(){
			// 
			seenUnseenMessages();
		});

		socket.on('r-p-m', function(data){
			// 
			var scrollHeight = $this.find(".message-list")[0].scrollHeight;
			var height = $this.find(".message-list").height();

			scroll_bottom = $this.find('.message-list').scrollTop() == (scrollHeight - height);



			if(data.s_id == $this.find('.send_message').data('r-id') && !loading){

				aMoMlR({message : data.msg, formated_date:returnFormated(new Date())});

				if(scroll_bottom)
				{
					scrollBottomIfScrollBottom();
				}
			}

			indecateUnseenThreads(data,data.s_id == $this.find('.send_message').data('r-id') && scroll_bottom && !loading);

			console.log(data.socket);
		});

		socket.on('user online', function(data){
			markOnline(data.id,true);
		});

		socket.on('user offline', function(data){
			markOnline(data.id,false);
			if($this.find('.send_message').data('r-id') == data.id){
				chatHeadOnline(false);
			}
		});

		socket.on('connect',function(){
			// 
		});

		socket.on('disconnect', function () {
			// 
		});

		socket.on('reconnect', function () {
			// if (username) {
			//   socket.emit('add user', username);
			// }
		});

		socket.on('reconnect_error', function () {
			// 
		});

		function sendMessage(){
			var messsage = $this.find('.message-box').find('.box').val();

			if(messsage.trim() != ""){
				socket.emit('s-p-m',{reciever:$this.find('.send_message').data('r-id'),msg:messsage, s_id:settings.auth_id});
				aMoMlS({message:messsage, formated_date: returnFormated(new Date()) });
				$this.find('.message-box').find('.box').val('');

				$.ajax({
					url:settings.save_message_url,
					type:'POST',
					data:{reciever:$this.find('.send_message').data('r-id'), message: messsage},
					headers: { 'X-CSRF-TOKEN': settings.csrf_token },
					success:function(data){
						// say something
					}
				});
			}

			scrollBottomIfScrollBottom();
		}

		function indecateUnseenThreads(data,focused){
			var infoer = $this.find('.thread-list .infoer[data-id='+data.s_id+']');

			if(infoer.length > 0){
				if(!focused)
				{
					infoer.addClass('unseen');
				}

				infoer.find('.description').html(data.msg);
			}
		}

		function fetchChatables(){
			$this.find('.thread-list').html('<center><div class="loader"></div></center>');
			loading = true;
			$.ajax({
				url:settings.fetch_chatables_url,
				type:'GET',
				data:{user_id:settings.auth_id},
				success:function(data){
					$this.find('.thread-list').html('');
					for(var index in data.users){
						$this.find('.thread-list').append(
							'<div class="infoer" data-id="'+data.users[index].id+'">'
							+'	<img src="'+data.users[index].photo+'"><div class="active-icon"></div>'
							+'	<div class="text">'
							+'		<div class="title">'+data.users[index].name+'</div>'
							+'		<div class="description">latest message</div>'
							+'	</div>'
							+'</div>'
							);

						setThreadItemEvent($this.find('.thread-list .infoer:last-child'),data.users[index]);
					}

					loading = false;

					$this.find('.thread-list .infoer:first-child').trigger('click');

					fetchOnlines();
				}
			});
		}

		function scrollBottomIfScrollBottom(){

			var scrollHeight = $this.find(".message-list")[0].scrollHeight;
			var height = $this.find(".message-list").height();

			$this.find('.message-list').scrollTop(scrollHeight - height);
		}

		function setThreadItemEvent(elm, data){
			elm.click(function(){

				loading = true;

				elm.removeClass('unseen');
				$this.find('.message-list').html('<br><br><center><div class="loader"></div></center>');
				$this.find('.message-box .r_name').html(data.name);
				$this.find('.message-box .r_picture').html(data.photo);
				$this.find('.thread-list .infoer').removeClass('active');

				chatHeadOnline(data.id,$this.find('.infoer[data-id='+data.id+']').hasClass('online'));

				$(this).addClass('active');
				$.ajax({
					url:settings.fetch_user_messages_url,
					type:'GET',
					data:{'reciever':data.id},
					success:function(_data){
						$this.find('.message-list').html('');
						for(var i = 0; i < _data.messages.length; i++)
						{
							if(_data.messages[i].user_id == settings.auth_id){
								aMoMlS(_data.messages[i]);
							}
							else
							{
								aMoMlR(_data.messages[i]);
							}
						}

						loading = false;

						$this.find('.send_message').data('r-id',data.id);

						scrollBottomIfScrollBottom();

						$this.find('.message-box').find('.box').focus();

						seenUnseenMessages();
					}
				});

			});
		}

		function fetchOnlines(){
			socket.emit('fetch online',{},function(data){
				console.log(data);
				for(var index in data){
					markOnline(data[index],true);
				}
			});
		}

		function markOnline(id,bol){
			if(bol)
			{
				$this.find('.infoer[data-id='+id+']').addClass('online');
				if($this.find('.send_message').data('r-id') == id){
					chatHeadOnline(true);
				}
			}
			else
			{
				$this.find('.infoer[data-id='+id+']').removeClass('online');
			}
		}

		function chatHeadOnline(online){
			if(online){
				$this.find('.message-box .header').addClass('active');
				$this.find('.status_text').html('Online');
			}
			else
			{
				$this.find('.message-box .header').removeClass('active');
				$this.find('.status_text').html('Offline');
			}
		}

		function seenUnseenMessages(){

			if($this.find('.not-seen').length > 0)
			{
				var scrollHeight = $this.find(".message-list")[0].scrollHeight;
				var height = $this.find(".message-list").height();

				scroll_bottom = $this.find('.message-list').scrollTop() == (scrollHeight - height);

				if($this.find('.message-box').find('.box').is(':focus') && scroll_bottom){
					$.ajax({
						url:settings.mark_message_seen,
						type:"POST",
						headers: { 'X-CSRF-TOKEN': settings.csrf_token },
						data:{reciever:$this.find('.send_message').data('r-id')},
						success:function(data){}
					});
				}
			}
		}

		function aMoMlS(data){

			$this.find('.message-list').append(
				'<div>'
				+'<div class="message-item right">'
				+'	<img src="http://localhost:8000/img/member-placeholder.png">'
				+'<span class="date_sent">'
				+data.formated_date
				+'</span>'
				+'	<div class="text">'
				+data.message
				+'</div>'
				+'</div>'
				+'</div>'
				);

			seenUnseenMessages();
		}

		function aMoMlR(data){
			$this.find('.message-list').append(
				'<div>'
				+'<div class="message-item not-seen">'
				+'	<img src="http://localhost:8000/img/member-placeholder.png">'
				+'	<div class="text">'
				+data.message
				+'</div> '
				+'<span class="date_sent">'
				+data.formated_date
				+'</span>'
				+'</div>'
				+'</div>'
				);
		}

		var months = [
			'Jan.',
			'Feb.',
			'Mar.',
			'Apr.',
			'May.',
			'Jun.',
			'Jul.',
			'Aug.',
			'Sep.',
			'Oct.',
			'Nov.',
			'Dec.',
		];

		function returnFormated(date){
			var result = months[date.getMonth()]+' '+date.getUTCDate()+', '+date.getUTCFullYear()+' '+(date.getHours() > 12 ? date.getHours() - 12 : date.getHours())+':'+date.getMinutes()+(date.getHours() > 11 ? 'pm' : 'am')
			return result;
		}
	}
})(jQuery)