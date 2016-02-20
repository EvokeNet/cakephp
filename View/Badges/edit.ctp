<div class="badges form">
<?php echo $this->Form->create('Badge'); ?>
	<fieldset>
		<legend><?php echo __('Edit Badge'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('organization_id');
		echo $this->Form->input('mission_id');
		echo $this->Form->input('name');
		echo $this->Form->input('name_es');
		echo $this->Form->input('description');
		echo $this->Form->input('description_es');
		echo $this->Form->input('power_points_only');
		echo $this->Form->input('trigger');
		echo $this->Form->input('language');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Badge.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Badge.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Badges'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Badge Power Points'), array('controller' => 'badge_power_points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Badge Power Point'), array('controller' => 'badge_power_points', 'action' => 'add')); ?> </li>
	</ul>
</div>
