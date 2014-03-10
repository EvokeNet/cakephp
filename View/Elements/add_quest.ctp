<!-- Form for adding quests -->
<?php echo $this->Form->create('Quest', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_quest', $id)
									)
								); ?>
	<fieldset>
		<legend><?php echo __('Add Quest'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->hidden('mission_id', array('value' => $id));
		echo $this->Form->hidden('phase_id', array('value' => $phase_id));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>