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
redisSubscribeClient = redis.createClient();

//look for connection errors and log
redisSubscribeClient.on("error", function (err) {
    console.log("error event - " + redisSubscribeClient.host + ":" + redisSubscribeClient.port + " - " + err);
});

/**
 * Dummy redis client which publishes new updates to redis 
 */
redisPublishClient = redis.createClient();

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
  // socket.emit('message', { text : 'Welcome!' });

  //on subscription request joins specified room
  //later messages are broadcasted on the rooms
  socket.on('subscribe', function (data) {
    socket.join(data.channel);
  });

  //on page reload, the client emits a message with its data
  //the serevr responds with total of notifications
  socket.on('reload', function (data) {
    //console.log(data.user_id);
    redisPublishClient.llen(
      data.user_id + '_new_notifications', 
      function (err, replies) {
        //console.log(replies);
        io.to(socket.id).emit('message', replies);
    });
  });

  //if bubble is clicked, the list is flushed and a new one for history created
  socket.on('history', function (data) {
    console.log('one');
    redisPublishClient.del(data.user_id + '_new_notifications', redis.print);
    redisPublishClient.llen(
      data.user_id + '_new_notifications', 
      function (err, replies) {
        console.log(replies);
        io.to(socket.id).emit('message', replies);
    });
    // redisPublishClient.llen(
    //   data.user_id + '_new_notifications', 
    //   function (err, replies) {
    //     console.log(replies);
    //     //redisPublishClient.ltrim(data.user_id + '_new_notifications', 0, replies-1);
    //     redisPublishClient.del(data.user_id + '_new_notifications');
    //     io.to(socket.id).emit('message', replies);
    //     console.log(replies);
    // });
  });

});

/**
 * subscribe to redis channel when client in ready
 */
redisSubscribeClient.on('ready', function() {
  redisSubscribeClient.subscribe('notif');
});

/**
 * wait for messages from redis channel, on message
 * send updates on the rooms named after channels. 
 * 
 * This sends updates to users. 
 */
redisSubscribeClient.on("message", function(channel, message){
  var resp = {'text': message, 'channel':channel}
  io.sockets.in(channel).emit('message', message);
});

/**
 * Simulates publish to redis channels
 * Currently it publishes updates to redis every 5 seconds.
 */

// setInterval(function() {
//   var no = Math.floor(Math.random() * 100);
//   redisPublishClient.publish('notif', 'Generated random no ' + no);
// }, 5000);

