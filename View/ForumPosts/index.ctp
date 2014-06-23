<div class="forumPosts index">
	<h2><?php echo __('Forum Posts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('forum_id'); ?></th>
			<th><?php echo $this->Paginator->sort('forum_topic_id'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forumPosts as $forumPost): ?>
	<tr>
		<td><?php echo h($forumPost['ForumPost']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($forumPost['User']['name'], array('controller' => 'users', 'action' => 'view', $forumPost['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($forumPost['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forumPost['Forum']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($forumPost['ForumTopic']['title'], array('controller' => 'forum_topics', 'action' => 'view', $forumPost['ForumTopic']['id'])); ?>
		</td>
		<td><?php echo h($forumPost['ForumPost']['content']); ?>&nbsp;</td>
		<td><?php echo h($forumPost['ForumPost']['created']); ?>&nbsp;</td>
		<td><?php echo h($forumPost['ForumPost']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $forumPost['ForumPost']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $forumPost['ForumPost']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $forumPost['ForumPost']['id']), array(), __('Are you sure you want to delete # %s?', $forumPost['ForumPost']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Forum Post'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
	</ul>
</div>
