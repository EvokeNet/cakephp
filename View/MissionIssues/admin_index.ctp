<div class="missionIssues index">
	<h2><?php echo __('Mission Issues'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('mission_id'); ?></th>
			<th><?php echo $this->Paginator->sort('issue_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($missionIssues as $missionIssue): ?>
	<tr>
		<td><?php echo h($missionIssue['MissionIssue']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($missionIssue['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $missionIssue['Mission']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($missionIssue['Issue']['name'], array('controller' => 'issues', 'action' => 'view', $missionIssue['Issue']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $missionIssue['MissionIssue']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $missionIssue['MissionIssue']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $missionIssue['MissionIssue']['id']), null, __('Are you sure you want to delete # %s?', $missionIssue['MissionIssue']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Mission Issue'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
