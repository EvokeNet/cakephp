<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

	echo $this->Html->css('chat');

?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	

	 	<div class="small-10 medium-10 large-10 columns margin top-2 maincolumn body-padding">
			
			<?php echo $this->Session->flash(); ?>

			<h3 class = "margin bottom-1"> <?= strtoupper(__('Messages')) ?> </h3>

			<div class = "evoke row">
				<div class="large-12 columns no-margin no-padding">
					<div class="large-4 columns evoke chat-bg no-margin no-padding">
						<ul>
							<?php foreach ($friends as $usr) : ?>
								<li>
									<a href="#" id="chatWithFriend<?=$usr['User']['id']?>">
										<h4>
											<?= $usr['User']['name'] ?>
										</h4>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="large-8 columns no-margin no-padding">
						<div class="large-12 columns no-margin no-padding">
							<div id='container' class="evoke chat-container"></div>
							<div class="large-12 columns no-margin no-padding">
								<div class="large-10 columns no-margin no-padding">
									<textarea rows="4" cols="50" class="evoke msg-holder" id='message'></textarea>
								</div>
								<div class="large-2 columns no-margin no-padding">
									<button class="button" id="sendMessage"><?=__('Send')?></button>
								</div>
							</div>
						</div>
					</div>		
				</div>
			</div>

		</div>

		<!-- <div class="medium-1 end columns"></div> -->

	</div>
	<meta name="chat" content="-1">
</section>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');
	echo $this->Html->script('menu_height');
	echo $this->Html->script('jquery.slimscroll.min');
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
	var currentChat = -1;
	var toBottom = false;
	var started = false;

	$("#container").slimScroll({
		height: 'auto',
	});

	// $.ajaxSetup({
 //        async: true
 //    });

	//loading click events based on allies
	<?php 
		foreach ($friends as $usr) {
			echo '$("#chatWithFriend'. $usr['User']['id'] .'").click(function (){'.
				 'getUserChat('. $usr['User']['id'] .');'.
				 '});';
		}
	?>

	//button submit message
	$('#sendMessage').click(function () {
		//sending message to server
		var content = $('#message').val();
		sendMessage(content);


		//erase message input field
		$('#message').val("");
	});

	//check for new messages every 8 secs
	// setInterval(receiveMessages, 8000);

	//check for new messages from current chat every 1.5 secs
	// setInterval(receiveCurrent, 1900);

	//send message in a chat ajax
	function sendMessage(message){
		$.ajax({
			// async: true,
		    type: 'post',
		    url: 'chatConversations/sendMessage',
		    data: {value:message, chat:currentChat},
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        // console.log(response);
		        $('#container').append(response);
		        goBottom();
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}

	//receive messages from all chats
	function receiveMessages(){
		$.ajax({
		    type: 'post',
		    url: 'chatConversations/receiveMessages',
		    data: {current: currentChat},
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        // console.log(response);

		        //response consists of a string with the id's of the chats with new messages, separated by ';'!
		        // before <> are the ally chat notifications, after it are the custom chats
		        var allyIds = response.substring(0, response.search("<>"));
		        // console.log(allyIds);
		        var otherIds = response.substring(response.search("<>")+2);
		        var ids = allyIds.split(";");
		        for (i = 0; i < ids.length; i++) { 
		        	if(ids[i] == "") continue;
		        	var st = "#chatWithFriend"+ids[i]+" a";
					$(st).css( "color", "red" );
					// console.log(ids[i]+" got red");
				}
		        // $('#container').append(response);
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}

	//receive messages from current chats
	function receiveCurrent(){
		if(currentChat == -1) return;
		$.ajax({
		    type: 'post',
		    url: 'chatConversations/receiveCurrent',
		    data: {current: currentChat},
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        // console.log(response);
		        if(response != "") {
		        	$('#container').append(response);
		        	goBottom();
		        }
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}

	//find chat and all messages of users
	function getUserChat(userid){
		$.ajax({
		    type: 'get',
		    url: 'chatConversations/getUserChat'+"/"+userid,
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        
		    	var st = "#chatWithFriend"+userid+" h4";
				$(st).css( "color", "white" );

		        // console.log(response);
		        var chatId = response.substring(response.search("metaId-") + 7, response.search("-metaId"));
		        if(chatId == currentChat) {
		        	goBottom();
		        	return;
		        }
		        currentChat = chatId;
		        // console.log(chatId);
		        var activity = response.substring(response.search("metaTime-") + 9, response.search("-metaTime"));
		        // console.log(activity);
		        var content = response.substring(response.search("-metaTime") + 9);
		        // console.log(content);

		        $('#container').html(content);

		        destroySlimscroll("container");
		        $("#container").slimScroll({
					height: 'auto',
					start: $('.last'),
				});

		   //      console.log($('#container').scrollTop());
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}

	function destroySlimscroll(objectId) { 
	   $("#"+objectId).parent().replaceWith($("#"+objectId)); 
	}

	function goBottom(){
		toBottom = true;
		started = true;
		while(toBottom) {
			$("#container").slimScroll({ scrollBy: '100px' });
	    }
	    started = false;
	}

	$('#container').slimScroll().bind('slimscroll', function(e, pos){
    	if(!started) return;
    	if(pos = 'bottom') {
    		toBottom = false;
    		// console.log(pos);
    	}
	});


	function getCorrectURL(afterHome){
    	var str = document.URL;
    	
    	//str = str.substr(7, str.length);
    	str = str.substr(0, str.indexOf("dashboard"));
    	
    	str = str.substr(0, str.length -1);
    	// alert(str);
    	if(str.length>1) {
    		// str = str.substr(0, str.indexOf('/', 1));
    		//alert(str);	
    		str = str + '/' + afterHome;
    		return str;
    	} else {
    		//alert(str);	
    		return afterHome;
    	}
    	//alert(str);
    }
    });
</script>