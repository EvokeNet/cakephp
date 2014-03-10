<!-- Form for adding quests -->
<?php 
	if(!isset($origin) || $origin != 'edit_mission') $origin = 'add_mission';
	echo $this->Form->create('Quest', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_quest', $mission_id, $origin)
									)
								); ?>
	<fieldset>
		<legend><?php echo __('Add Quest'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->hidden('mission_id', array('value' => $mission_id));
		echo $this->Form->hidden('phase_id', array('value' => $phase_id));
	?>
	</fieldset>
	<button class="button tiny" type="submit">
		<?php echo __('Add Quest')?>
	</button>
	<?php echo $this->Form->end(); ?>