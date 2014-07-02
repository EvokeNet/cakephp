var app = require('http').createServer(handler)
var io = require('socket.io').listen(app);
var fs = require('fs');

app.listen(4000);

function handler (req, res) {
  fs.readFile('index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

io.on('connection', function (socket) {
  socket.emit('news', { hello: 'world' });
  // socket.emit('newbies', { what: 'sup' });

  // socket.on('login', { what: 'sup' }); // para colocar a id do usuario no array
  // socket.on('disconnect', { what: 'sup' });

  socket.on('login',function() {
    console.log('The client is logged!');
  });

  socket.on('connect',function() {
    console.log('Client has connected to the server!');
  });

  socket.on('disconnect',function() {
    console.log('The client has disconnected!');
  });

  socket.on('notification_from_server', function (data) {
    console.log(data);
  });
  // socket.emit('notification_to_user', function (data) {
  //   console.log(data);
  // });
});
