<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>

<section class="evoke login background">
	<div class="row full-width">
	
		<div class="medium-7 columns"><img src = '<?= $this->webroot.'img/bar.png' ?>' alt = "" class = "evoke login video-bar"></div>

		<div class="medium-5 columns">
			<img src = '<?= $this->webroot.'img/evoke-69.png' ?>' alt = "" class = "evoke login padding-bottom">
			
			<div id = "login-columns">
				<h4><?php echo __('Evoke Panel Login');?></h4>

				<div class = "evoke login top-border">
					<h5><?php echo __('Sign up');?></h5>

					<a href="<?php echo $fbLoginUrl; ?>" class="evoke login button facebook"><i class="fa fa-facebook fa-2x"></i>&nbsp;&nbsp;&nbsp;<?php echo __('Sign in with Facebook');?></a>
					<a href="<?php echo $this->Html->url(array('action' => 'google_login')); ?>" class="evoke login button google"><img src = '<?= $this->webroot.'img/evoke_g-login.png' ?>' alt = "">&nbsp;&nbsp;&nbsp;<?php echo __('Sign in with Google');?></a>
					<!-- <a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register'));?>" class="evoke login button signup"><img src = '<?= $this->webroot.'img/evoke_e-login.png' ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Create EVOKE account');?></a> -->

					<a href="#" class="evoke login button signup" data-reveal-id="myModal" data-reveal><img src = '<?= $this->webroot.'img/evoke_e-login.png' ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Create EVOKE account');?></a>
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
</section>

<div id="myModal" class="reveal-modal tiny evoke login-lightbox" data-reveal>
	<h2><?= __('Evoke Registration') ?></h2>
	<?php echo $this->Form->create('User'); ?>
	<?php
		echo $this->Form->input('name', array('required' => true, 'label' => __('Name')));
		echo $this->Form->input('username', array('required' => true, 'label' => __('Username')));
		echo $this->Form->input('email', array('type' => 'email', 'required' => true));
		echo $this->Form->input('password', array('required' => true, 'label' => __('Password')));
	?>
	<?php //echo $this->Form->end(__('Submit')); ?>
	<button class="evoke button general" type="submit"><?php echo __('Register') ?></button>
  <a class="close-reveal-modal">&#215;</a>
</div>
