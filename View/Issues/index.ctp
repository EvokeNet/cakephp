<div class="issues index">
	<h2><?php echo __('Issues'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($issues as $issue): ?>
	<tr>
		<td><?php echo h($issue['Issue']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($issue['ParentIssue']['name'], array('controller' => 'issues', 'action' => 'view', $issue['ParentIssue']['id'])); ?>
		</td>
		<td><?php echo h($issue['Issue']['name']); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['slug']); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['created']); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $issue['Issue']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $issue['Issue']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $issue['Issue']['id']), null, __('Are you sure you want to delete # %s?', $issue['Issue']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Issue'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
