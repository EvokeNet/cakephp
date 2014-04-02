<?php

	echo $this->Html->css('jcarousel');
	echo $this->Html->css('sticky_note');
	echo $this->Html->css('ribbon');

	$this->extend('/Common/topbar');
	$this->start('menu');
	$comments_count = sprintf(' (%s) ', count($comment));
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $user['User']['name']; ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#"><?= __('Settings') ?></a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?></li>
			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background padding top-2">
	<div class="row full-width">

	  <nav class="breadcrumbs">
		<?php echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index'));?>
		<a class="unavailable" href="#"><?php echo __('Mission: ').$evidence['Mission']['title']; ?></a>
		<?php echo $this->Html->link($evidence['Phase']['name'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'], $evidence['Phase']['position']));?>
		<a class="unavailable" href="#"><?php echo __('Discussions'); ?></a>
		<a class="current" href="#"><?php echo $evidence['Evidence']['title'];?></a>
	  </nav>

	  <div class="medium-2 large-2 columns">
	  	<div class="evoke evidence-tag text-align">
	  		<img src='/evoke/webroot/img/Leslie_Knope.png' style = "max-width: 150px; margin: 20px 0px; max-height: 200px;"/>
		 	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $evidence['User']['id']))?>"><h1><?= $evidence['User']['name']?></h1>
		 	
		 	<p><?php echo $evidence['User']['biography'] ?></p>
		 	<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
			<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
			<i class="fa fa-twitter-square fa-lg"></i>
	 	</div>
	  </div>
	  <div class="medium-8 large-8 columns">
	 	<div class = "evoke evidence-body">
		  	<h1><?php echo h($evidence['Evidence']['title']); ?></h1>
		  	<h6><?php echo h($evidence['Evidence']['created']); ?></h6>
		  	<p><?php echo urldecode($evidence['Evidence']['content']); ?></p>
		  	
		  	<h2><?php echo __('Share a Thought').$comments_count; ?></h2>
		  	<?php foreach ($comment as $c): ?>
		  		<div>
					<tr>
					<td>
						<h4><?php echo (__('Agent ').$c['User']['name']); ?></h4>
						<h6><?php echo date('F j, Y', strtotime($c['Comment']['created'])); ?></h6>
						<p><?php echo $c['Comment']['content']; ?></p>
						<hr class="sexy_line" />
					</td>
					</tr>
				</div>
			<?php endforeach; ?>
		</div>
	  </div>
	  <div class="medium-2 large-2 columns">
	  	<div class = "evoke dashboard position">
					<div class = "evoke dashboard titles-right">
						<div class = "evoke titles"><h4><?php echo strtoupper(__('Leadercloud'));?></h4></div>
					</div>
				</div>
	  	<div>
	  	<div class = "evoke evidence-share">
	  		<!-- Facebook share button -->			
			<div id="fb-root"></div>
	  		<div class="fb-share-button" data-href="http://developers.facebook.com/docs/plugins/" data-width="" data-type="button"></div><br>
		  	
		  	<!-- Google Plus share button -->
		  	<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
		  
		  	<a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'edit', $evidence['Evidence']['id'])); ?>" class = "button"><?php echo __('Edit Discussion');?></a>

		  	<!-- Voting lightbox button -->
		  	<a href="#" class="button" data-reveal-id="myModalVote" data-reveal><?php echo __('Vote');?></a>
		  	<!-- Commenting lightbox button -->
		  	<a href="#" class="button" data-reveal-id="myModalComment" data-reveal><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;&nbsp;<?php echo __('Comment').$comments_count;?></a>
		</div>
		</div>
	  </div>
	</div>

	<!-- Lightbox for voting form -->
	<div id="myModalVote" class="reveal-modal tiny" data-reveal>
	  <?php 
		if(!$vote) echo $this->element('vote', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $user['User']['id']));
		else echo $this->element('see_vote', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $user['User']['id'], 'vote_id' => $vote['Vote']['id'], 'vote_value' => $vote['Vote']['value']));
	  ?>
	  <a class="close-reveal-modal">&#215;</a>
	</div>

	<!-- Lightbox for commenting form -->
	<div id="myModalComment" class="reveal-modal tiny" data-reveal>
	  <?php echo $this->element('comment', array('evidence_id' => $evidence['Evidence']['id'], 'user_id' => $user['User']['id'])); ?>
	  <a class="close-reveal-modal">&#215;</a>
	</div>
</section>
