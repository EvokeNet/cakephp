
    <style>
        /*body {overflow: hidden;}*/
        /*#chatform { position: fixed; bottom: 0;}*/
        /*.chat input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
        .chat button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }*/
        #messages { list-style-type: none; margin: 0; padding: 0; }
        #messages li { padding: 5px 10px; }
        /*#right {position: fixed; top: 50px; right: 0; overflow-y: auto}*/
        #right ul {list-style-type: none;}
        #content {overflow-y: auto;}
        .mine { background: #eee; }
        .user { cursor: pointer;}
        .new { color: #F00 !important;}
        .current { color: #666 !important;}
        .user:hover {color: #666;}
        .group {display: none;}
        /*#title {background-color: #b6edff; width: 100%;}*/
        input {height: 3vw;}
        /* OVERRIDES STANDARD ROW WIDTH */
        .row.full-width-alternate {
            width: 100%;
            max-width: 100%;
        }
    </style>

    <!-- using to make it shine -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- NEEDS THE SERVER'S ADDRESS -->
    <!-- <link rel="stylesheet" type="text/css" href="http://localhost/ultrachatfromhellwithlasers/css/foundation.min.css"> -->
    <link rel="stylesheet" type="text/css" href="http://localhost/evoke/webroot/components/foundation/css/foundation.css">

  <!-- needed to use socket io -->
  <!-- <script src="/socket.io/socket.io.js"></script> -->
  <!-- <script src="http://localhost:3000/socket.io/socket.io.js"></script> -->
  <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

  <!-- using to make it shine -->
  <!-- NEEDS THE SERVER'S ADDRESS -->
  <script src="http://localhost/evoke/webroot/components/foundation/js/foundation.min.js"></script>
  <script src="http://localhost/evoke/webroot/components/jquery.cookie/jquery.cookie.js"></script>

  
    <div id="pre" class="row">
        <!-- <div class="large-12 medium-12 columns text-center">
            <div id="welcomediv" class="panel callout radius">
                <br>
                <br>
                <br>
                <form id="loginform">
                    <i class="fa fa-comments fa-5x"></i>
                    <h1>Welcome to Quantica Chat!</h1>
                    <h4>Please, enter you username and password.</h4>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p id="uh-oh" class="new" style="display:none;">The combination username/password did not match, please register or try again..</p>
                    <div class="row collapse">
                        <div class="large-3 large-centered columns text-left">
                            <input type="text" id="name" autocomplete="off" placeholder="username" />
                        </div>
                    </div>
                    <div class="row collapse">
                        <div class="large-3 large-centered columns text-left">
                            <input type="password" id="password" placeholder="password" />
                        </div>
                    </div>
                    <div class="row">
                        <button class="button large-3 large-centered columns">Start chating!</button>                       
                    </div>
                    <div class="row collapse">
                        <div class="large-3 large-centered columns text-right">
                            <a id="registrationLink" data-reveal-id="registration">sign up to the fun!</a>
                        </div>
                    </div>
                </form>
                
                

                <div id="registration" class="reveal-modal tiny" data-reveal>
                    <div class="large-12 medium-12 columns text-center">
                        <h3>Wanna be a part of it? Awesome!</h3>
                        <p>Please, tell us a thing or two about ya</p>

                        <p class="new" id="err" style="display:none">Username is already registered, please pick another username!</p>
                        <form id="registrationform">
                            <div class="row collapse">
                                <div class="large-12 large-centered columns text-left">
                                    <label>Name
                                        <input type="text" id="registrationname" autocomplete="off" placeholder="Ninja da Silva" />
                                    </label>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="large-12 large-centered columns text-left">
                                    <label>Username
                                        <input type="text" id="registrationusername" autocomplete="off" placeholder="ninja" />
                                    </label>
                                </div>
                            </div>
                            <div class="row collapse">
                                <div class="large-12 large-centered columns text-left">
                                    <label>Password
                                        <input type="password" id="registrationpassword" placeholder="123456" />
                                    </label>  
                                </div>
                            </div>
                            <div class="row">
                                <button id="registrationsubmit" class="button large-12 large-centered columns">Register, beach!</button>                       
                            </div>
                        </form>
                    </div>
                    <a class="close-reveal-modal">&#215;</a>
                </div>

                <br>
                <br>
                <br>
            </div>
        </div> -->
    </div>
    <div id="pos" class="row full-width-alternate">
        <div id="main" class="large-12 columns">
            <div class="row">
                <div id="main" class="large-12 columns">
                    <div id="right" class="panel callout" style = "max-height:500px; min-height:500px">
                        <div class="row">
                            <div class="large-12 columns">
                                <!-- <a id="signout" href="#" class="button alert tiny" style="width: 100%"><i class="fa fa-sign-out fa-2x"></i></a> -->
                                <br>
                                <i class="fa fa-compress fa-2x"></i>
                                <br>
                                <br>
                                <a id="addgroup" class="button tiny" style="width: 100%"><i class="fa fa-users fa-2x"></i><br>Create a group chat</a>
                            </div>
                        </div>
                        <form class="group" id="groupform">
                            <div class="row">
                                <input id="title" placeholder="chat title.." autocomplete="off" class="large-12 columns" />
                            </div>
                            <div id="checkscontainer"></div>
                            <div class="row">
                                <div class=" large-12 columns">
                                    <ul class="button-group">
                                      <div class="row collapse">
                                        <li class="large-6 columns"><a id="addbutton" class="button tiny" style="width:100%">Save group</a></li>
                                        <li class="large-6 columns"><a id="cancel" class="button tiny alert" style="width:100%">Nevermind</a></li>
                                      </div>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <ul id="users"></ul>
                        <ul id="groups"></ul>
                    </div>

                    <!-- <div id="chattitle" class="panel callout text-center">Please, select a user or group to chat with..</div> -->
                    <div id="content" style = "max-height:300px; min-height:300px">
                        <ul id="messages"></ul>
                    </div>
                    <div id="chatcontainer">
                        <form class="chat" id="chatform">
                            <div class="row collapse">
                                <input id="m" class="large-10 medium-10 columns"  autocomplete="off" />
                                <button id="messagebutton" class="button large-2 medium-2 tiny columns" style="margin: 0; padding: 17px 0px;">Send&nbsp;&nbsp;&nbsp;<i class="fa fa-paper-plane "></i></button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- <div style = "display:hidden; width:100%; background-color:#eee"><i class="fa fa-expand fa-2x"></i></div> -->

        <div id="myModal" class="reveal-modal tiny" data-reveal>
            <h3>Which users would you like to add to this conversation, pal?</h3>
            <form id="adduserform">
                <div id="newcheckscontainer"></div>
                <div class="row">
                    <div class=" large-12 columns">
                        <ul class="button-group">
                            <div class="row collapse">
                                <li class="large-6 columns"><a id="newaddbutton" class="button tiny" style="width:100%">Add users</a></li>
                                <li class="large-6 columns"><a id="newcancel" class="button tiny alert" style="width:100%">Nevermind</a></li>
                            </div>
                        </ul>
                    </div>
                </div>
            </form>
            <a class="close-reveal-modal">&#215;</a>
        </div>
  
    
    <!-- where the magic happens! -->
    <!--<script src="http://localhost:3000/socket.io/socket.io.js"></script>-->

    <?php
        //echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
    ?>

    <script>
        /*
            Basic variables to hold user's username and password
            those will receive values via login form
        */
        var username = "";
        var password = "";
        var name = "";

        
        /*
            creates socket instance based on server configurations
            passing a url will indicate the localtion of the server you wish to connect to
            passing nothing as parameter will make the socket try to connect with it's own server
        */
        // var address = "http://localhost";
        // var socket = io(address);
        var socket = io.connect('http://localhost:3000');


        /*
            currentChat holds the id of the person you are current chatting with
            clicking on another person's name on the right side of the screen will
            change the current chat to the chat with that someone
        */
        var currentChat = 0;
        var currentChatId = "";
        var chatTime = [];
        var chatContent = [];


        /*
            controlling wether or not the current chat belongs to a group
        */
        var group = false;

        /*
            Trying to make sure no group will have identic id's
        */
        var nextgroupId = 0;

        /*
            as soon as the the page loads, get info of all users currently connected to the chat
        */
        $(function() {
            // adjusting height of messages content and sidebar
            contentHeight();

            //first, check if there are any cookies refering to user's id and password
            if($.cookie('username') !== undefined && $.cookie('password') !== undefined) {
                //if so, lets connect this mothafocka right away!
                username = $.cookie('username');
                password = $.cookie('password');

                var data = {
                    username: username,
                    password: password,
                }
                socket.emit('login', data);

                return;
            }
            //it seems that no cookies were found, so present him the form!

            //setting focus on username input
            setFocus($("#name"));

            //For test purposes, user will have to enter username and password to continue
            $("#pos").hide();

            for(var i in chatContent){
                chatContent[i] = "";
                chatTime[i] = 0;
            }
        });


        /*
            The signout button is clicked!
                destroy any trace of user data and refresh the page
        */
        $("#signout").click(function(){
            //destroy cookies
            $.removeCookie('username');
            $.removeCookie('password');

            //reseting some vars
            for(var i in chatContent){
                chatContent[i] = "";
                chatTime[i] = 0;
            }

            username = "";
            name = "";
            password = "";

            document.title = "Quantica Chat";

            location.reload();
        })


        /*
            login submitted, sending data to server
        */
        // $('#loginform').submit(function(){
        //     //load his username onto the variable
        //     username = "<?= $user['User']['username'] ?>";
        //     password = "<?= $user['User']['username'] ?>";

        //     //server will check for a user like him and, if correct, it will
        //     //"register" his socket (along with his info) on the server..
        //     var data = {
        //         username: username,
        //         password: password,
        //     }
        //     socket.emit('login', data);

        //     return false;
        // });

        $(document).ready(function(){
            //load his username onto the variable
            username = "<?= $user['User']['username'] ?>";
            password = "<?= $user['User']['username'] ?>";

            //server will check for a user like him and, if correct, it will
            //"register" his socket (along with his info) on the server..
            var data = {
                username: username,
                password: password,
            }
            socket.emit('login', data);

            return false;
        });
    

        /*
            Server's response from login attempt
        */
        socket.on('loginStatus', function(response) {
            if(response.success){
                //it's all good, the user exists and password is correct!
                //let him in

                //get his full name
                name = response.name;

                //hide the previous form and show him the magic of chat!
                $("#pre").hide();
                $("#pos").show();

                //let others know i've connected
                socket.emit('getAllUsers');

                //get all groups again -> now the ones im part of will be displayed to me
                socket.emit('getOnlineGroups');

                //setting page title with the name, just to make it shine
                document.title = name+"'s Chat";

                //sets focus on the chat input
                setFocus($("#m"));

                //setting style to get history msgs
                $("<style type='text/css'> ."+username+"{ background-color:#eee;} </style>").appendTo("head");

                //setting up cookies with users name and password
                $.cookie('username', username, { expires: 7 });
                $.cookie('password', password, { expires: 7 });
            } else {
                $("#pos").hide();

                //uh-oh, something's not right
                $("#uh-oh").show();
            }
        });


        /*
            sending message mechanism
        */
        $('#messagebutton').click(function(){
            //if there's no chat selected
            if(currentChat == 0) {
                $('#messages').append($('<li class="new">').text("Please select a user to chat with..."));
                return false; 
            }

            //if there's nothing to say..
            if($("#m").val() == ""){
                return false;
            }

            //creating json with the contents of the message
            var data = {
                chat_id: currentChatId,
                from: username,
                to: currentChat,
                msg: $('#m').val(),
                group_id: 0
            }
            
            //user feedback to the sent message
            $('#messages').append('<li class="mine">'+name+": "+data.msg+'</li>');       
            
            //scrolling window to bottom
            goBottom();

            //maybe we should consider storing the conversation on a client-side variable..
            chatContent[currentChat] += "<li class='mine'>"+name+": "+data.msg+"</li>";

            if(group) {
                //it was a group chat 
                //actually sending the message
                data.group_id = currentChat;
                socket.emit('groupMessage', data);
            } else {
                //actually sending the message
                socket.emit('privateMessage', data);
            }

            //reseting input value
            $('#m').val('');

            //setting focus on chat input
            setFocus($("#m"));
            return false;
        });


        /*
            listening chatmessage event to display the recent messages
        */
        socket.on('chatMessage', function(chat){
            //checking to see if received message is from the current-chatting-with user
            if(currentChat == chat.origin){
                //if so, display it
                $('#messages').append('<li>'+chat.sender+": "+chat.message+'</li>');
                
                //scrolling window to bottom
                goBottom();
            } else {
                //else, let him know there are new messages and from whom they are
                var ref = "#userchat" + chat.sender_id;
                if(chat.origin != chat.sender_id) {
                    ref = "#chat" + chat.origin;
                }
                $(ref).addClass("new");
            }

            //again, we should store the conversation on a variable..
            chatContent[chat.origin] += "<li>"+chat.sender+": "+chat.message+"</li>";
        });


        /*
            Capturing the event from the server where the history of the 
            conversation is given
        */
        socket.on('chatHistory', function(data){
            //checking to see if user is still on the conversation of the 
            //requested history
            if(data.origin != currentChat) return;

            //if the history is definetely over, we set the
            //chatTime of this chat with -1 to flag it as over
            if(data.ended) 
                chatTime[data.origin] = -1;    
            else 
                //otherwise we set it with the next timestamp to further request for a history
                chatTime[data.origin] = data.time;
            
            //check if the content div is suppose to scroll
            if(data.scroll){
                //if so, it means user has just clicked on another user/group
                //so display the first batch of history messages and scroll
                $("#messages").html(data.messages);

                //and add them to the content
                chatContent[data.origin] = data.messages;

                //scrolling window to bottom..
                goBottom();
            } else {
                //if not, it means user requested history by scrolling up,
                //so we put the history messages above the ones he already had
                var newest = $("#messages").html();
                $("#messages").empty();
                $("#messages").html(data.messages);
                $("#messages").append(newest);

                //chat content now holds even more messages
                chatContent[data.origin] = $("#messages").html();
            }

        });


        /*
            Event triggered when the user scrolls the messages content div
                - send a request to the server to get older messages then
        */
        $('#content').scroll(function(e) {
            //if chatTime var is set with -1 it means that conversation has no more old messages
            if(chatTime[currentChat] == -1) return;

            //if he reached top
            var objDiv = document.getElementById("content");
            if(objDiv.scrollTop == 0) {
                //get more messages
                getPreviousMessages(false, chatTime[currentChat]);
            }
        });


        /*
            Upon the arrival of the notification that the user received messages while
            he was off, point him the origin of such messages
        */
        socket.on('unseenMessages', function(data) {
            for(var i in data){
                $("#"+data[i].id).addClass('new');
            }
        });


        /*
            When this is called, it will say to the server that this user
            has already seen the new messages from the 'origin' conversation
        */
        function markAsSeen(origin){
            var data = {
                id: username,
                origin: origin,
            }

            socket.emit('markAsSeen', data);
        }


        /*
            Auxiliar function to generate unique id's for each conversation.
            This won't be necessary with the backup of an outter database
        */
        function loadChatId(){
            //"fake" way of tracking the conversation id since we do not have,
            // for this example, an outside database
            currentChatId = "chat_";
            
            if(group){
                //if it's a group chat, the id of the conversation will be the group id
                currentChatId += currentChat;
            }else{
                //if it's a user-user chat, the id will be the concatenation of 
                //the users ids -> calling this function to make sure that
                //the order of the ids here wont be a problem
                //e.g. the user 1 and user 2 are chatting -> the conversation should be
                // chat_1_2 for both
                currentChatId += setChatId(username, currentChat);
            }
        }


        /*
            Function that requests the server for older messages of a specific conversation
        */
        function getPreviousMessages(scroll, startperiod){
            //loads the chat id in the CurrentChatId variable
            loadChatId();

            //setting up the JSON which will be passed as parameter to the server
            // -> startperiod is a milisec var that determines the start point from which the 
            //server will look for oler messages
            // -> limit is the max of messages to be retrieved at once
            // -> scroll is wether or not the content div should scroll down upon response
            var data = {
                chat_id: currentChatId,
                origin: currentChat,
                scroll: scroll,
                startperiod: startperiod,
                stopperiod: 0,
                limit: 30,
            }

            socket.emit('getOldMessages', data);

            return false;
        }

        
        /**/
        socket.on('allUsers', function(usrs){
            //reset the user list on the right
            $('#users').empty();

            for(var i in usrs) {
                //it doesn't make sense to display my own name, duh!
                if(usrs[i].id != username){
                    var paramid = "'"+usrs[i].id+"'";
                    var circle = '<i style="color: grey; font-size: 0.7em" class="fa fa-circle-o"></i>&nbsp;&nbsp;'
                    if(usrs[i].online){
                        circle = '<i style="color: green; font-size: 0.7em" class="fa fa-circle"></i>&nbsp;&nbsp;';
                    }

                    $('#users').append('<li id="userchat'+usrs[i].id+'" target_id='+usrs[i].id+' class="user" onclick="changeChat('+paramid+')">'+circle +usrs[i].name +'</li>');
                }
                
                //check to see if this key already exists in chatTime variable
                //which holds the timestamp of the 'min' range from the user usrs[i] with this one
                if(!(usrs[i] in chatTime)) {
                    chatTime[usrs[i].id] = 0;

                    //chat content holder
                    chatContent[usrs[i].id] = "";
                }
            }

            //sending request to check for unseen messages
            socket.emit('checkUnseenMessages', {id: username});
        });


        /*
            Changes the chat displayed in screen to the
            one with the person you've clicked
        */
        function changeChat(id, is_group){
            if(currentChat == id) return false;

            //determine wheter or not user is changing to a group chat
            if(typeof(is_group) == 'undefined') 
                is_group = false;
            
            //checking type of chat (user/group) to determine its 
            // id's prefix
            var old_prefix = 'userchat';
            if(group){
                old_prefix = 'chat';
            } 

            //remove class "current" from previous active user/group
            var ref = "#"+old_prefix+currentChat;
            $(ref).removeClass("current");

            //update currentChat variable
            currentChat = id;
            
            //erase message list
            $("#messages").empty();
            
            
            // setting type of current chat as false (default)
            group = false;

            //again checking type of chat (user/group)
            // to determine its id's prefix
            // AND now to load the 'leave' variable,
            // which will have a link attached to it
            // if the type is group
            var prefix = "userchat";
            var leave = "";
            var add = "";
            if(is_group) {
                // shoot.. its a group chat!
                // update the used prefix AND the group flag
                prefix = "chat";
                group = true;

                // set the 'leave' to receive a link
                // through this link the user will unsubscribe to that group
                // the 'add' variable will trigger a lighbox where
                // the user will be able to add other users to this group
                var parameter = '"'+id+'"';
                leave =  "<a onclick='leaveGroup("+parameter+")'>[leave this group]</a>";
                add = "  -  <a onclick='addUsersToGroup("+parameter+")'>[add users]</a>";
            } 

            //if there are no locally saved messages, ask it to the server 
            //for the history
            console.log(chatContent[currentChat]);
            if(chatContent[currentChat] == "")
                getPreviousMessages(true, new Date().getTime());
            else 
                $("#messages").html(chatContent[currentChat]);


            //remove the red color from the user/group with unread messages
            ref = "#"+prefix+id;

            $(ref).removeClass("new");

            //set this as the current-chatting-with user/group
            $(ref).addClass("current");

            //ask the server to mark this conversation as seen
            markAsSeen(prefix+id);

            // update the info of the chat title
            // to hold the current chat info.. (also appende the leave link - if there's one)
            $("#chattitle").text($(ref).text());
            $("#chattitle").append(add);
            $("#chattitle").append(leave);

            //scrolling window to bottom..
            goBottom();

            //sets focus
            setFocus($("#m"));
        }



        /*
            ===============================
            Mechanics to create group chats
            ===============================
        */
        
        
        /*
            Adding new group event:
                user clicked on the create group chat button
                show him the form to create group AND
                hide this button    
        */
        $("#addgroup").click(function(){
            $("#groupform").show();
            $("#addgroup").hide();

            //sets focus on group title
            setFocus($("#title"));

            //show all available users as checkboxes
            //to add in the chat
            fillOptions($("#checkscontainer"));
        });


        /*
            Hide new group form event:
                cancelled the proccess of creating a group chat
                hide the form and show him the button again    
        */
        $("#cancel").click(function(){
            $("#groupform").hide();
            $("#addgroup").show();

            $("#checkscontainer").empty();
            return false;
        });


        /*
            Submit new group event:
                when user has finished with the creation of a new group chat
                get all correct data and add it to the server
        */
        $("#addbutton").click(function(){
            //collecting all members' id's
            var members = {};
            members[0] = username;
            var i = 1;
            $("#checkscontainer input").each(function() {
                if($(this).is(':checked')) {
                    members[i] = $(this).val();
                    i++;
                }
            });

            
            //"register" the group with basic info + members' id's
            var data = {
                custom: 1, //its a group created in the chat, just that
                group_id: nextgroupId,
                group_title: $("#title").val(),
                members: members
            }

            //send it to server
            socket.emit('loginGroup', data);

            //clearing the form..
            $("#checkscontainer").empty();
            $("#title").val('');

            //hide the form and..
            $("#groupform").hide();
            //show the add button again..
            $("#addgroup").show();

            return false;
        });


        /*
            getting a list of every group online
            so that we can display them to the user
            AND check for available id's (for this example)
        */
        socket.on('allGroups', function(groups){
            //reset the groups list on the right
            $('#groups').empty();

            for(var i in groups) {
                //check if i'm part of the group
                if(!(username in groups[i].members)) {
                    // nope? nevermind it then
                    continue;  
                } 

                // adjusting the correct prefix
                var prefix = "group";
                if(groups[i].custom == 1)
                    prefix = "custom";

                //append it to the list
                var id = "'"+groups[i].id+"'";
                $('#groups').append(
                    '<li id="chat'+groups[i].id+'" target_id='+groups[i].id+' members="'+objToString(groups[i].members)+'" class="user" onclick="changeChat('+id+',true)">' + '<i class="fa fa-users" style="color: grey; font-size: 0.7em"></i>&nbsp;&nbsp;' + groups[i].title + '</li>'
                );
                
                //check to see if this key already exists in chatTime variable
                //which holds the records from the group with him
                if(!(groups[i].id in chatTime)) {
                    chatTime[groups[i].id] = 0;

                    //chat content holder
                    chatContent[groups[i].id] = "";
                }
            }

            //To "guarantee" there won't be repeated id's in this example
            //this new group's id will be loaded with a fictional id, based on the number of
            //all users that have already registered
            nextgroupId = groups.length+1;

            //sending request to check for unseen messages
            socket.emit('checkUnseenMessages', {id: username});
        });

        
        /*
            Leave group chat function
                triggered when user clicks on 'leave this group'
        */
        function leaveGroup(group_id){
            // setting up user and group data
            var data = {
                user: username,
                group: group_id
            }

            // send it to server
            socket.emit('leaveGroup', data);

            // erase previous conversation
            // with the group
            chatTime[group_id] = 0;
            chatContent[group_id] = "";

            // set the current chat to none
            currentChat = 0;

            // set the chat title to default
            $("#chattitle").text("Please, select a user or group to chat with..");

            // erase displayed messages
            $("#messages").empty();
        }


        /*
            When user clicks on the 'add users' link while in a group conversation
            this function is called, triggering a lightbox that will appear with
            checkboxes to select new users
        */
        function addUsersToGroup(group_id){
            $("#newcheckscontainer").empty();

            fillOptions($("#newcheckscontainer"));

            //retrieving members from the 'members' atribute
            var id = "#chat"+group_id;
            var members = $(id).attr("members").split(';');

            //foreach checkbox, check if the input
            //refers a member that's already in the group
            $("#newcheckscontainer input").each(function(){
                if($.inArray($(this).val(), members ) > -1 ){
                    //if so, remove it
                    $('label[for='+$(this).val()+']').remove();
                    $(this).remove();
                } 
            });

            //show lightbox
            $('#myModal').foundation('reveal', 'open');

            return false;
        }


        /*
            Submitting new users to current group conversation event
                Will gather info on all selected users and emit and 
                event to server to register those users in the 
                group
        */
        $("#newaddbutton").click(function() {
            //collecting all new members' id's
            var members = {};
            var i = 0;
            $("#newcheckscontainer input").each(function() {
                if($(this).is(':checked')) {
                    members[i] = $(this).val();
                    i++;
                }
            });

            //building the id of the 'li' corresponding to that group
            var oldtitle = "#chat" + currentChat;
            
            //checking the type of the id, so that only the 
            //number part of it is returned
            // options: custom/group
            if(currentChat.indexOf("custom")>0) {
                var prefixlessId = currentChat.substring(7);
            } else{
                var prefixlessId = currentChat.substring(6);
            }

            //"register" the new members in the group
            var data = {
                custom: 1, //type of the group (1 = chat group, 0 = actual group)
                group_id: prefixlessId, //numeric id
                group_title: $(oldtitle).text(),
                members: members
            }

            //send it to server
            socket.emit('loginGroup', data);

            //clearing the form..
            $("#newcheckscontainer").empty();
            
            //hidding the lightbox
            $('#myModal').foundation('reveal', 'close');

            return false;
        });


        /*
            Cancel action of adding new users to group conversation
                Clears the form and hides lightbox
        */
        $("#newcancel").click(function() {
            //clearing the form..
            $("#newcheckscontainer").empty();
            
            //hidding the lightbox
            $('#myModal').foundation('reveal', 'close');

            return false;
        });


        /*
            Method to fill all the current users of the chat
            as options to be added to groups in the 'element' div
            In real use, it would be better to have a search bar with an key up event attached to it
            to add users to group
        */
        function fillOptions(element){
            //to each user online
            $("#users li").each(function(){
                //get his id and name
                var name = $(this).text()
                var id = $(this).attr('target_id');

                //and create a checkbox with it
                $('<input />', { type: 'checkbox', id: id, value: id }).appendTo(element);
                $('<label />', { 'for': id, text: name }).appendTo(element);
                $('<br/>').appendTo(element);
            });
            return false;
        }


        /*
            Capturing the disconnect evento from the socket
            and trying to reconnect to the server
        */
        socket.on('disconnect', function(reason) {
            //got disconnect for some reason..
            //force it back up
            socket = io(address);

            //"register" user again
            var data = {
                username: username,
                password: password,
            }
            socket.emit('login', data);
        });


         /*
            ================================
            Functions related to registering
            ================================
        */


        /*
            New user wants to register himself, show him the form
        */
        $("#registrationLink").click(function(){
            //show lightbox
            $('#registration').foundation('reveal', 'open');
        });


        $(document).ready(function(){
            //preparing the JSON
            var newuser = {
                username: "<?= $user['User']['username'] ?>",
                name: "<?= $user['User']['name'] ?>",
                password: "<?= $user['User']['password'] ?>",
            }

            //sending to the server
            socket.emit('register', newuser);

            return false;
        });

        /*
            Submitted register info, take it to the server!
        */
        $("#registrationsubmit").click(function(){
            //preparing the JSON
            var newuser = {
                username: "<?= $user['User']['username'] ?>",
                name: "<?= $user['User']['name'] ?>",
                password: "<?= $user['User']['password'] ?>",
            }

            //sending to the server
            socket.emit('register', newuser);

            return false;
        })


        /*
            Server's response from the registration submit
        */
        socket.on('registration', function(result) {
            //if everything went smooth
            if(result.success) {
                //let others know i've registered
                socket.emit('getAllUsers');

                //close error message and lightbox
                $("#err").hide();
                $('#registration').foundation('reveal', 'close');

                //set the username and password as the ones from the registration
                $("#name").val($("#registrationusername").val());
                $("#password").val($("#registrationpassword").val());
            } else {
                //show him something went wrong
                $("#err").show();
            }
            
            //clear form values
            $("#registrationusername").val('');
            $("#registrationname").val('');
            $("#registrationpassword").val('');
        });


        /*
            ==========================================
            Additional functions to make things pretty
            ==========================================
        */

        
        /*
            Setting up height of some elements of this example
        */
        function contentHeight(){
            var height = $(window).height();
            height = height - $("#chattitle").height();
            height = height - 180;
            if (height > 0) {
                // $("#content").css({
                //     'max-height': '300px', //(height) + 'px',
                //     'min-height': '300px', //(height) + 'px',
                // });

                // $("#right").css({
                //     'max-height': '500px', //($(window).height() -50) + 'px',
                //     'min-height': '500px', //($(window).height() -50) + 'px',
                // });

                $("#welcomediv").css({
                    'max-height': ($(window).height() -50) + 'px',
                    'min-height': ($(window).height() -50) + 'px',
                });                
            }
        }


        /*
            Sets focus on input element passed through parameter
        */
        function setFocus(el){
            el.focus();
        }


        /*
          scrolling content div down
        */
        function goBottom(){
            var objDiv = document.getElementById("content");
            objDiv.scrollTop = objDiv.scrollHeight;
        }


        /*
            basic function to produce and unique fake id for the conversation
        */
        function setChatId(first, second) {
            if(first<second) {
                return first + "_" + second;
            }
            return second + "_" + first;
        }

        /*
            "Stringfies" object
                used to stringfy group members
        */
        function objToString (obj) {
            var str = '';
            for (var p in obj) {
                if (obj.hasOwnProperty(p)) {
                    str += obj[p] + ';';
                }
            }
            return str;
        }

    </script>
