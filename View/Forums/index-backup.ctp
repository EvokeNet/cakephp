<?php
/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

<div class="centering-block">
	<div class="forums index">
		<h2 class="evoke text-glow"><?php echo __('Forums'); ?></h2>
		<table cellpadding="0" cellspacing="0" class="centered-block">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('can_create'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('updated'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($forums as $forum): ?>
		<tr>
			<td><?php echo h($forum['Forum']['id']); ?>&nbsp;</td>
			<td><?php echo h($forum['Forum']['can_create']); ?>&nbsp;</td>
			<td><?php echo h($forum['Forum']['created']); ?>&nbsp;</td>
			<td><?php echo h($forum['Forum']['updated']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $forum['Forum']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $forum['Forum']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $forum['Forum']['id']), array(), __('Are you sure you want to delete # %s?', $forum['Forum']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New Forum'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Forum Discussions'), array('controller' => 'forum_discussions', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Forum Discussion'), array('controller' => 'forum_discussions', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Forum Filters'), array('controller' => 'forum_filters', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Forum Filter'), array('controller' => 'forum_filters', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
