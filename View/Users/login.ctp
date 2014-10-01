<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>

<div class="row standard-width">
	<div class="small-5 medium-5 large-5 columns">
		<div class="evoke login users form top-border bottom-border">
			<?php echo $this->Session->flash(); ?>
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
				<a href = "#" class = "evoke login password"><?php echo __('Forgot your password?');?></a><!--send to correct address-->
				<?php echo $this->Form->end(); ?>
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
	<!-- <img src = '<?= $this->webroot.'img/chiptag.png' ?>'> -->
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
	echo $this->Html->script("oauthpopup", array('inline' => false));
	echo $this->Html->script("google_login", array('inline' => false));
?>