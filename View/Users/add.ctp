<div class="row">
  <div class="small-6 large-centered columns">
  	<div class="users form">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend><?php echo __('Add User'); ?></legend>
		<?php
			echo $this->Form->input('name');
			echo $this->Form->input('birthdate');
			echo $this->Form->input('sex');
			echo $this->Form->input('biography');
			echo $this->Form->input('username');
			echo $this->Form->input('password');
			echo $this->Form->input('facebook');
			echo $this->Form->input('twitter');
			echo $this->Form->input('instagram');
			echo $this->Form->input('website');
			echo $this->Form->input('blog');
			echo $this->Form->input('role_id');//retirar depois..
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
  </div>
</div>
