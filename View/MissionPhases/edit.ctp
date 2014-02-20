<div class="missionPhases form">
<?php echo $this->Form->create('MissionPhase'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mission Phase'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mission_id');
		echo $this->Form->input('phase_id');
		echo $this->Form->input('position');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MissionPhase.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MissionPhase.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mission Phases'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Phases'), array('controller' => 'phases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Phase'), array('controller' => 'phases', 'action' => 'add')); ?> </li>
	</ul>
</div>
