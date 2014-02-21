<div class="missionIssues form">
<?php echo $this->Form->create('MissionIssue'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mission Issue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mission_id');
		echo $this->Form->input('issue_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MissionIssue.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MissionIssue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mission Issues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
