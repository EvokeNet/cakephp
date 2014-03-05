<div class="evidences index">
	<h2><?php echo __('Evidences'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quest_id'); ?></th>
			<th><?php echo $this->Paginator->sort('mission_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evidences as $evidence): ?>
	<tr>
		<td><?php echo h($evidence['Evidence']['id']); ?>&nbsp;</td>
		<td><?php echo h($evidence['Evidence']['title']); ?>&nbsp;</td>
		<td><?php echo h($evidence['Evidence']['content']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evidence['User']['name'], array('controller' => 'users', 'action' => 'view', $evidence['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evidence['Quest']['title'], array('controller' => 'quests', 'action' => 'view', $evidence['Quest']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evidence['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'])); ?>
		</td>
		<td><?php echo h($evidence['Evidence']['created']); ?>&nbsp;</td>
		<td><?php echo h($evidence['Evidence']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evidence['Evidence']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evidence['Evidence']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evidence['Evidence']['id']), null, __('Are you sure you want to delete # %s?', $evidence['Evidence']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Evidence'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Quests'), array('controller' => 'quests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quest'), array('controller' => 'quests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
