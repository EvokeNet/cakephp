<div class="row standard-width margin top-5">
	<?php
		echo $this->Form->create('Group', array(
			'controller' => 'groups',
			'action' => 'addGroup'
		));
	?>

	<h2 class="text-color-highlight"><?php echo __('Add Group'); ?></h2>

	<?php
		echo $this->Form->input('title', array('required' => true));
		if (isset($mission_id)) {
			echo $this->Form->hidden('mission_id', array('value' => $mission_id));
		}
		if (isset($phase_id)) {
			echo $this->Form->hidden('phase_id', array('value' => $phase_id));
		}
		if (isset($quest_id)) {
			echo $this->Form->hidden('quest_id', array('value' => $quest_id));
		}
		
		echo $this->Form->hidden('user_id', array('value' => $user_id));
		echo $this->Form->input('description', array('required' => true, 'type' => 'textarea'));

		//LIMIT OF AGENTS
		echo $this->Form->input('max_local', array(
			'label' => __('Limit of agents of this group: ')
		));
	?>

	<button class="button" type="submit">
		<?php echo __('Create Group')?>
	</button>
	<?php echo $this->Form->end(); ?>
</div>