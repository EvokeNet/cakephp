//socket io client
  var socket = io.connect('http://localhost:8000');

  //on connetion, updates connection state and sends subscribe request
  socket.on('connect', function(data){
    setStatus('connected');
    socket.emit('subscribe', {channel:'notif'});
    socket.emit('subscribe', {channel:'notifs'});
  });

  //when reconnection is attempted, updates status 
  socket.on('reconnecting', function(data){
    setStatus('reconnecting');
  });

    //sending message mechanism
    $('#likeIt').click(function(){
        //creating json with the contents of the message
        var data = {
            user_id: "<?= $user['User']['id'] ?>",
            user_name: "<?= $user['User']['name'] ?>",
            user_pic_url: "<?= $pic ?>",
            evidence_id: "<?= $evidence['Evidence']['id'] ?>",
        }

        socket.emit('like', data); //save comment in database

        return false;
    });

  	// //sending message mechanism
    $('#unlikeIt').click(function(){

    	alert( "Handler for .click() called." );

    	console.log("WHYYY");

        //creating json with the contents of the message
        var data = {
            user_id: "<?= $user['User']['id'] ?>",
            user_name: "<?= $user['User']['name'] ?>",
            user_pic_url: "<?= $pic ?>",
            evidence_id: "<?= $evidence['Evidence']['id'] ?>",
        }

        socket.emit('unlike', data); //save comment in database

        return false;
    });

    socket.on('block_like', function (data) {
  		var str = "";
  		if(data === "<?= $user['User']['id'] ?>")
    		str = '<div class="like-buttonss" id = "unlikeIt"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp;unlike</div>';
    	else
    		str = '<div class="like-buttonss" id = "likeIt"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;like</div>';

		$('.like-buttonss').replaceWith(str);
  	});

  	// function addLikesCount(data) {
   //  	var str = '<span class = "likesCount">'+data+'</span>';
   //  	$('.likesCount').replaceWith(str);
  	// }

    //sending message mechanism
    $('#commenties').click(function(){
        //if there's nothing to say..
        if($("#mm").val() == ""){
            return false;
        }

        //creating json with the contents of the message
        var data = {
            user_id: "<?= $user['User']['id'] ?>",
            user_name: "<?= $user['User']['name'] ?>",
            user_pic_url: "<?= $pic ?>",
            evidence_id: "<?= $evidence['Evidence']['id'] ?>",
            msg: $('#mm').val()
        }

        socket.emit('post_comment', data); //save comment in database

        document.getElementById('mm').value = '';

        return false;
    });

    //Get comments when page is loading/reloading
    $(document).ready(function() {
	  	var data = {evidence_id:"<?= $evidence['Evidence']['id'] ?>"};
	  	var data2 = {user_id:"<?= $user['User']['id'] ?>", evidence_id:"<?= $evidence['Evidence']['id'] ?>"};
	  	socket.emit('get_comments', data); //Places the counter when the page is reloaded
	  	socket.emit('get_likes', data2); //Places the counter when the page is reloaded
	});

    socket.on('retrieve_likes', function (data) {
    	addLikesCount(data);
  	});

  	function addLikesCount(data) {
    	var str = '<span class = "likesCount">'+data+' Like</span>';
		$('.likesCount').replaceWith(str);
  	}
  	
    //returns comments
  	socket.on('retrieve_comments', function (data) {
    	addComment(data);
  	});

    //returns notifications
  	// socket.on('retrieve_all_comments', function (data) {
   //  	addComment(data.tag);
   //  	addCommentCount(data.replies);
  	// });

    //adds notfications to div
  	function addComment(data) {
    	$('#ncom').append(data.tag);

    	var str = '<span class = "commentCount">'+data.replies+'</span>';
    	$('.commentCount').replaceWith(str);
  	}

  	//adds notfications to div
  	// function addCommentCount(data) {
  	// 	var str = '<span class = "commentCount">'+data+'</span>';
   //  	$('.commentCount').replaceWith(str);
  	// }