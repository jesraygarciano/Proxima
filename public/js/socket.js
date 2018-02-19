// Uelmar Ortega Auth
// Feb. 14, 2018

var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('test-channel', function(err, count) {
	console.log(err);
	console.log(count);
});

redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(3000, function(){
    console.log('Listening on Port 3000');
});


// vars
var clients = [];

io.on('connection', function(socket){
    console.log('a user connected');

    handlePrivateMessage(socket);
    hadleOnlineStatus(socket);
});

function handlePrivateMessage(socket){
    socket.on('s-p-m',function(data,cb){
        console.log(data);
        for(var index in clients){
            console.log(clients[index].user_id);
            if(clients[index].user_id == data.reciever){
                console.log('message sent');
                clients[index].emit('r-p-m',data);
            }
        }
    });
}

function hadleOnlineStatus(socket){
    socket.on('is online ?',function(data,cb){
        var online = false;
        for(var index in clients){
            if(clients[index].user_id == data.reciever){
                online = true;
            }
        }

        cb(online);
    });

    socket.on('client add', function(data){
        socket.user_id = data;
        clients.push(socket);
        console.log('user online : '+data);

        socket.broadcast.emit('user online',{id:socket.user_id});
    });

    socket.on('fetch online', function(data,cb){
        var client_ids = [];

        for(var index in clients){
            client_ids.push(clients[index].user_id);
        }

        cb(client_ids);

    });

    socket.on('disconnect',function(){

        var still_connected = false;

        for(var index in clients){
            console.log(clients[index].id);
            if(clients[index] == socket)
            {
                console.log(clients[index].id + ' ---'+ socket.id);

                console.log('a socket has been removed');
                clients.splice(index, 1);
            }
        }

        // check if user has remaining sockets
        for(var index in clients){
            if(clients[index].user_id == socket.user_id){
                still_connected = true;
            }
        }

        if(!still_connected){
            socket.broadcast.emit('user offline',{id:socket.user_id});
            console.log('user disconnected : '+socket.user_id)

        }

    });
}