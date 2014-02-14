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