/*
	establishing connections
*/
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

/*
	instantiating database 
*/
var redis = require("redis");
var client = redis.createClient();

/*
	catching error event on redis
*/
client.on("error", function (err) {
    console.log("Error " + err);
});


/*
	Basic counter to control amount of users online
*/
var online = 0;


/*
	online users
	users[user id] stores a json with the following
		- socket_id: the socket id of that user's connection
		- user_id: user's id from the application
		- username: user's name from the application
*/
var users = {};


/*
	online group/custom chats
	groupchats[customX] stores basic info of group chat X
	groupchats[groupX] stores basic info of group chat X
*/
var groupchats = {};

/*
	maps the online users to their groups
*/
var groupchats_users = {};

app.get('/', function(req, res){
  res.sendfile('index.html');
});


/*
	socket connection event
*/
io.on('connection', function(socket){
	// flushAll(); // used while in development, it erases all data

	/*
		Register function for the example work properly
		we make use of redis to save users names and password
	*/
	socket.on('register', function(usr){

		//checking if user exists
		//a hash is used, where the key is user:<username>, and the following fields exist:
		//username: <username>; password: <password>, name: <full name>
		client.hexists("user:"+usr.username, "username", function (err, reply) {
			//no matches found
			if(reply == 0) {
				// console.log("[SUCCESS] Registering user " + usr.username + " to database.");

				//create user with data provided
				client.hmset([
					"user:"+usr.username, //key
					"username", usr.username, //username field
					"name", usr.name, //name field
					"password", usr.password //password field
				], function(err, reply){});

				//add this user in the set of users to track all registered users
				client.sadd("users", "user:"+usr.username, function(err, reply){});


				//let him know everything is ok
				var data = {
					success: true,
				}

				io.to(socket.id).emit('registration', data);
			} else {
				// console.log("[FAILED] User " + usr.username + " already exists, second registration not allowed.");

				//oops, username already exists
				//let him know something went wrong
				var data = {
					success: false,
				}

				io.to(socket.id).emit('registration', data);
			}
		});
	});	


	/*
		Check to see if user data is correct and if so, log him in
		by inserting his data in the online users array
	*/
	socket.on('login', function(usr){
		//check if user data is correct
		client.hmget("user:"+usr.username, "username", "password", "name", function (err, reply) {
			if(reply[0] == null) {
				//nothing was found, which means this username isnt registered
				// console.log("[FAILED] Username "+ usr.username +" not found in database, please register.");

				//let him know something went wrong while loggin in
				var data = {
					success: false,
				}

				io.to(socket.id).emit('loginStatus', data);
			} else {
				if(reply[1] == usr.password) {
					//he's good to go, allow him into the online users array
					users[usr.username] = {
						socket_id: socket.id,
						username: usr.username,
						name: reply[2],
					};

					//update number of online users
					online++;

					//writing on console just cause..
					// console.log("[SUCCESS] User "+usr.username+" is now online.");

					var data = {
						success: true,
						name: reply[2],
					}

					io.to(socket.id).emit('loginStatus', data);
				} else {
					//he exists, but the provided password did not match
					// console.log("[FAILED] Password for " + usr.username + " did not match");

					//let him know something went wrong while loggin in
					var data = {
						success: false,
					}
					io.to(socket.id).emit('loginStatus', data);
				}
			}
		});
	});


	/*
		register recently connected user's socket in one of its group/customs chat
	*/
	socket.on('loginGroup', function(data){

  		//treat custom chats and group chats separetly
  		//for they can have conflitant id's
  		var prefix = "group";
  		if(data.custom == 1){
  			prefix = "custom";
  		}

  		//check if group has already been registered
  		var key = prefix+data.group_id;
  		if(!(key in groupchats)) {
  			//register with basic info
  			groupchats[key] = {
  				id: data.group_id,
  				title: data.group_title,
  				custom: data.custom,
  			}

  			//defines the array where this
  			//group's users will be "stored"
  			groupchats_users[key] = [];

  			//for debugging purposes
  			// console.log("[SUCCESS] The chat group "+ data.group_title +" has been created.");
  		}

  		//for each group member
  		for(var i in data.members){
  			//maps current user to that group
  			groupchats_users[key][data.members[i]] = data.members[i];
  		}

  		//getting all groups registered
		var allgroups = getGroups();

		//broadcast groups list to all connected
		io.emit('allGroups', allgroups);
	});


	/*
		Leave group event
			"Unsubscribe" the user given by data.user from the data.group
			by losing it's reference in the group's members array
	*/
	socket.on('leaveGroup', function(data){
		//retrieve needed data
		var group_id = data.group;
		var user_id = data.user;

		//writing on console just cause..
		// console.log("[SUCCESS] The user " + users[user_id].username+" has left the chat group "+groupchats[group_id].title+".");

		//actually deleting him..
		delete groupchats_users[group_id][user_id];

		
		//updating groups info to users

		//getting all groups registered
		var allgroups = getGroups();

		//broadcast groups list to all connected
		io.emit('allGroups', allgroups);
	});


	/*
		Getting old messages from the chat conversation based on a time interval and messages limit
	*/
	socket.on('getOldMessages', function(data){
		var history = "";
		
		//gets all messages in the sorted set on that interval
		client.zrevrangebyscore(data.chat_id, data.startperiod, data.stopperiod, function (err, replies) {
		
			//auxiliar variables to help with the stop condition
			var counter = replies.length;
		    var k = 1;
		    var out = false;

		    //for each message..
		    for(var i in replies){
		    	//get its content in the hash
		    	client.hgetall(replies[i], function (err, obj) {
					
					//building up the history
					history = obj.content + history;

					//if we are done, send it back
				    if(!out && (--counter === 0 || k>=data.limit)){
	
				    	// console.log(history);

				    	//checking if there are no more old messages left
				    	var ended = false;
				    	if(counter == 0) ended = true;

				    	//setting up the JSON
						var hist = {
							chat: data.chat_id,
							messages: history,
							origin: data.origin,
							time: obj.timestamp -1,
							scroll: data.scroll,
							ended: ended,
						}

						//send the history to the requester 
						io.to(socket.id).emit('chatHistory', hist);
						out = true;
				    }
				    k++;
				});
		    }
		});
	});


	/*
		private message event
		receives a json with information regarding "target" user's id (to),
		origin user id (from) and content (msg)
	*/
	socket.on('privateMessage', function(data){
		//sends a chatmessage only to the correct socket
		var chat = {
			message: data.msg,
			sender: users[data.from].name,
			sender_id: data.from,
			origin: data.from,
		}
		
		//check if user is logged in before trying to emit to him
		if(data.to in users) {
			io.to(users[data.to].socket_id).emit('chatMessage', chat);
		} else {
			//add this message to the unseen list of this user
			client.sadd("unseen:"+data.to, 'userchat'+chat.origin, function(err, reply){});
		}
		
		//saving in database
		saveChatMessage(data.chat_id, data.msg, chat.sender, chat.sender_id, new Date().getTime());

		//spying on exchanged messages, NSA style
		//console.log("[SUCCESS] User " + chat.sender + " said to user " + users[data.to].name +": "+ chat.message);
	});


	/*
		group message event
		receives a json with information regarding "target" group's id,
		origin user id (from) and content (msg) and sends it to all,
		users in that group
	*/
	socket.on('groupMessage', function(data){
		//sends a chatmessage only to the correct sockets
		var chat = {
			message: data.msg,
			sender: users[data.from].name,
			sender_id: data.from,
			origin: data.group_id,
		}
		
		//by iterating through the group's members
		for(var i in groupchats_users[data.group_id]) {
			var member = groupchats_users[data.group_id][i];
			//make sure not to send to the sender
			if(member != data.from) {
				//make sure user is logged in
				if(member in users) {
					io.to(users[member].socket_id).emit('chatMessage', chat);
					//spying on exchanged messages, NSA style
					// console.log("[SUCCESS] User " + chat.sender + " said to user " + users[member].name +": "+ chat.message);
				} else {
					//he is off line, so it is necessary to add this conversation to the missed ones
					client.sadd("unseen:"+member, 'chat'+chat.origin, function(err, reply){});
				}
			}
		}

		//saving in database
		saveChatMessage(data.chat_id, data.msg, chat.sender, chat.sender_id, new Date().getTime());		
	});


	/*
		Upon client request, check for unseen messages in this users set of missed conversations
	*/
	socket.on('checkUnseenMessages', function(usr) {
		var unseen = [];
		//gets all lost conversations in this user's set
		client.smembers("unseen:"+usr.id, function (err, replies) {
			var counter = replies.length;
			for(var i in replies) {
				//for each found, add it to the return variable
				var tmp = {
					id: replies[i],
				}
				unseen.push(tmp);

				//after all elements, send it back
				if(--counter === 0){
					io.to(socket.id).emit('unseenMessages', unseen);
				}
			}
		});
	});


	/*
		Client has seen the lost message and asked to withdraw it from
		the database
	*/
	socket.on('markAsSeen', function(data) {
		client.srem("unseen:"+data.id, data.origin, function(err, reply){});
	});

	/*
		get all registered users (wont be need with the help of an outter database)
	*/
	socket.on('getAllUsers', function() {
		getAllUsers();
	});


	
	/*
		get all online groups and their socket ids
	*/
	socket.on('getOnlineGroups', function(){
		//getting all groups registered
		var allgroups = getGroups();

		//broadcast groups list to all connected
		io.emit('allGroups', allgroups);
	});


	/*
		capture socket disconnect event and remove it from 
		the current online users list
	*/
	socket.on('disconnect', function(reason) {
      	//check if he had already "logged in"
      	var position = getUserId(socket.id);

      	//if not, nevermind
      	if(position == -1) 
      		return;

      	//writing on console just cause..
      	// console.log("[DISCONNECT] User "+users[position].name +' has disconnected due to '+reason+'.');
      	
      	//if so, get his record out of the online users array and 
      	//decrease counter of online users
      	delete users[position];
      	online--;
      	
      	//update online users list to rest of users
      	getAllUsers();
   });
});


/*
	defines the port in which node will be listening 
	and sockets will connect
*/
http.listen(3000, function(){
	console.log('listening on *:3000');
});


/*
	basic function to retrive user id based on his 
	socket info
*/
function getUserId(socket_id) {
	for (var i in users) {
		if(socket_id == users[i].socket_id)
			return i;
	}
	return -1;
}


/*
	Retrieves a list o all users registered and whether or not they are logged in
*/
function getAllUsers(){
	var allusers = [];

		//gets all users in the "users" set
		client.smembers("users", function (err, replies) {
		
			//auxiliar variables to help with the stop condition
			var counter = replies.length;
		    
		    //for each message..
		    for(var i in replies){
		    	//get user content in the hash
		    	client.hgetall(replies[i], function (err, obj) {
					
					var online = false;
					//check if he is online
					if(obj.username in users)
						online = true;

					//build up the users array
					var tmp = {
						id: obj.username,
						name: obj.name,
						online: online,
					}
					allusers.push(tmp);

					//if we are done, send it back
				    if(--counter === 0){
				    	
				    	//send the array of all registered users to the client
						io.emit('allUsers', allusers);
				    }
				});
		    }
		});
}


/*
	retrieves all groups registered in array in json objects
*/
function getGroups(){
	//writing on console just cause..
	// console.log("[INFO] Online groups:");
		
	//this will return an array filled with json objects (the current online groups)
	var allgroups = [];
	for (var i in groupchats) {
		var members = {};
		//getting group's members
		for(var j in groupchats_users[i]) {
			members[groupchats_users[i][j]] = groupchats_users[i][j];
		}

		//for now, group's id and name are enough
		var tmp = {
			id: i,//groupchats[i].id,
			title: groupchats[i].title,
			members: members
		}
		allgroups.push(tmp);

		//writing on console just cause..
		// console.log("-> "+tmp.title);
		//debuging group's members
		// for(var j in groupchats_users[i])
			// console.log("->-> "+groupchats_users[i][j]);
	}
	return allgroups;
}


/*
	Function to save the message on redis
		all it takes is the chat id, the message itself, author and time information
*/
function saveChatMessage(chat_id, message, author, author_id, timestamp){
	//we are saving the message already formated
	var content = "<li class='"+author_id+"'>"+author+": "+message+"</li>";
	
	//saving a multiple-field hash with the content
	//the key is formed by the chat_id and the timestamp!
	client.hmset([chat_id+":"+timestamp, "author", author, "author_id", author_id, "content", content, "timestamp", timestamp], function(err, reply){});

	//storing the previous hash key to a sorted set
	//were the message's timestamp will work as the score of such element
	client.zadd([chat_id, timestamp, chat_id+":"+timestamp], function(err, reply){});
}


/*
	clears everything on database
*/
function flushAll() {
	client.flushall();
}