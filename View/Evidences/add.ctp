<div class="evidences form">
<?php echo $this->Form->create('Evidence'); ?>
	<fieldset>
		<legend><?php echo __('Add Evidence'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('content');
		echo $this->Form->input('user_id');
		echo $this->Form->input('quest_id');
		echo $this->Form->input('mission_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
