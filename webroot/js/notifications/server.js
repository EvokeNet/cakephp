/** 
 * Sets up server
 */
var app = require('http').createServer(handler), 
    io = require('socket.io').listen(app), 
    fs = require('fs'), 
    redis = require("redis");


app.listen(8000);

/** 
 * Our redis client which subscribes to channels for updates
 */
redisClient = redis.createClient();

//look for connection errors and log
redisClient.on("error", function (err) {
    console.log("error event - " + redisClient.host + ":" + redisClient.port + " - " + err);
});

/**
 * Dummy redis client which publishes new updates to redis 
 */
redisDummyPublishClient = redis.createClient();

/**
 * http handler, currently just sends index.html on new connection
 */
function handler (req, res) {
  fs.readFile('index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html' + __dirname);
    }

    res.writeHead(200);
    res.end(data);
  });
}

/** 
 * set socket.io log level to warn
 *
 * uncomment below line to change debug level
 * 0-error, 1-warn, 2-info, 3-debug 
 *
 * For more options refer https://github.com/LearnBoost/Socket.IO/wiki/Configuring-Socket.IO
 */
//io.set('log level', 3);

/**
 * socket io client, which listens for new websocket connection
 * and then handles various requests
 */
io.sockets.on('connection', function (socket) {
  
  //on connect send a welcome message
  socket.emit('message', { text : 'Welcome!' });

  //on subscription request joins specified room
  //later messages are broadcasted on the rooms
  socket.on('subscribe', function (data) {
    socket.join(data.channel);
  });
});

/**
 * subscribe to redis channel when client in ready
 */
redisClient.on('ready', function() {
  redisClient.subscribe('notif');
});

/**
 * wait for messages from redis channel, on message
 * send updates on the rooms named after channels. 
 * 
 * This sends updates to users. 
 */
redisClient.on("message", function(channel, message){
    var resp = {'text': message, 'channel':channel}
    io.sockets.in(channel).emit('message', resp);
});

/**
 * Simulates publish to redis channels
 * Currently it publishes updates to redis every 5 seconds.
 */
setInterval(function() {
  var no = Math.floor(Math.random() * 100);
  redisDummyPublishClient.publish('notif', 'Generated random no ' + no);
}, 5000);

// var server = require('http').createServer(handler)
// var io = require('socket.io').listen(server);
// var fs = require('fs');

// server.listen(4000);

// var redis = require("redis");
// var client = redis.createClient();

// function handler (req, res) {
//   fs.readFile('index.html',
//   function (err, data) {
//     if (err) {
//       res.writeHead(500);
//       return res.end('Error loading index.html');
//     }

//     res.writeHead(200);
//     res.end(data);
//   });
// }

// // if you'd like to select database 3, instead of 0 (default), call
// // client.select(3, function() { /* ... */ });

// client.on("error", function (err) {
//     console.log("Error " + err);
// });

// client.set("string key", "string val", redis.print);
// client.hset("hash key", "hashtest 1", "some value", redis.print);
// client.hset(["hash key", "hashtest 2", "some other value"], redis.print);
// client.hkeys("hash key", function (err, replies) {
//     console.log(replies.length + " replies:");
//     replies.forEach(function (reply, i) {
//         console.log("    " + i + ": " + reply);
//     });
//     client.quit();
// });

// var app = require('http').createServer(handler)
// var io = require('socket.io').listen(app);
// var fs = require('fs');

// app.listen(4000);

// function handler (req, res) {
//   fs.readFile('index.html',
//   function (err, data) {
//     if (err) {
//       res.writeHead(500);
//       return res.end('Error loading index.html');
//     }

//     res.writeHead(200);
//     res.end(data);
//   });
// }

// io.on('connection', function (socket) {
//   socket.emit('news', { hello: 'world' });
//   // socket.emit('newbies', { what: 'sup' });

//   // socket.on('login', { what: 'sup' }); // para colocar a id do usuario no array
//   // socket.on('disconnect', { what: 'sup' });

//   socket.on('login',function() {
//     console.log('The client is logged!');
//   });

//   socket.on('connect',function() {
//     console.log('Client has connected to the server!');
//   });

//   socket.on('disconnect',function() {
//     console.log('The client has disconnected!');
//   });

//   socket.on('notification_from_server', function (data) {
//     console.log(data);
//   });
//   // socket.emit('notification_to_user', function (data) {
//   //   console.log(data);
//   // });
// });
