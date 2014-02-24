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

<section class="evoke login background">
	<div class="row full-width">
		<div class="medium-7 columns">
			<img src = '/evoke/webroot/img/bar.png' alt = "" style = "position: absolute; top: -17px;">
		</div>

		<div class="medium-5 columns">
			<img src = '/evoke/webroot/img/evoke-69.png' alt = "">

			<div class="row full-width">
				<div class="small-12 medium-8 large-4 small-centered large-uncentered columns" id = "login-columns">
					<h4><?php echo __('Evoke Panel Login');?></h4>

					<div class = "evoke top-border">
						<h5><?php echo __('Sign up');?></h5>

						<a href="<?php echo $fbLoginUrl; ?>" class="evoke button facebook login"><i class="fa fa-facebook fa-2x" style = "position: absolute; top: 10px; left: 15px;"></i><?php echo __('Sign in with Facebook');?></a>
						<a href="<?php echo $this->Html->url(array('action' => 'google_login')); ?>" class="evoke button google login"><img src = '/evoke/webroot/img/evoke_g-login.png' alt = "" style = "position: absolute; left: 4px; top: 5px;"><?php echo __('Sign in with Google');?></a>
						<a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register'));?>" class="evoke button signup login"><img src = '/evoke/webroot/img/evoke_e-login.png' style = "position: absolute; left: 0; top: 3px;"><?php echo __('Create EVOKE account');?></a>
					</div>
					<!-- <i class="fa fa-google-plus fa-2x" style = "position: absolute; top: 10px; left: 20px;"></i> -->
					<div class="evoke users form top-border bottom-border">
						<?php echo $this->Session->flash('auth'); ?>
						<?php echo $this->Form->create('User'); ?>
								<!-- <legend><?php echo __('Please enter your username and password'); ?></legend> -->
								<h5><?php echo __('Sign in');?></h5>
								<?php 
									echo $this->Form->input('username', array('label' => false));
									echo $this->Form->input('password', array('label' => false));
								?>
							<button class="evoke button general" type="submit">
								<?php echo __('Sign in'); ?>
							</button>
							<a href = "" style = "display: inline; font-size: 0.7em; color: #454545;"><?php echo __('Forgot your password?');?></a>
							<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
			
		</div>

	</div>
</section>
