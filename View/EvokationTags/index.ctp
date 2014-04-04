<div class="evokationTags index">
	<h2><?php echo __('Evokation Tags'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('evokation_id'); ?></th>
			<th><?php echo $this->Paginator->sort('tag_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evokationTags as $evokationTag): ?>
	<tr>
		<td><?php echo h($evokationTag['EvokationTag']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($evokationTag['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $evokationTag['Evokation']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evokationTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $evokationTag['Tag']['id'])); ?>
		</td>
		<td><?php echo h($evokationTag['EvokationTag']['created']); ?>&nbsp;</td>
		<td><?php echo h($evokationTag['EvokationTag']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evokationTag['EvokationTag']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evokationTag['EvokationTag']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evokationTag['EvokationTag']['id']), null, __('Are you sure you want to delete # %s?', $evokationTag['EvokationTag']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Evokation Tag'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Evokations'), array('controller' => 'evokations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation'), array('controller' => 'evokations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
