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
	  <div class="small-6 large-centered columns">
	  	<img src = '/evoke/webroot/img/login_tag.png' alt = "" style = "width: 450px;">
	  	<div class="evoke users form login-tag register-tag">
	  		<h3 class = "evoke bottom-border"><?php echo __('Evoke Panel Register');?></h3>
			<?php echo $this->Form->create('User'); ?>
				<?php
					echo $this->Form->input('name', array('required' => true));
					echo $this->Form->input('username');
					echo $this->Form->input('password');
				?>
			<?php //echo $this->Form->end(__('Submit')); ?>
			<button class="evoke button" type="submit"><?php echo __('Submit') ?></button>
		</div>
	  </div>
	</div>
</section>

