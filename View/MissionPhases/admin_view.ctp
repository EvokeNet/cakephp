<div class="missionPhases view">
<h2><?php echo __('Mission Phase'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($missionPhase['MissionPhase']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($missionPhase['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $missionPhase['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phase'); ?></dt>
		<dd>
			<?php echo $this->Html->link($missionPhase['Phase']['name'], array('controller' => 'phases', 'action' => 'view', $missionPhase['Phase']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($missionPhase['MissionPhase']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($missionPhase['MissionPhase']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($missionPhase['MissionPhase']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mission Phase'), array('action' => 'edit', $missionPhase['MissionPhase']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mission Phase'), array('action' => 'delete', $missionPhase['MissionPhase']['id']), null, __('Are you sure you want to delete # %s?', $missionPhase['MissionPhase']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mission Phases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission Phase'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Phases'), array('controller' => 'phases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Phase'), array('controller' => 'phases', 'action' => 'add')); ?> </li>
	</ul>
</div>
