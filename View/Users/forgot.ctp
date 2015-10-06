<?php
	//Facebook login URL comes from session
	$fbLoginUrl = $this->Session->read('fbLoginUrl');
	echo $this->element('topbar-login');
?>

<section class="login">
	<div class="row full-width">
		<div class="small-12 medium-12 large-12 columns">
			<div class="margin bottom-2">
				<h3><?= __('Password Recovery')?></h3>
				<?php echo $this->Form->create('User'); ?>
				
				<?php 
					echo $this->Form->input('email');
					echo $this->Form->input('captcha', array('label' => __('Calculate').' '.$captcha));
				?>
				<button class="evoke button general" type="submit">
					<?php echo __('Send email'); ?>
				</button>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</section>