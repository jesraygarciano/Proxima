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

    socket.on('client add', function(data){
        clients.push({socket:socket, id:data});
    });

    socket.on('disconnect', function(){
        console.log('user disconnected');
    });

    handlePrivateMessage(socket);
});

function handlePrivateMessage(socket){
    socket.on('s-p-m',function(data,cb){
        console.log(data);
        console.log(clients);
        for(var index in clients){
            console.log(clients[index]);
            if(clients[index].id == data.reciever){
                clients[index].socket.emit('r-p-m',data);
            }
        }
    });
}