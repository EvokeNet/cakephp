<?php

	echo $this->Html->css('/components/jquery-ui/themes/smoothness/jquery-ui.css');

	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Register', 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>

<div class="row standard-width">
	<?php echo $this->element('register_form'); ?>
</div>

<!-- <div class="row standard-width">
  	<div class="medium-6 columns form-evoke-style">

  		<div class="evoke login users form">
			<?php echo $this->Form->create('User'); ?>
				<?php
					echo $this->Form->input('email', array('type' => 'email', 'required' => true, 'label' => __('Email')));
					echo $this->Form->input('confirm_email', array('type' => 'email', 'required' => true, 'label' => __('Confirm Password')));
					echo $this->Form->input('password', array('required' => true, 'label' => __('Password')));
					echo $this->Form->input('confirm_password', array('required' => true, 'label' => __('Confirm Password')));
				?>
			<button class="evoke button general" type="submit"><?php echo __('Register') ?></button>
		</div>

	</div>
	<div class="medium-6 columns">
		<?php
			echo $this->Form->input('name', array('required' => true, 'label' => __('Name')));
			echo $this->Form->input('username', array('required' => true, 'label' => __('Username')));
			echo $this->Form->input('birthdate', array('required' => true, 'label' => __('Birthdate')));
			?>
		<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div> -->

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>

<!--
<section class="evoke login background">
	<div class="row full-width">

		<div class="small-7 medium-7 large-7 columns">

			<img src = '<?= $this->webroot.'img/bar.png' ?>' alt = "" class = "evoke login video-bar">

			<div class="flex-video widescreen vimeo" style = "margin-top:50px">
			  <iframe src="http://player.vimeo.com/video/93164917" width="400" height="225" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>

		</div>

		<div class="small-5 medium-5 large-5 columns">
			<img src = '<?= $this->webroot.'img/evoke-69.png' ?>' alt = "" class = "evoke login padding-bottom">

			<div id = "login-columns">
				<h4 class = "evoke bottom-border"><?php echo __('Evoke Registration');?></h4>


-->
				<!-- <i class="fa fa-google-plus fa-2x" style = "position: absolute; top: 10px; left: 20px;"></i> -->

				<!--
				<div class="evoke login users form">
					<?php echo $this->Form->create('User'); ?>
						<?php
							echo $this->Form->input('name', array('required' => true, 'label' => __('Name')));
							echo $this->Form->input('username', array('required' => true, 'label' => __('Username')));
							echo $this->Form->input('email', array('type' => 'email', 'required' => true));
							echo $this->Form->input('password', array('required' => true, 'label' => __('Password')));
						?>
					<?php //echo $this->Form->end(__('Submit')); ?>
					<button class="evoke button general" type="submit"><?php echo __('Register') ?></button>
				</div>
			</div>

		</div>
	</div>
</section>
-->
