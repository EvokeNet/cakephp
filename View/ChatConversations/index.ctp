<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	

	 	<div class="small-10 medium-10 large-10 columns margin top-2 maincolumn body-padding">
			
			<?php echo $this->Session->flash(); ?>

			<h3 class = "margin bottom-1"> <?= strtoupper(__('Messages')) ?> </h3>

			<div class = "evoke black-bg badges-bg">
				<ul>
					<?php foreach ($friends as $usr) : ?>
						<li>
							<div id="chatWithFriend<?=$usr['User']['id']?>">
								<h3>
									<?= $usr['User']['name'] ?>
								</h3>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>


			<div>
				<input type='textarea' id='message'>
				<button class="button large" id="sendMessage"><?=__('Send')?></button>
			</div>
		</div>

		<!-- <div class="medium-1 end columns"></div> -->

	</div>
	<meta name="chat" content="-1">
</section>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');
	echo $this->Html->script('menu_height');
?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){});
	
	<?php 
		foreach ($friends as $usr) {
			echo '$("#chatWithFriend'. $usr['User']['id'] .'").click(function (){'.
				 'getUserChat('. $usr['User']['id'] .');'.
				 '});';
		}
	?>

	$('#sendMessage').click(function () {
		//sending message to server
		var content = $('#message').val();
		sendMessage(content);


		//erase message input field
		$('#message').val("");
	});

	function throttle(fn, threshhold, scope) {
	  	threshhold || (threshhold = 250);
	  	var last,
	    	deferTimer;
	  	return function () {
	    	var context = scope || this;

	    	var now = +new Date,
	    	    args = arguments;
	    	if (last && now < last + threshhold) {
	    	  // hold on to it
	    		clearTimeout(deferTimer);
	    		deferTimer = setTimeout(function () {
	    	    	last = now;
	        		fn.apply(context, args);
	      		}, threshhold);
	    	} else {
	    		last = now;
	      		fn.apply(context, args);
	    	}
	  	};
	}

	function sendMessage(message){
		$.ajax({
		    type: 'post',
		    url: 'chatConversations/sendMessage',
		    data: {value:message, chat:currentChat},
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        console.log(response);
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}

	var currentChat = -1;
	function getUserChat(userid){
		$.ajax({
		    type: 'get',
		    url: 'chatConversations/getUserChat'+"/"+userid,
		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		    },
		    success: function(response) {
		        console.log(response);
		        var chatId = response.substring(response.search("metaId-") + 7, response.search("-metaId"));
		        currentChat = chatId;
		        // console.log(chatId);
		        var activity = response.substring(response.search("metaTime-") + 9, response.search("-metaTime"));
		        // console.log(activity);
		        var content = response.substring(response.search("-metaTime") + 9);
		        // console.log(content);

		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}

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
</script>