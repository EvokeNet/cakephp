<div class="missionIssues view">
<h2><?php echo __('Mission Issue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($missionIssue['MissionIssue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($missionIssue['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $missionIssue['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue'); ?></dt>
		<dd>
			<?php echo $this->Html->link($missionIssue['Issue']['name'], array('controller' => 'issues', 'action' => 'view', $missionIssue['Issue']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mission Issue'), array('action' => 'edit', $missionIssue['MissionIssue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mission Issue'), array('action' => 'delete', $missionIssue['MissionIssue']['id']), null, __('Are you sure you want to delete # %s?', $missionIssue['MissionIssue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mission Issues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission Issue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
