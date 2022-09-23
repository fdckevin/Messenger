const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = require('socket.io')(server, {
    cors: {
        origin: '*',
    }
});


io.on('connection', (socket) => {
  
  socket.on('message', (msg) => {
    console.log('success: ' +msg);
    io.emit('receive-message', msg);
  });

  socket.on('join', (room) => {
    console.log('Joining room '+room);
    socket.join(room);
  });

  socket.on('reply', (room) => {
    console.log('Sending to room '+room);
    socket.to(room).emit('receive-reply', room);
  });

  socket.on('typing', (data) => {
   io.emit('receive-typing', data);
  });



});

server.listen(4000, () => {
    console.log('listening on *:4000');
});