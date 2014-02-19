<div class="row">
  <div class="small-6 large-centered columns">
  	<div class="users form">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend><?php echo __('Register'); ?></legend>
		<?php
			echo $this->Form->input('name', array('required' => true));
			echo $this->Form->input('login');
			echo $this->Form->input('password');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
  </div>
</div>