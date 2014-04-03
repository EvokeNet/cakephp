<?php

	echo $this->Html->css('jcarousel');

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

	  <div class="medium-2 large-2 columns">
	  	<div class="evoke evidence-tag text-align">
	  		<img src='<?= $this->webroot.'img/Leslie_Knope.png' ?>' style = "max-width: 150px; margin: 20px 0px; max-height: 200px;"/>
		 	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $evokation['User']['id']))?>"><h1><?= $evokation['User']['name']?></h1>
		 	
		 	<p><?php echo $evokation['User']['biography'] ?></p>
		 	<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
			<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
			<i class="fa fa-twitter-square fa-2x"></i>

			<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'edit', $evokation['evokation']['id'])); ?>" class = "button"><?php echo __('Edit Discussion');?></a></div>
	 	</div>
	  </div>
	  <div class="medium-8 large-8 columns">
	 	<div class = "evoke evidence-body view">
		  	<h1><?php echo h($evokation['Evokation']['title']); ?></h1>
		  	<h6><?php echo h($evokation['Evokation']['created']); ?></h6>
		  	<?php //echo urldecode($evokation['Evokation']['content']); ?>
		  	
		  	<!-- <div class = "evoke titles"><h2><?php echo __('Share a Thought').$comments_count; ?></h2></div> -->

		  	<?php echo $this->element('left_titlebar', array('title' => (__('Share a thought')))); ?>

		  	
		</div>
	  </div>
	  <div class="medium-2 large-2 columns">
	  	<div class = "evoke dashboard position">
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

	  		<div id="fb-root"></div>
	  		<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-width="200" data-type="button"></div>
		  	
		  	<!-- Google Plus share button -->
		  	<div class="g-plus" data-action="share" data-annotation="none" data-height="24"></div>
			
		</div>

		<div class = "evoke dashboard position">
			<?php echo $this->element('right_titlebar', array('title' => (__('Rating')))); ?>
		</div>

		<div class = "evoke evidence-share">
		  	
			<!-- Voting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button" data-reveal-id="myModalVote" data-reveal><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Like');?></h6></div></div>

		  	<!-- Commenting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button comment-button" data-reveal-id="myModalComment" data-reveal><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Comment');?></h6></div><span><?= count($comment) ?></span></div>
			
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

<?php

	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('facebook_share', array('inline' => false));
	echo $this->Html->script('google_share', array('inline' => false));


?>

<!-- <div class="evokations view">
<h2><?php echo __('Evokation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evokation['Evokation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($evokation['Evokation']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Abstract'); ?></dt>
		<dd>
			<?php echo h($evokation['Evokation']['abstract']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($evokation['Evokation']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evokation['Evokation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evokation['Evokation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evokation'), array('action' => 'edit', $evokation['Evokation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evokation'), array('action' => 'delete', $evokation['Evokation']['id']), null, __('Are you sure you want to delete # %s?', $evokation['Evokation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evokations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Groups'); ?></h3>
	<?php if (!empty($evokation['Group'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Evokation Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evokation['Group'] as $group): ?>
		<tr>
			<td><?php echo $group['id']; ?></td>
			<td><?php echo $group['user_id']; ?></td>
			<td><?php echo $group['evokation_id']; ?></td>
			<td><?php echo $group['created']; ?></td>
			<td><?php echo $group['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'groups', 'action' => 'delete', $group['id']), null, __('Are you sure you want to delete # %s?', $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div> -->
