<?php

	echo $this->Html->css('jcarousel');

	$this->extend('/Common/topbar');
	$this->start('menu');
	$comments_count = sprintf(' (%s) ', count($comment));

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background padding top-2">
	<div class="row full-width">

	  <nav class="evoke breadcrumbs">
		<?php echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index'));?>
		<a class="unavailable" href="#"><?php echo __('Mission: ').$evidence['Mission']['title']; ?></a>
		<?php echo $this->Html->link($evidence['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'], $evidence['Phase']['position']));?>
		<a class="unavailable" href="#"><?php echo __('Discussions'); ?></a>
		<a class="current" href="#"><?php echo $evidence['Evidence']['title'];?></a>
	  </nav>

	  <div class="medium-2 large-2 columns">
	  	<div class="evoke evidence-tag text-align">
	  		<img src="https://graph.facebook.com/<?php echo $evidence['User']['facebook_id']; ?>/picture?type=large" style = "max-width: 150px; margin: 20px 0px; max-height: 200px;"/>
		 	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $evidence['User']['id']))?>"><h1><?= $evidence['User']['name']?></h1></a>
		 	
		 	<div class = "evoke border-bottom"></div>

		 	<p><?php echo $evidence['User']['biography'] ?></p>

		 	<div class = "evoke border-bottom"></div>
		 	
		 	<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
			<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
			<i class="fa fa-twitter-square fa-2x"></i>

			<div class = "evoke border-bottom"></div>

			<?php if(isset($user['User']) && $evidence['Evidence']['user_id'] == $user['User']['id']) : ?>
				<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'edit', $evidence['Evidence']['id'])); ?>" class = "button general"><?php echo __('Edit Discussion');?></a></div>
			<?php endif; ?>
	 	</div>
	  </div>
	  <div class="medium-7 large-7 columns">
	 	<div class = "evoke evidence-body view">
		  	<h1><?php echo h($evidence['Evidence']['title']); ?></h1>
		  	<h6><?php echo h($evidence['Evidence']['created']); ?></h6>
		  	<?php echo urldecode($evidence['Evidence']['content']); ?>
		  	
		  	<!-- <div class = "evoke titles"><h2><?php echo __('Share a Thought').$comments_count; ?></h2></div> -->

		  	<?php echo $this->element('left_titlebar', array('title' => (__('Share a thought').$comments_count))); ?>

		  	<?php foreach ($comment as $c): 
					echo $this->element('comment_box', array('c' => $c));
	  			endforeach; 
  			?>
		</div>
	  </div>
	  <div class="medium-3 large-3 columns padding-right">
	  	<div class = "evoke position">
			<?php echo $this->element('right_titlebar', array('title' => (__('Share')))); ?>
		</div>

	  	<div class = "evoke evidence-share">
		  
	  		<!-- Facebook share button -->			
			<!-- <div id="fb-root"></div>
	  		<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="" data-type="button"></div><br> -->
	  		<!-- <div class = "evoke button-bg">
	  			<div class="evoke button like-button">
	  			<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-type="link"></div>
	  			</div>
	  		</div> -->

	  		<div style = "margin-bottom:10px">
	  			<div id="fb-root"></div>
	  			<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-width="200" data-type="button"></div>
	  		</div>
		  	
		  	<!-- Google Plus share button -->
		  	<div>
		  		<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
	  		</div>
			
		</div>

		<div class = "evoke dashboard position">
			<?php echo $this->element('right_titlebar', array('title' => (__('Rating')))); ?>
		</div>

		<div class = "evoke evidence-share">
		  	
		  	<!-- like button -->
		  	<?php if(empty($like)) : ?>
		  		<div  onClick="location.href='<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'like', $evidence['Evidence']['id'])); ?>'" class="evoke button-bg"><div class="evoke button like-button"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Like');?></h6></div><span><?= count($likes) ?></span></div>
			<?php else : ?>
				<div  onClick="location.href='<?php echo $this->Html->url(array("controller" => "likes", "action" => "like", $evidence['Evidence']['id'])); ?>'" class="evoke button-bg"><div class="evoke button like-button"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Unlike');?></h6></div><span><?= count($likes) ?></span></div>
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
