<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#"><?php echo _('Evoke Network'); ?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Login</a>
				<ul class="dropdown">
					<li><a href="<?php echo $fbLoginUrl; ?>"><i class="fa fa-facebook-square"></i> Login with Facebook</a></li>
					<li><a href="<?php echo $fbLoginUrl; ?>"><i class="fa fa-google-plus-square"></i> Login with Google+</a></li>
				</ul>
			</li>
		</ul>

		<ul class="left">
			<li><a href="#"><?php echo __('What is Evoke?') ?></a></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke margin top-2">
	<div class="row">
		<div class="large-6 columns">
			<div class="users form">
				<?php echo $this->Session->flash('auth'); ?>
				<?php echo $this->Form->create('User'); ?>
					<fieldset>
						<legend><?php echo __('Please enter your username and password'); ?></legend>
						<?php echo $this->Form->input('username');
							echo $this->Form->input('password');
						?>
					</fieldset>
					<button class="button" type="submit">
						<?php echo __('Login') ?>
					</button>
					<button class="button secondary">
						<?php echo __('Cancel'); ?>
					</button>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>

		<div class="large-6 columns evoke margin top-2">
			<a href="<?php echo $fbLoginUrl; ?>" class="evoke button expand bg-blue"><i class="fa fa-facebook">
				</i> Login with Facebook
			</a>
			<a href="<?php echo $this->Html->url(array('action' => 'google_login')); ?>" class="evoke button expand bg-red">
				<i class="fa fa-google-plus"></i> Login with Google
			</a>
		</div>
	</div>
</section>
