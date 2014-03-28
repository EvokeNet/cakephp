<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li class="name">
				<h1><?= sprintf(__('Hi %s'), $users['User']['name']) ?></h1>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke margin top">
	<div class="row">
		<div class="large-12 columns">
			<div class="evoke profile picture wrapper left">
				<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" class="evoke profile picture" />
			</div>
			<div class="left evoke margin left-2 profile info">
				<h1 class="evoke typeface thin black"><?php echo $user['User']['name']; ?></h1>
				<p class="evoke paragraph clearfix">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec massa ac eros vulputate molestie.
					Nulla sed tincidunt orci, varius porttitor dolor.
				</p>

				<?php if($flags['_self']): ?>
					<a href="<?php echo $this->Html->url(array('action' => 'edit', $user['User']['id'])); ?>" class="evoke button bg-gray"><?php echo __('Edit profile'); ?></a>
				<?php elseif($flags['_friended']): ?>
					<a href="<?php echo $this->Html->url(array('action' => 'remove_friend', $user['User']['id'])) ?>" class="evoke button bg-red"><?php echo __('Forget Ally'); ?></a>
				<?php else: ?>
					<a href="<?php echo $this->Html->url(array('action' => 'add_friend', $user['User']['id'])) ?>" class="evoke button"><?php echo __('Add Ally'); ?></a>
				<?php endif; ?>

				<a href="#" class="evoke button bg-green"><?php echo __('Message'); ?></a>
			</div>
			
		</div>
	</div>
</section>