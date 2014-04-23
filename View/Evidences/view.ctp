<?php

	echo $this->Html->css('jcarousel');

	$this->extend('/Common/topbar');
	$this->start('menu');
	$comments_count = sprintf(' (%s) ', count($comment));

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background padding top-2">

	<?php echo $this->Session->flash(); ?>
	
	<div class="row full-width">

	  <nav class="evoke breadcrumbs">
		<?php //echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index'));?>
		<a class="unavailable" href="#"><?php echo __('Mission: ').$evidence['Mission']['title']; ?></a>
		<?php echo $this->Html->link($evidence['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'], $evidence['Phase']['position']));?>
		<!-- <a class="unavailable" href="#"><?php echo __('Discussions'); ?></a> -->
		<a class="current" href="#"><?php echo $evidence['Evidence']['title'];?></a>
	  </nav>

	  <div class="small-2 medium-2 large-2 columns">
	  	<div class="evoke evidence-tag text-align">
	  		<img src="https://graph.facebook.com/<?php echo $evidence['User']['facebook_id']; ?>/picture?type=large" style = "max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
		 	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $evidence['User']['id']))?>"><h1><?= $evidence['User']['name']?></h1></a>
		 	
		 	<div class = "evoke border-bottom"></div>

		 	<p><?php echo $evidence['User']['biography'] ?></p>

		 	<div class = "evoke border-bottom"></div>
		 	
		 	<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
			<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
			<i class="fa fa-twitter-square fa-2x"></i>

			<div class = "evoke border-bottom"></div>

			<?php if(isset($user['User']) && $evidence['Evidence']['user_id'] == $user['User']['id']) : ?>

				<div class = "evoke evidence"><a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'edit', $evidence['Evidence']['id'])); ?>" class = "button general"><?php echo __('Edit Evidence');?></a></div>
			<?php endif; ?>

			<?php if(isset($user['User']) && $evidence['Evidence']['user_id'] == $user['User']['id']) : ?>
				<div class = "evoke evidence"><a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'delete', $evidence['Evidence']['id'])); ?>" class = "button general"><?php echo __('Delete Evidence');?></a></div>

			<?php endif; ?>

	 	</div>
	  </div>
	  <div class="small-7 medium-7 large-7 columns">
	 	<div class = "evoke evidence-body view">
		  	<h1><?php echo h($evidence['Evidence']['title']); ?></h1>
		  	<h6><?php echo h($evidence['Evidence']['created']); ?></h6>
		  	<?php echo urldecode($evidence['Evidence']['content']); ?>
		  	
		  	<?php if(!empty($attachments)) :?>
		  		<h4><?= __("Evidence's attachments:")?></h4>
		  	<?php endif ?>
		  	<?php foreach ($attachments as $attachment) :?>
		  		<span><?= $attachment['Attachment']['attachment']?></span>
		  	<?php endforeach ?>


		  	<!-- <div class = "evoke titles"><h2><?php echo __('Share a Thought').$comments_count; ?></h2></div> -->

		  	<?php //echo $this->element('left_titlebar', array('title' => (__('Share a thought').$comments_count))); ?>

		  	<h2><?= strtoupper(__('Share a Thought')) ?></h2>
		  	<?php foreach ($comment as $c): 
					echo $this->element('comment_box', array('c' => $c, 'user' => $user));
	  			endforeach; 
  			?>
		</div>
	  </div>
	  <div class="small-3 medium-3 large-3 columns padding-right">
	  	<div class = "evoke position">
			<?php echo $this->element('right_titlebar', array('title' => (__('Share')))); ?>
		</div>

	  	<div class = "evoke evidence-share">
	  		
	  		<div class="evoke button-bg">
	  			<a href="javascript:fbShare('<?= $_SERVER['SERVER_NAME']."/evidences/view/".$evidence['Evidence']['id'] ?>', 'Fb Share', '<?= $evidence['Evidence']['title'] ?>', 'http://goo.gl/dS52U', 520, 350)"><div class="evoke button like-button facebook-button"><i class="fa fa-facebook fa-lg"></i>&nbsp;&nbsp;&nbsp;<h6><?= __('Share on Facebook');?></h6></div></a>
  			</div>

  			<div class="evoke button-bg">
	  			<a href="#" onclick="popUp=window.open('https://plus.google.com/share?url=<?= $_SERVER['SERVER_NAME']."/evidences/view/".$evidence['Evidence']['id'] ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false"><div class="evoke button like-button google-button"><i class="fa fa-google-plus fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Share on Google+');?></h6></div></a>
  			</div>

  			<!-- <a href="#" onclick="popUp=window.open('https://plus.google.com/share?url=YOUR-WEBPAGE-PERMALINK/URL', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false">
  			<img class="share-googleplus" src="YOUR-GOOGLE+-IMAGE-ICON-URL" alt="Social Share Articles on GooglePlus" title="Share articles to GooglePlus" /></a> -->

	  		<!-- <div style = "margin-bottom:10px">
	  			<div id="fb-root"></div>
	  			<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-width="200" data-type="button"></div>
	  		</div> -->
		  	
		  	<!-- Google Plus share button -->
		  	<!-- <div>
		  		<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
	  		</div> -->
			
		</div>

		<div class = "evoke dashboard position">
			<?php echo $this->element('right_titlebar', array('title' => (__('Rating')))); ?>
		</div>

		<div class = "evoke evidence-share">
		  	
		  	<!-- like button -->
		  	<?php if(empty($like)) : ?>
		  		<!-- <div  onClick="location.href='/evoke/likes/like/<?php echo $evidence['Evidence']['id']; ?>'" class="evoke button-bg"><div class="evoke button like-button"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Like');?></h6></div><span><?= count($likes) ?></span></div> -->
		  		<div class="evoke button-bg"><a href = "<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'add', $evidence['Evidence']['id'])); ?>"><div class="evoke button like-button"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Like');?></h6></div><span><?= count($likes) ?></span></a></div>
			<?php else : ?>
				<!-- <div  onClick="location.href='/evoke/likes/like/<?php echo $evidence['Evidence']['id']; ?>'" class="evoke button-bg"><div class="evoke button like-button"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Unlike');?></h6></div><span><?= count($likes) ?></span></div> -->
				<div class="evoke button-bg"><a href = "<?php echo $this->Html->url(array('controller'=>'likes', 'action' => 'delete', $like['Like']['id'])); ?>"><div class="evoke button like-button"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Unlike');?></h6></div><span><?= count($likes) ?></span></a></div>
			<?php endif; ?>

			<!-- Voting lightbox button -->
		  	<!-- <div class = "evoke button-bg"><div class="evoke button like-button" data-reveal-id="myModalVote" data-reveal><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Like');?></h6></div></div> -->

		  	<!-- Commenting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button comment-button" data-reveal-id="myModalComment" data-reveal><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Comment');?></h6></div><span><?= count($comment) ?></span></div>
			
		</div>

	  </div>
	</div>
</section>

<!-- Lightbox for voting form -->
<div id="myModalVote" class="reveal-modal tiny" data-reveal>
  <?php 
	// if(!$vote) echo $this->element('vote', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $user['User']['id']));
	// else echo $this->element('see_vote', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $user['User']['id'], 'vote_id' => $vote['Vote']['id'], 'vote_value' => $vote['Vote']['value']));
  ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<!-- Lightbox for commenting form -->
<div id="myModalComment" class="reveal-modal tiny evoke lightbox-bg" data-reveal>
  	<?php if(isset($user['User'])) :?>
  		<?php echo $this->element('comment', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $user['User']['id'])); ?>
  	<?php else :?>
  		<?php echo $this->element('comment', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => null)); ?>
  	<?php endif;?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php

	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('facebook_share', array('inline' => false));
	echo $this->Html->script('google_share', array('inline' => false));


?>

<script>
    function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }
</script>