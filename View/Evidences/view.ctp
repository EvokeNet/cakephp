<?php

	$this->extend('/Common/topbar');
	$this->start('menu');
	$comments_count = sprintf(' (%s) ', count($comment));

	echo $this->element('header', array('user' => $user));
	$this->end(); 

	$pic = null;

	if($user['User']['photo_attachment'] == null) :
		if($user['User']['facebook_id'] == null) :
			$pic = $this->webroot.'img/user_avatar.jpg';
		else :
			$pic = "https://graph.facebook.com/". $user['User']['facebook_id']."/picture?large";
		endif;
	else :
		$pic = $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'];
	endif;
?>

<?php //$this->start('social-metatags'); ?>

	<!-- <meta property="og:locale" content="en_US">
		 
	<meta property="og:url" content="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $evidence['Evidence']['id'])); ?>">
	 
	<meta property="og:title" content="<?= $evidence['Evidence']['title'] ?>">
	<meta property="og:site_name" content="<?= __('Evoke') ?>">
	 
	<meta property="og:description" content="<?= $evidence['Evidence']['content'] ?>"> -->

	<!-- <meta property="og:title" content="pagina" /> -->
	<!-- [...] -->

<?php //$this->end(); ?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-10 medium-10 large-10 columns maincolumn">

	  	<?php echo $this->Session->flash(); ?>
	  	
	  	<nav class="evoke breadcrumbs">
			<?php //echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index'));?>
			<a class="unavailable" href="#"><?php echo __('Mission: ').$evidence['Mission']['title']; ?></a>
			<?php echo $this->Html->link($evidence['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'], $evidence['Phase']['position']));?>
			<!-- <a class="unavailable" href="#"><?php echo __('Discussions'); ?></a> -->
			<a class="current" href="#"><?php echo $evidence['Evidence']['title'];?></a>
		</nav>

	  	<div class="evoke default row full-width-alternate">

		  <div class="small-9 medium-9 large-9 columns">
		 	<div class = "evoke evidence-body view">
		 	<div class = "content padding30">
			  	<h1><?php echo urldecode($evidence['Evidence']['title']); ?></h1>
			  	<h6><?php echo h($evidence['Evidence']['created']); ?></h6>
			  	<div class = "imgtag"><?php echo urldecode($evidence['Evidence']['content']); ?></div>

			  	<?php if(!empty($attachments)) :?>
			  		<h4><?= __("Evidence's attachments:")?></h4>
			  		<?php 
			  			$images = array();
			  			$pdfs = array();
			  			$docs = array();
			  			foreach ($attachments as $attachment) :
			  				$type = explode('/', $attachment['Attachment']['type']);
							if($type[0] == 'application' && $type[1] != 'octet-stream' && $type[1] == 'pdf'): 
								$pdfs[] = $attachment;
							elseif($type[0] == 'application' && ($type[1] == 'msword' || $type[1] == 'vnd.openxmlformats-officedocument.wordprocessingml.document')): 
								$docs[] = $attachment;
							else :
								if($type[0] == 'image')
									$images[] = $attachment;
							endif;

						endforeach; 
					?>

					<?php if(!empty($images)) :?>
				  	  	<ul class="clearing-thumbs" data-clearing>		

					  		<?php foreach ($images as $attachment) :?>
					  			<!-- <span><?= $attachment['Attachment']['attachment']?></span> -->
								<li>
				 					<a href="<?= $this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/'.$attachment['Attachment']['attachment'].''; ?>">
				 						<img src="<?= $this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/thumb_'.$attachment['Attachment']['attachment'] ?>" width="100%">
				 					</a>
			 					</li>
					  		<?php endforeach ?>
						</ul>
					<?php endif ?>

					<?php if(!empty($pdfs)) :?>
				  	  	
					  	<?php foreach ($pdfs as $attachment) :?>
					  		<?php $path = ' '.$this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/'.$attachment['Attachment']['attachment'] . ''; ?>

							<li><a href="<?= $path ?>" data-reveal-id="<?= $attachment['Attachment']['id']?>" data-reveal><?= $attachment['Attachment']['attachment']?></a></li>

							
							<div id="<?= $attachment['Attachment']['id']?>" class="reveal-modal large" data-reveal>
							 	<object data="<?= $path ?>" type="application/pdf" width="100%" height="100%" style = "height:900px">

								  	<p>
								  		It appears you don't have a PDF plugin for this browser. No biggie... you can 
										<a href="myfile.pdf">click here to download the PDF file.</a>
									</p>
									  
								</object>
								<a class="close-reveal-modal">&#215;</a> 
							</div>
					  	<?php endforeach ?>
						
					<?php endif ?>

					<?php if(!empty($docs)) :?>
				  	  	
					  	<?php foreach ($docs as $attachment): ?>
					  		<?php $path = ' '.$this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/'.$attachment['Attachment']['attachment'] . ''; ?>

							<li><a href="<?= $path ?>" target = '_blank'><?= $attachment['Attachment']['attachment']?></a></li>

					  	<?php endforeach; ?>
						
					<?php endif; ?>
				  	
				<?php endif ?>

			  	<div class="row full-width-alternate comment-blocks">
				  <div class="large-8 columns"><h2><?= strtoupper(__('Share a Thought')) ?></h2></div>
				  <div class="large-4 columns">
				  	<a href ="#" class= "evoke button like-button comment-button" data-reveal-id="myModalComment" data-reveal><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;<h6><?= __('Comment');?></h6></a>
				  </div>
				</div>

				<input id="mm" style = "width:100%; height:70px" />
				<br><br>
                <button id="commenties" class="button general">Send</button>

			  	<?php 
			  	// 	foreach ($comment as $c): 
						// echo $this->element('comment_box', array('c' => $c, 'user' => $user));
		  		// 	endforeach; 
	  			?>

	  			<div class = "newcomments" id = "ncom"></div>
	  			</div>
			</div>
		  </div>
	  <div class="small-3 medium-3 large-3 columns padding-right">

	  	<div class="evoke evidence-tag text-align-center margin bottom-2">
		  		
		  	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $evidence['User']['id']))?>">
		  		<?php if($evidence['User']['photo_attachment'] == null) : ?>
					<?php if($evidence['User']['facebook_id'] == null) : ?>
						<!-- <img src="<?= $this->webroot.'img/user_avatar.jpg' ?>" style = "max-width: 10vw; margin: 20px 0px; max-height: 200px;"/> -->
						<?php $pic = $this->webroot.'img/user_avatar.jpg';?>
					<?php else : ?>	
						<!-- <img src="https://graph.facebook.com/<?php echo $evidence['User']['facebook_id']; ?>/picture?type=large" style = "max-width: 10vw; margin: 20px 0px; max-height: 200px;"/> -->
						<?php $pic = "https://graph.facebook.com/". $evidence['User']['facebook_id']. "/picture?type=large";?>
					<?php endif; ?>
				<?php else : ?>
					<!-- <img src="<?= $this->webroot.'files/attachment/attachment/'.$evidence['User']['photo_dir'].'/'.$evidence['User']['photo_attachment'] ?>" style = "max-width: 10vw; margin: 20px 0px; max-height: 200px;"/> -->
					<?php $pic = $this->webroot.'files/attachment/attachment/'.$evidence['User']['photo_dir'].'/'.$evidence['User']['photo_attachment'];?>
				<?php endif; ?>
		  		
		  		<div style="min-width: 10vw; margin: 3vw 5vw; min-height: 10vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;">
		  		</div>
			 	<h1><?= $evidence['User']['name']?></h1>
		 	</a>

			<dl class="accordion" data-accordion>
			  <dd>
			    <a href="#panel11"><i class="fa fa-angle-down fa-lg"></i></a>
			    <div id="panel11" class="content evidence-tag">
			      <div class = "evoke border-bottom"></div>

				 	<p><?php echo $evidence['User']['biography'] ?></p>

				 	<div class = "evoke border-bottom"></div>
				 	
				 	<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
					<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
					<i class="fa fa-twitter-square fa-2x"></i>

					<div class = "evoke border-bottom"></div>

					<?php if(isset($user['User']) && $evidence['Evidence']['user_id'] == $user['User']['id']) : ?>

						<div class = "evoke evidence padding bottom-1"><a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'edit', $evidence['Evidence']['id'])); ?>" class = "button general"><?php echo __('Edit Evidence');?></a></div>
					<?php endif; ?>

					<?php if(isset($user['User']) && $evidence['Evidence']['user_id'] == $user['User']['id']) : ?>
						<div class = "evoke evidence padding bottom-1"><a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'delete', $evidence['Evidence']['id'])); ?>" class = "button general"><?php echo __('Delete Evidence');?></a></div>

					<?php endif; ?>
			    </div>
			  </dd>
			</dl>

	 	</div>

		<h3> <?= strtoupper(__('Rating')) ?> </h3>

		<div class = "evoke evidence-share">
		  	
		  	<!-- like button -->
		  	<?php if(empty($like)) : ?>
		  		<!-- <div class="evoke button-bg"><a href = "<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'add', $evidence['Evidence']['id'])); ?>"><div class="evoke button like-button"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Like');?></h6></div><span><?= count($likes) ?></span></a></div> -->
			<?php else : ?>
				<!-- <div class="evoke button-bg"><a href = "<?php echo $this->Html->url(array('controller'=>'likes', 'action' => 'delete', $like['Like']['id'])); ?>"><div class="evoke button like-button"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Unlike');?></h6></div><span><?= count($likes) ?></span></a></div> -->
			<?php endif; ?>

			<div class="like-button"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<span class = "likesCount"></span></div>

		  	<!-- Commenting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button comment-button" data-reveal-id="myModalComment" data-reveal><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Comment');?></h6></div>&nbsp;&nbsp;&nbsp;<span class = "commentCount"></span></div>
			
		</div>

		<h3> <?= strtoupper(__('Share')) ?> </h3>

	  	<div class = "evoke evidence-share">
	  		
	  		<div class="evoke button-bg">
	  			<a href="javascript:fbShare('<?= $_SERVER['SERVER_NAME']."/evidences/view/".$evidence['Evidence']['id'] ?>', 'Fb Share', '<?= $evidence['Evidence']['title'] ?>', 'http://goo.gl/dS52U', 520, 350)"><div class="evoke button like-button facebook-button"><i class="fa fa-facebook fa-lg"></i>&nbsp;&nbsp;&nbsp;<h6><?= __('Share on Facebook');?></h6></div></a>
  			</div>

  			<div class="evoke button-bg">
	  			<a href="#" onclick="popUp=window.open('https://plus.google.com/share?url=<?= $_SERVER['SERVER_NAME']."/evidences/view/".$evidence['Evidence']['id'] ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false"><div class="evoke button like-button google-button"><i class="fa fa-google-plus fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Share on Google+');?></h6></div></a>
  			</div>
			
		</div>

	  </div>

	  	</div>

	  </div>

	  <!-- <div class="medium-1 end columns"></div> -->

  	</div>

</section>

<script src="http://localhost:8000/socket.io/socket.io.js"></script>

<?php
	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('facebook_share', array('inline' => false));
	echo $this->Html->script('google_share', array('inline' => false));
	echo $this->Html->script('target_blank', array('inline' => false));
?>

<script>

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

    function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }

    //sending message mechanism
    $('.like-button').click(function(){

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

  	// socket.on('block_like', function (data) {
   //  	addLikesCount(data);
  	// });

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
  		// console.log("YA"+data.tag);
  		// if(data.tag == true){
  		// 	var str = '<span class = "likesCount">'+data.replies+' unlike</span>';
    // 		$('.likesCount').replaceWith(str);
  		// } else if(data.tag == false){
  		// 	var str = '<span class = "likesCount">'+data.replies+' Like</span>';
    // 		$('.likesCount').replaceWith(str);
  		// }
    	var str = '<span class = "likesCount">'+data.replies+' Like</span>';
		$('.likesCount').replaceWith(str);
  	}
    //returns comments count
  	// socket.on('get_comments_count', function (data) {
   //  	addCommentCount(data);
  	// });

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

</script>