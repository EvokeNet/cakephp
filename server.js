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

  // socket.emit('popup', function (data) {
  // });

  //post_comments
  socket.on('like', function (data) {

    var now = new Date();
    var date = now.getFullYear()+'-'
            + ("0" + (now.getMonth()+1)).slice(-2) +'-'
            + ("0" + now.getDate()).slice(-2) +' '
            + ("0" + now.getHours()).slice(-2) +':'
            + ("0" + now.getMinutes()).slice(-2) +':'
            + ("0" + now.getSeconds()).slice(-2);

    redisPublishClient.hmset([
      "like_" + data.evidence_id + "_" + data.user_id, //key
      "user_id", data.user_id, 
      "user_name", data.user_name, 
      "user_pic_url", data.user_pic_url, 
      "evidence_id", data.evidence_id,
      'created', date,
      "modified", date, 
    ], function(err, reply){});

    redisPublishClient.lpush("likes_list_"+ data.evidence_id, "like_" + data.evidence_id + "_" + data.user_id, 
      function(err, reply){
        io.to(socket.id).emit('retrieve_likes', reply);
      });

    // redisPublishClient.llen(
    //   "likes_list_"+ data.evidence_id, 
    //   function (err, replies) {

    //     // var tag = '<li class="mine">'+data.user_name+": "+data.msg+'</li>';
    //     // var json = {tag:tag, replies:replies};
    //     io.sockets.emit('retrieve_likes', replies);
    // });

  });

  socket.on('unlike', function (data) {

    console.log('UNLIKE');

    redisPublishClient.lrem(
      "likes_list_"+ data.evidence_id, 0, "like_" + data.evidence_id + "_" + data.user_id,
      function (err, reply) {
        console.log('REPLY'+reply);

        redisPublishClient.llen(
          "likes_list_"+ data.evidence_id, 
          function (err, replies) {

            // var tag = '<li class="mine">'+data.user_name+": "+data.msg+'</li>';
            // var json = {tag:tag, replies:replies};
            io.to(socket.id).emit('retrieve_likes', replies);
        });

      }
    )

  });

  socket.on('get_likes', function (data) {
    redisPublishClient.lrange(
      "likes_list_"+ data.evidence_id, 0, -1,
      function (err, replies) {

        io.to(socket.id).emit('retrieve_likes', replies.length);

        var counter = 0;
        var tag = '';

        getTotal = function (callback) {

          console.log('YAAAAAAAY s');

          if(replies.length == 0){
            callback(tag);
            console.log('YAAAAAAAY s33');
          } else{
            console.log('YAAAAAAAY s12'+replies.length);
            replies.forEach(function (reply, i) {

                redisPublishClient.hgetall(reply, function (err, obj) {
                  // console.log('out');
                  // console.log(data.user_id === obj.user_id);
                  if(data.user_id === obj.user_id){
                    // console.log('inside');
                    // console.log(data.user_id === obj.user_id);
                    // console.log(data.user_id);
                    // console.log(obj.user_id);
                     // console.log("taaag"+tag);
                    
                    tag = obj.user_id;
                    callback(tag);  
                    return;
                  }
                  //callback(tag);
                  
              });
            });
          }
        }

        getTotal(function(tag) {
          console.log('YAAAAAAAY s2');
          // var json = {tag:tag, replies:replies.length};
          io.to(socket.id).emit('block_like', tag);
          // console.log("TASSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS"+tag);
        });


    });

  });

  // socket.on('check_likes', function (data) {
  //   redisPublishClient.lrange(
  //     "likes_list_"+ data.evidence_id, 0, -1,
  //     function (err, replies) {

  //       io.to(socket.id).emit('retrieve_likes', replies.length);

  //   });
  // });

  var mysql      = require('mysql');
  var connection = mysql.createConnection({
    host     : 'localhost',
    database : 'evoke',
    user     : 'root',
    password : '6907388'
  });

  connection.connect(function(err) {
    if (err) {
      console.error('error connecting: ' + err.stack);
      return;
    }
    console.log('connected as id ' + connection.threadId);
  });

  //post_comments
  socket.on('post_comment', function (data) {

    var now = new Date();
    var date = now.getFullYear()+'-'
            + ("0" + (now.getMonth()+1)).slice(-2) +'-'
            + ("0" + now.getDate()).slice(-2) +' '
            + ("0" + now.getHours()).slice(-2) +':'
            + ("0" + now.getMinutes()).slice(-2) +':'
            + ("0" + now.getSeconds()).slice(-2);

    console.log(date);

    var post  = { 
          evidence_id: data.evidence_id, 
          user_id: data.user_id, 
          content: data.msg,
          created: date,
          modified: date
    };

    var query = connection.query('INSERT INTO comments SET ?', post, function(err, result) {
      console.log(data.evidence_id);
      console.log(data.user_id);
      console.log(data.msg);
      console.log("comment id "+result.insertId);
      // cid = result.insertId;
      redisPublishClient.hmset([
        "comment_" + data.evidence_id + "_" + result.insertId, //key
        "user_id", data.user_id, 
        "user_name", data.user_name, 
        "user_pic_url", data.user_pic_url, 
        "evidence_id", data.evidence_id,
        'created', date,
        "modified", date, 
        "msg", data.msg 
      ], function(err, reply){});

      redisPublishClient.rpush("comments_list_"+ data.evidence_id, "comment_" + data.evidence_id + "_" + result.insertId, 
        function(err, reply){});

      redisPublishClient.llen(
        "comments_list_"+ data.evidence_id, 
        function (err, replies) {

          var tag = '<li class="mine">'+data.user_name+": "+data.msg+'</li>';
          var json = {tag:tag, replies:replies};
          io.sockets.emit('retrieve_comments', json);
      });

    });

  });

  socket.on('get_comments', function (data) {
    redisPublishClient.lrange(
      "comments_list_"+ data.evidence_id, 0, -1,
      function (err, replies) {

        console.log(replies.length);
        io.to(socket.id).emit('get_comments_count', replies.length);

        var counter = 0;
        var tag = '';
        replies.forEach(function (reply, i) {

            redisPublishClient.hgetall(reply, function (err, obj) {
            tag += '<li class="mine">'+obj.user_name+": msg "+obj.msg+' counter '+counter+'</li>';

            if(++counter === (replies.length)){
              var json = {tag:tag, replies:replies.length};
              io.to(socket.id).emit('retrieve_comments', json);
            }
          });
        });

    });
  });

  //post_comments
  socket.on('autosave_evidence', function (data) {

    console.log('WORK');

    var now = new Date();
    var date = now.getFullYear()+'-'
            + ("0" + (now.getMonth()+1)).slice(-2) +'-'
            + ("0" + now.getDate()).slice(-2) +' '
            + ("0" + now.getHours()).slice(-2) +':'
            + ("0" + now.getMinutes()).slice(-2) +':'
            + ("0" + now.getSeconds()).slice(-2);

    // console.log(date);

    var post  = { 
          user_id: data.user_id, 
          title: data.ititle,
          content: data.icontent,
          quest_id: data.quest_id,
          mission_id: data.mission_id,
          phase_id: data.phase_id,
          modified: date
    };

    // var query = connection.query('SELECT ?? FROM ?? WHERE id = ?', [*, 'evidences', userId], function(err, results) {
    //   // ...
    // });

    if(data.iid == ''){
      post.created = date;
      var query = connection.query('INSERT INTO evidences SET ?', post, function(err, result) {
        if (err) throw err;
        console.log(data.evidence_id);
        console.log(data.user_id);
        console.log(data.msg);
        console.log("comment id "+result.insertId);
        io.to(socket.id).emit('return_evidence_id', result.insertId);
      });
      console.log('iu');
    } else{
      var query = connection.query('UPDATE evidences SET ? WHERE id = ?', [post, data.iid], function(err, results) {
        console.log('HAHAHA');
      });
    }

  });

  //retrieve notfications from logged in user
  socket.on('get_notifications', function (data) {
    redisPublishClient.lrange(
      data.user_id+'_list_notifications', 0, 10,
      function (err, replies) {

        var counter = replies.length;
        var tag = '';
        replies.forEach(function (reply, i) {

            redisPublishClient.hgetall(reply, function (err, obj) {

            	var url = "/evoke/evidences/view/"+obj.entity_id;
            	tag += "<a href ="+url+">"+obj.action_user_name+' '+obj.entity_type+' your evidence '+obj.entity_title+'</a><br>';

            	if(--counter === 0){
            		io.to(socket.id).emit('retrieve_notifications', tag);
            	}
            	
          });
        });

    });
  });

  //retrieve notfications from logged in user
  socket.on('get_all_notifications', function (data) {
    redisPublishClient.lrange(
      data.user_id+'_list_notifications', 0, -1,
      function (err, replies) {

        var counter = replies.length;
        var tag = '';
        var last = '';
        replies.forEach(function (reply, i) {

            redisPublishClient.hgetall(reply, function (err, obj) {

            	var i2 = '';
            	var date = obj.timestamp.split(' ');

            	if(last !== date[0]){
            		i2 = '<br><div style = "color:white">'+obj.timestamp+'</div><br>';
            	}

            	var url = "/evoke/evidences/view/"+obj.entity_id;
            	// console.log('jiou'+obj.notification_id)
            	tag += i2+'<div style = "color:white; display:inline">'+date[1]+"</div>&nbsp;&nbsp;&nbsp;<a href ="+url+">"+obj.action_user_name+' '+obj.entity_type+' your evidence '+obj.entity_title+'</a><br>';

            	if(--counter === 0){
            		io.to(socket.id).emit('retrieve_all_notifications', tag);
            	}

            	last = date[0];
            	
          });
        });

    });
  });

  //on page reload, the client emits a message with its data
  //the serevr responds with total of notifications
  socket.on('reload', function (data) {
    //console.log(data.user_id);
    redisPublishClient.llen(
      data.user_id + '_new_notifications', 
      function (err, replies) {
        //console.log(replies);
        var msg = {total_msgs:replies}
        io.to(socket.id).emit('message', msg);
    });
  });

  //if bubble is clicked, the list is cleaned and a new one for notification history is created
  socket.on('history', function (data) {
    console.log('one');
    redisPublishClient.del(data.user_id + '_new_notifications', redis.print);
    redisPublishClient.llen(
      data.user_id + '_new_notifications', 
      function (err, replies) {
        console.log(replies);
        io.to(socket.id).emit('message', replies);
    });
  });

});

  /**
   * subscribe to redis channel when client in ready
   */
  redisSubscribeClient.on('ready', function() {
    redisSubscribeClient.subscribe('notif');
  });

  redisSubscribeClient.on('ready', function() {
    redisSubscribeClient.subscribe('notifs');
  });

  /**
   * wait for messages from redis channel, on message
   * send updates on the rooms named after channels. 
   * 
   * This sends updates to users. 
   */
  redisSubscribeClient.on("message", function(channel, message){
    // var resp = {'text': message, 'channel':channel}
    // io.sockets.in(channel).emit('message', message);
    var va = message.split(':');
    var m = '';
    if(va[1]){
    	m = {notification_id:va[1]};	
    	console.log('YAY'+m.notification_id);
    }
	else{
		m = {total_msgs:va[0]}
		console.log('NO'+va[0]);
	}

	io.sockets.in(channel).emit('message', m);
    
  });