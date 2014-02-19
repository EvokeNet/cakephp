<section>
<div class="row">
	<div class="small-6 large-centered columns">
		<div class="users form">
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<legend><?php echo __('Edit User'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name');
				echo $this->Form->input('username');
				echo $this->Form->input('password');
				echo $this->Form->input('birthdate', array('required' => true));
				//echo $this->Form->input('sex');
				echo $this->Form->input('sex', array(
					'type' => 'select',
				    'options' => array('male', 'female'),
				));
				echo $this->Form->input('biography', array('required' => true));
				echo $this->Form->input('facebook');
				echo $this->Form->input('twitter');
				echo $this->Form->input('instagram');
				echo $this->Form->input('website');
				echo $this->Form->input('blog');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
	</div>
</div>
</section>
