<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<!-- <ul class="title-area">
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
	</section> -->
</nav>

<?php $this->end(); ?>

<section class="evoke login-bg">
	<div class="row">
		<div class="medium-6 columns">
			
		</div>

		<div class="medium-6 columns">
			<img src = '/evoke/webroot/img/login_tag.png' alt = "" style = "width: 450px;">
			<div class = "evoke login-tag">

			<h3><?php echo __('Evoke Panel Login');?></h3>

				<div class = "evoke top-border">
					<h4><?php echo __('Sign up');?></h4>

					<a href="<?php echo $fbLoginUrl; ?>" class="evoke button facebook login"><?php echo __('Sign in with Facebook');?></a>
					<a href="<?php echo $this->Html->url(array('action' => 'google_login')); ?>" class="evoke button google login"><?php echo __('Sign in with Google');?></a>
					<a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register'));?>" class="evoke button signup login"><?php echo __('Create EVOKE account');?></a>
				</div>

				<div class="evoke users form top-border bottom-border">
					<?php echo $this->Session->flash('auth'); ?>
					<?php echo $this->Form->create('User'); ?>
							<!-- <legend><?php echo __('Please enter your username and password'); ?></legend> -->
							<h4><?php echo __('Sign in');?></h4>
							<?php 
								echo $this->Form->input('username', array('label' => false));
								echo $this->Form->input('password', array('label' => false));
							?>
						<button class="evoke button" type="submit">
							<?php echo __('Sign in') ?>
						</button>
						<?php echo $this->Form->end(); ?>
				</div>

			</div>
		</div>
	</div>
</section>
