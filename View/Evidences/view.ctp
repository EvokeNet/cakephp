<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	
	echo $this->Html->css(
		array(
			'/components/slick-carousel/slick/slick.css',
			'slick.css',
			'/components/medium-editor/dist/css/medium-editor.css',
			'/components/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.css',
			'medium.css',
			'sidr.css'
		)
	);
?>

<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->


<?php echo $this->element('Evidences/evidence'); ?>

<?php
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


	<div class="row full-width">
	  	<nav class="evoke breadcrumbs">
			<?php //echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index'));?>
			<a class="unavailable" href="#"><?php echo __('Mission: ').$evidence['Mission']['title']; ?></a>
			<?php echo $this->Html->link($evidence['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'], $evidence['Phase']['position']));?>
			<!-- <a class="unavailable" href="#"><?php echo __('Discussions'); ?></a> -->
			<a class="current" href="#"><?php echo $evidence['Evidence']['title'];?></a>
		</nav>

	  	<div class="row full-width">

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

			  	<h2><?= strtoupper(__('Share a Thought')) ?></h2>

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
	  <div class="small-3 medium-3 large-3 columns padding-right">

	  	<div class="evoke text-center margin bottom-2">
		  	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $evidence['User']['id']))?>">
		  		<?php if($evidence['User']['photo_attachment'] == null) :
		  				if($evidence['User']['facebook_id'] == null) : 
		  					$pic = $this->webroot.'img/user_avatar.jpg';?>
					<?php else : ?>	
						<?php $pic = "https://graph.facebook.com/". $evidence['User']['facebook_id']. "/picture?type=large";?>
					<?php endif; ?>
				<?php else : ?>
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
			<span class = "likesCount"></span>
			<div id = "links"><button class="like-buttons"></button></div>
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


  	</div>

</section>





<?php $this->start('script'); ?>
<script type="text/javascript">
  // //socket io client
  // var socket = io.connect('http://localhost:8000');

  // //on connetion, updates connection state and sends subscribe request
  // socket.on('connect', function(data){
  //   setStatus('connected');
  //   socket.emit('subscribe', {channel:'notif'});
  //   socket.emit('subscribe', {channel:'notifs'});
  // });

  // //when reconnection is attempted, updates status 
  // socket.on('reconnecting', function(data){
  //   setStatus('reconnecting');
  // });


  function dynamicEvent() {
    
    // this.id = 'unlike';
    if(this.id == 'likeIt'){
    	console.log("WHYYYw");

        var data = {
            user_id: "<?= $user['User']['id'] ?>",
            user_name: "<?= $user['User']['name'] ?>",
            user_pic_url: "<?= $pic ?>",
            evidence_id: "<?= $evidence['Evidence']['id'] ?>",
        }

        socket.emit('like', data); //save comment in database
        this.id = 'unlikeIt';
        this.innerHTML = 'unlike';

        return false;
    } else{
    	//alert( "Handler for .click() called." );

    	console.log("WHYYYs");

        //creating json with the contents of the message
        var data = {
            user_id: "<?= $user['User']['id'] ?>",
            user_name: "<?= $user['User']['name'] ?>",
            user_pic_url: "<?= $pic ?>",
            evidence_id: "<?= $evidence['Evidence']['id'] ?>",
        }

        socket.emit('unlike', data); //save comment in database
        this.id = 'likeIt';
        this.innerHTML = 'like';

        return false;
    }
  }

  	var links = document.getElementById("links").getElementsByTagName('button');
  	links.onclick = dynamicEvent;

    socket.on('block_like', function (data) {

    	console.log('YAAAAAAAY');

    	var li = document.createElement('button');

    	if(data === "<?= $user['User']['id'] ?>"){
    		console.log('YAAAAAAAY2');
    		li.className = 'like-buttons';
    		li.id = 'unlikeIt';
      		li.innerHTML = 'unlike';
    	} else{
    		console.log('YAAAAAAAY4');
    		li.className = 'like-buttons';
    		li.id = 'likeIt';
      		li.innerHTML = 'like';
    	}

		$('.like-buttons').replaceWith(li);
		li.onclick = dynamicEvent;
  	});

  	//retrive likes number
    socket.on('retrieve_likes', function (data) {
    	addLikesCount(data);
  	});

  	function addLikesCount(data) {
  		var plural = 'likes';
  		
  		if(data == '1')
  			plural = 'like';

    	var str = '<span class = "likesCount">'+data+' '+plural+'</span>';
		$('.likesCount').replaceWith(str);
  	}

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
<?php $this->end(); ?>