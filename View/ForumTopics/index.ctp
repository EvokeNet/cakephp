<div class="forumTopics index">
	<h2><?php echo __('Forum Topics'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('view_count'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('forum_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forumTopics as $forumTopic): ?>
	<tr>
		<td><?php echo h($forumTopic['ForumTopic']['id']); ?>&nbsp;</td>
		<td><?php echo h($forumTopic['ForumTopic']['title']); ?>&nbsp;</td>
		<td><?php echo h($forumTopic['ForumTopic']['slug']); ?>&nbsp;</td>
		<td><?php echo h($forumTopic['ForumTopic']['content']); ?>&nbsp;</td>
		<td><?php echo h($forumTopic['ForumTopic']['status']); ?>&nbsp;</td>
		<td><?php echo h($forumTopic['ForumTopic']['view_count']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($forumTopic['User']['name'], array('controller' => 'users', 'action' => 'view', $forumTopic['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($forumTopic['Forum']['id'], array('controller' => 'forums', 'action' => 'view', $forumTopic['Forum']['id'])); ?>
		</td>
		<td><?php echo h($forumTopic['ForumTopic']['created']); ?>&nbsp;</td>
		<td><?php echo h($forumTopic['ForumTopic']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $forumTopic['ForumTopic']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $forumTopic['ForumTopic']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $forumTopic['ForumTopic']['id']), array(), __('Are you sure you want to delete # %s?', $forumTopic['ForumTopic']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
