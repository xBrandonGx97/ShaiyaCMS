const socket = require('socket.io');
const express = require('express');
const http = require('http');

const app = express();
const server = http.createServer(app);

const io = socket.listen(server);
const port = 8080;

connections = [];

io.sockets.on('connection', function(client) {
  connections.push(client);
  console.log('Connected: %s sockets connected', connections.length);
  console.log('New client !');

  // Disconnect
  client.on('disconnect', function(data) {
    connections.splice(connections.indexOf(client), 1);
    console.log('Disconnected: %s sockets connected', connections.length);
  });

  client.on('message', function(data) {
    console.log('Message received ' + data.name + ':' + data.message);

    //client.broadcast.emit( 'message', { name: data.name, message: data.message } );
    io.sockets.emit('message', {
      name: data.name,
      message: data.message
    });
  });

  client.on('reg', function(data) {
    console.log('facts');

    io.sockets.emit('reg', '');
  });

  client.on('logout', function(data) {
    console.log('facts lmao');

    io.sockets.emit('logout', '');
  });
});

server.listen(port);
