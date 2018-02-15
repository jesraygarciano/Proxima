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

		var socket = io('http://192.168.10.10:3000');

		var $this = $(this);

		fetchChatables();

		socket.emit('client add',settings.auth_id);

		$this.find('.send_message').click(function(){
			socket.emit('s-p-m',{reciever:$(this).data('r-id'),msg:$this.find('.message-box').find('.box').val(), s_id:settings.auth_id});
			aMoMlS($this.find('.box').val());
			$this.find('.box').val('');
		});

		socket.on('r-p-m', function(data){
			// 
			if(data.s_id == $this.find('.send_message').data('r-id')){
				aMoMlR(data.msg)
			}
		});

		socket.on('connect',function(){
			// 
		});

		socket.on('disconnect', function () {
			// 
		});

		socket.on('reconnect', function () {
			if (username) {
			  socket.emit('add user', username);
			}
		});

		socket.on('reconnect_error', function () {
			// 
		});

		function fetchChatables(){
			$.ajax({
				url:settings.fetch_chatables_url,
				type:'GET',
				data:{user_id:settings.auth_id},
				success:function(data){
					for(var index in data.users){
						$this.find('.thread-list').append(
							'<div class="infoer">'
							+'	<img src="'+data.users[index].photo+'">'
							+'	<div class="text">'
							+'		<div class="title">'+data.users[index].name+'</div>'
							+'		<div class="description">latest message</div>'
							+'	</div>'
							+'</div>'
							);

						setThreadItemEvent($this.find('.thread-list .infoer:last-child'),data.users[index]);
					}
				}
			});
		}

		function setThreadItemEvent(elm, data){
			console.log(elm);
			elm.click(function(){

				console.log(elm)

				$.ajax({
					url:settings.fetch_user_messages_url,
					type:'GET',
					data:{'user_id':data.id},
					success:function(_data){

						$this.find('.message-box .r_name').html(data.name);
						$this.find('.message-box .r_picture').html(data.photo);

						for(var i = 0; i < _data.messages.length; i++)
						{
							if(_data.messages[i].user_id == settings.auth_id){
								aMoMlS(_data.messages[i].message);
							}
							else
							{
								aMoMlS(_data.messages[i].message);
							}
						}

						$this.find('.send_message').data('r-id',data.id);
					}
				});

			});
		}


		function aMoMlR(msg){
			$this.find('.message-list').append(
				'<div>'
				+'<div class="message-item">'
				+'	<img src="http://localhost:8000/img/member-placeholder.png">'
				+'	<div class="text">'
				+msg
				+'</div>'
				+'</div>'
				+'</div>'
				);

			$this.find('.message-list').scrollTop($this.find('.message-list').height());
		}

		function aMoMlS(msg){
			$this.find('.message-list').append(
				'<div>'
				+'<div class="message-item right">'
				+'	<img src="http://localhost:8000/img/member-placeholder.png">'
				+'	<div class="text">'
				+msg
				+'</div>'
				+'</div>'
				+'</div>'
				);

			$this.find('.message-list').scrollTop($this.find('.message-list').height());
		}
	}
})(jQuery)