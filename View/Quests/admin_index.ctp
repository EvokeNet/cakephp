<div class="quests index">
	<h2><?php echo __('Quests'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('mission_id'); ?></th>
			<th><?php echo $this->Paginator->sort('phase_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($quests as $quest): ?>
	<tr>
		<td><?php echo h($quest['Quest']['id']); ?>&nbsp;</td>
		<td><?php echo h($quest['Quest']['title']); ?>&nbsp;</td>
		<td><?php echo h($quest['Quest']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($quest['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $quest['Mission']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($quest['Phase']['name'], array('controller' => 'phases', 'action' => 'view', $quest['Phase']['id'])); ?>
		</td>
		<td><?php echo h($quest['Quest']['created']); ?>&nbsp;</td>
		<td><?php echo h($quest['Quest']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $quest['Quest']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $quest['Quest']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $quest['Quest']['id']), null, __('Are you sure you want to delete # %s?', $quest['Quest']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Quest'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Phases'), array('controller' => 'phases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Phase'), array('controller' => 'phases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
	</ul>
</div>
