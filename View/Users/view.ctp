<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Agent <?php echo explode(' ', $this->Session->read('Auth.User.User.name'))[0]; ?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><a href="<?php echo $this->Html->url(array('action' => 'logout')); ?>">Sign out</a></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><a href="#">Dashboard</a></li>
		</ul>
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