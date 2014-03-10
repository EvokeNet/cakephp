<?php 
	if(!isset($origin) || $origin != 'edit_mission') $origin = 'add_mission';
	echo $this->Form->create('Quest', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'edit_quest', $mission_id, $me['id'], $origin)
									)
								); ?>
	<fieldset>
		<legend><?php echo __('Edit Quest'); ?></legend>
	<?php
		echo $this->Form->input('title', array('value' => $me['title']));
		echo $this->Form->input('description', array('value' => $me['description']));
		echo $this->Form->hidden('mission_id', array('value' => $mission_id));
		echo $this->Form->hidden('phase_id', array('value' => $phase_id));
	?>
	</fieldset>
	<button class="button tiny" type="submit">
		<?php echo __('Add Quest')?>
	</button>
	<?php echo $this->Form->end(); ?>
	<button class="button alert small">
		<?php echo $this->Form->PostLink('delete', array('controller' => 'panels', 'action' => 'delete_quest', $mission_id, $me['id'], $origin));?>
	</button>