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
		<a class="unavailable" href="#"><?php echo __('Mission: ').$group['Mission']['title']; ?></a>
		<a class="unavailable" href="#"><?php echo __('Projects'); ?></a>
		<a class="current" href="#"><?php echo $evokation['Evokation']['title'];?></a>
	  </nav>

	  <div class="small-2 medium-2 large-2 columns">
	  	<div class="evoke evidence-tag text-align">
	  		<!-- <img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" style = "max-width: 150px; margin: 20px 0px; max-height: 200px;"/> -->
		 	
	  		<?php if(isset($user['User'])) :?>
		 		<a href = "<?= $this->Html->url(array('controller' => 'groups', 'action' => 'view', $group['Group']['id']))?>"><h1><?= $group['Group']['title']?></h1>
		 	<?php else : ?>
				<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'login'))?>"><h1><?= $group['Group']['title']?></h1>
			<?php endif;?>


		 	<div class = "evoke border-bottom"></div>

		 	<p><?php echo $group['Group']['description'] ?></p>

		 	<div class = "evoke border-bottom"></div>
		 	
		 	<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
			<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
			<i class="fa fa-twitter-square fa-2x"></i>

			<div class = "evoke border-bottom"></div>

			<?php if($can_edit) : ?>
				<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'edit', $evokation['Evokation']['group_id'])); ?>" class = "button general"><?php echo __('GO TO PROJECT');?></a></div>
			<?php else : ?>
				<?php if(isset($user['User']) && $Follows) :?>
					<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $evokation['Evokation']['id'])); ?>" class = "button general"><?php echo __('Unfollow');?></a></div>
				<?php else :?>
					<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $evokation['Evokation']['id'])); ?>" class = "button general"><?php echo __('Follow');?></a></div>
				<?php endif; ?>	
			<?php endif; ?>
	 	</div>
	  </div>
	  <div class="small-7 medium-7 large-7 columns">
	 	<div class = "evoke evidence-body view">
		  	<h1><?php echo h($evokation['Evokation']['title']); ?></h1>
		  	<h6><?php echo h($evokation['Evokation']['created']); ?></h6>
		  	<div id="evokation_div" data-placeholder="">
		  		<?php echo urldecode($evokationContent); ?>
		  	</div>
		  	
		  	<!-- <div class = "evoke titles"><h2><?php echo __('Share a Thought').$comments_count; ?></h2></div> -->

		  	<?php //echo $this->element('left_titlebar', array('title' => (__('Share a thought').$comments_count))); ?>

		  	<h2><?= strtoupper(__('Share a Thought')) ?></h2>
		  	
		  	<?php foreach ($comment as $c): 
					echo $this->element('comment_box', array('c' => $c));
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
	  			<a href="javascript:fbShare('<?= $_SERVER['SERVER_NAME']."/evokations/view/".$evokation['Evokation']['id'] ?>', 'Fb Share', '<?= $evokation['Evokation']['title'] ?>', 'http://goo.gl/dS52U', 520, 350)"><div class="evoke button like-button facebook-button"><i class="fa fa-facebook fa-lg"></i>&nbsp;&nbsp;&nbsp;<h6><?= __('Share on Facebook');?></h6></div></a>
  			</div>

  			<div class="evoke button-bg">
	  			<a href="#" onclick="popUp=window.open('https://plus.google.com/share?url=<?= $_SERVER['SERVER_NAME']."/evokations/view/".$evokation['Evokation']['id'] ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false"><div class="evoke button like-button google-button"><i class="fa fa-google-plus fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Share on Google+');?></h6></div></a>
  			</div>

	  		<!-- Facebook share button -->			
			<!-- <div id="fb-root"></div>
	  		<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="" data-type="button"></div><br> -->
	  		<!-- <div class = "evoke button-bg">
	  			<div class="evoke button like-button">
	  			<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-type="link"></div>
	  			</div>
	  		</div> -->
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
		  	<!-- Voting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button" data-reveal-id="myModalVote" data-reveal><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Vote');?></h6></div><span><?= sizeof($votes)?></span></div>

		  	<!-- Commenting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button comment-button" data-reveal-id="myModalComment" data-reveal><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Comment');?></h6></div><span><?= count($comment) ?></span></div>
			
		</div>

	  </div>
	</div>
</section>

<!-- Lightbox for voting form -->
<div id="myModalVote" class="reveal-modal tiny" data-reveal>
  <?php 
	if(isset($user['User'])) {
		if(!$vote) echo $this->element('vote', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => $user['User']['id']));
		else echo $this->element('see_vote', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => $user['User']['id'], 'vote_id' => $vote['Vote']['id'], 'vote_value' => $vote['Vote']['value']));
	} else {
		echo $this->element('vote', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => null));
	}
  ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<!-- Lightbox for commenting form -->
<div id="myModalComment" class="reveal-modal tiny evoke lightbox-bg" data-reveal>
  	<?php if(isset($user['User'])) :?>
  		<?php echo $this->element('comment_evokation', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => $user['User']['id'])); ?>
  	<?php else :?>
  		<?php echo $this->element('comment_evokation', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => null)); ?>
  	<?php endif; ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php

	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('facebook_share', array('inline' => false));
	echo $this->Html->script('google_share', array('inline' => false));

	echo $this->Html->css('evidences');
?>
