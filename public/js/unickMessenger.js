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

		var $this = $(this);

		fetchChatables();

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

		$this.find('.search-box .button').click(function(){
			search_contacts($this.find('.search-box .box input').val());
		});

		$this.find('.search-box .box input').keydown(function(ev){
			if(ev.which == 13){
				search_contacts($this.find('.search-box .box input').val());
			}
		});

		$.socket.on('r-p-m', function(data){
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

		$.socket.on('user online', function(data){
			markOnline(data.id,true);
		});

		$.socket.on('user offline', function(data){
			markOnline(data.id,false);
			if($this.find('.send_message').data('r-id') == data.id){
				chatHeadOnline(false);
			}
		});

		$.socket.on('connect',function(){
			// 
		});

		$.socket.on('disconnect', function () {
			// 
		});

		$.socket.on('reconnect', function () {
			// if (username) {
			//   socket.emit('add user', username);
			// }
		});

		$.socket.on('reconnect_error', function () {
			// 
		});

		function sendMessage(){
			var messsage = $this.find('.message-box').find('.box').val();

			if(messsage.trim() != ""){
				$.socket.emit('s-p-m',{reciever:$this.find('.send_message').data('r-id'),msg:messsage, s_id:settings.auth_id});
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

				scrollBottomIfScrollBottom();
			}
		}

		function search_contacts(keyword){
			$this.find('.thread-list').html('<center><div class="loader"></div></center>');
			$.ajax({
				url:settings.search_contacts,
				type:"GET",
				data:{keyword:keyword},
				success:function(data){
					// 
					$this.find('.thread-list').html('');
					for(var index in data.contacts){
						$this.find('.thread-list').append(
							'<div class="infoer" data-id="'+data.contacts[index].id+'">'
							+'<div class="col pdd-5">'
							+'	<img src="'+data.contacts[index].photo+'"><div class="active-icon"></div>'
							+'</div>'
							+'<div class="col prio">'
							+'	<div class="text">'
							+'		<div class="title">'+data.contacts[index].name+'</div>'
							+'		<div class="description"></div>'
							+'	</div>'
							+'</div>'
							+'<div class="col pdd-5">'
							+'</div>'
							+'</div>'
							+'</div>'
							);

						setThreadItemEvent($this.find('.thread-list .infoer:last-child'),data.contacts[index]);
					}

					for(var index in data.recieved_request){
						$this.find('.thread-list').append(
							'<div class="infoer cursor-norm" cursor-norm data-id="'+data.recieved_request[index].id+'">'
							+'<div class="col pdd-5">'
							+'	<img src="'+data.recieved_request[index].photo+'"><div class="active-icon"></div>'
							+'</div>'
							+'<div class="col prio">'
							+'	<div class="text">'
							+'		<div class="title">'+data.recieved_request[index].name+'</div>'
							+'		<div class="description"></div>'
							+'	</div>'
							+'</div>'
							+'<div class="col pdd-5 add_bttn">'
							+'<button type="button" class="btn btn-warning btn-xs">Accept Contact</button>'
							+'</div>'
							+'</div>'
							+'</div>'
							);

						acceptRequestEvent($this.find('.thread-list .infoer:last-child'),data.recieved_request[index]);
					}

					for( var index in data.requested ){
						$this.find('.thread-list').append(
							'<div class="infoer cursor-norm" cursor-norm data-id="'+data.requested[index].id+'">'
							+'<div class="col pdd-5">'
							+'	<img src="'+data.requested[index].photo+'"><div class="active-icon"></div>'
							+'</div>'
							+'<div class="col prio">'
							+'	<div class="text">'
							+'		<div class="title">'+data.requested[index].name+'</div>'
							+'		<div class="description"></div>'
							+'	</div>'
							+'</div>'
							+'<div class="col pdd-5">'
							+'<button type="button" class="btn btn-default btn-xs">request sent</button>'
							+'</div>'
							+'</div>'
							+'</div>'
							);
					}

					for( var index in data.others ){
						$this.find('.thread-list').append(
							'<div class="infoer cursor-norm" data-id="'+data.others[index].id+'">'
							+'<div class="col pdd-5">'
							+'	<img src="'+data.others[index].photo+'"><div class="active-icon"></div>'
							+'</div>'
							+'<div class="col prio">'
							+'	<div class="text">'
							+'		<div class="title">'+data.others[index].name+'</div>'
							+'		<div class="description"></div>'
							+'	</div>'
							+'</div>'
							+'<div class="col pdd-5 add_bttn">'
							+'<button type="button" class="btn btn-primary btn-xs"><i class="fa fa-user-plus"></i></button>'
							+'</div>'
							+'</div>'
							+'</div>'
							);

						setRequestEvent($this.find('.thread-list .infoer:last-child'),data.others[index]);
					}

					if(data.contacts.length < 1 && data.requested < 1 && data.others < 1){
						$this.find('.thread-list').html('<div style="padding:5px; color:#808080;">No Result</div>');
					}
				}
			});
		}

		function setRequestEvent(elm, data){
			elm.find('.add_bttn .btn').click(function(){
				$.ajax({
					url:settings.request_contact,
					type:"POST",
					data:{contact_id:data.id},
					headers: { 'X-CSRF-TOKEN': settings.csrf_token },
					success:function(data){
						elm.find('.add_bttn').html('');
						elm.find('.add_bttn').append('<button type="button" class="btn btn-default btn-xs">request sent</button>');
					}
				});
			});
		}

		function acceptRequestEvent(elm, data){
			elm.find('.add_bttn .btn').click(function(){
				$.ajax({
					url:settings.accept_contact,
					type:"POST",
					data:{contact_id:data.id},
					headers: { 'X-CSRF-TOKEN': settings.csrf_token },
					success:function(_data){
						elm.find('.add_bttn').html('');
						elm.removeClass('cursor-norm');
						setThreadItemEvent(elm,data);

						elm.trigger('click');
					}
				});
			});
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
							'<div class="infoer" data-id="'+data.users[index].contact.id+'">'
							+'<div class="col pdd-5">'
							+'	<img src="'+data.users[index].contact.photo+'"><div class="active-icon"></div>'
							+'</div>'
							+'<div class="col prio">'
							+'	<div class="text">'
							+'		<div class="title">'+data.users[index].contact.name+'</div>'
							+'		<div class="description"></div>'
							+'	</div>'
							+'</div>'
							+'<div class="col pdd-5">'
							+'</div>'
							+'</div>'
							+'</div>'
							);

						setThreadItemEvent($this.find('.thread-list .infoer:last-child'),data.users[index].contact);
					}

					for(var index in data.recieved_request){
						$this.find('.thread-list').append(
							'<div class="infoer cursor-norm" cursor-norm data-id="'+data.recieved_request[index].user.id+'">'
							+'<div class="col pdd-5">'
							+'	<img src="'+data.recieved_request[index].user.photo+'"><div class="active-icon"></div>'
							+'</div>'
							+'<div class="col prio">'
							+'	<div class="text">'
							+'		<div class="title">'+data.recieved_request[index].user.name+'</div>'
							+'		<div class="description"></div>'
							+'	</div>'
							+'</div>'
							+'<div class="col pdd-5 add_bttn">'
							+'<button type="button" class="btn btn-warning btn-xs">Accept Contact</button>'
							+'</div>'
							+'</div>'
							+'</div>'
							);

						acceptRequestEvent($this.find('.thread-list .infoer:last-child'),data.recieved_request[index].user);
					}

					if(data.recieved_request.length < 1 && data.users.length < 1){
						$this.find('.thread-list').html('<div style="padding:5px; color:#808080;">You don\'t have any contact at the moment.<p> Please add contact first. </p></div>')
					}

					loading = false;

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

				chatHeadOnline($this.find('.infoer[data-id='+data.id+']').hasClass('online'));

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
			$.socket.emit('fetch online',{},function(data){
				console.log(data);
				for(var index in data){
					markOnline(data[index],true);
				}

				$this.find('.thread-list .infoer:first-child').trigger('click');
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
						success:function(data){
							$.socket.emit('p-m-snn',{s_id:$this.find('.send_message').data('r-id'), reciever:settings.auth_id});
						}
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