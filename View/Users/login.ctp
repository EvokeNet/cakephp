<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>

<section class="evoke login background">
	<div class="row full-width">
		<div class="medium-7 columns">

			<img src = '/evoke/webroot/img/bar.png' alt = "" class = "evoke login video-bar">

		</div>

		<div class="medium-5 columns">
			<img src = '/evoke/webroot/img/evoke-69.png' alt = "" class = "evoke login padding-bottom">

			<div class="row full-width">
				<div class="small-12 medium-9 large-4 small-centered large-uncentered columns" id = "login-columns">
					<h4><?php echo __('Evoke Panel Login');?></h4>

					<div class = "evoke login top-border">
						<h5><?php echo __('Sign up');?></h5>

						<a href="<?php echo $fbLoginUrl; ?>" class="evoke login button facebook"><i class="fa fa-facebook fa-2x"></i>&nbsp;&nbsp;&nbsp;<?php echo __('Sign in with Facebook');?></a>
						<a href="<?php echo $this->Html->url(array('action' => 'google_login')); ?>" class="evoke login button google"><img src = '/evoke/webroot/img/evoke_g-login.png' alt = "">&nbsp;&nbsp;&nbsp;<?php echo __('Sign in with Google');?></a>
						<a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register'));?>" class="evoke login button signup"><img src = '/evoke/webroot/img/evoke_e-login.png'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Create EVOKE account');?></a>
					</div>
					<!-- <i class="fa fa-google-plus fa-2x" style = "position: absolute; top: 10px; left: 20px;"></i> -->
					<div class="evoke login users form top-border bottom-border">
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
							<a href = "" class = "evoke login password"><?php echo __('Forgot your password?');?></a>
							<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>

		</div>

	</div>
</section>
