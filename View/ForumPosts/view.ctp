<div class="forumPosts view">
<h2><?php echo __('Forum Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumPost['User']['name'], array('controller' => 'users', 'action' => 'view', $forumPost['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumPost['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forumPost['Forum']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum Topic'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumPost['ForumTopic']['title'], array('controller' => 'forum_topics', 'action' => 'view', $forumPost['ForumTopic']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forum Post'), array('action' => 'edit', $forumPost['ForumPost']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forum Post'), array('action' => 'delete', $forumPost['ForumPost']['id']), array(), __('Are you sure you want to delete # %s?', $forumPost['ForumPost']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Forums'); ?></h3>
	<?php if (!empty($forumPost['Forum'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Topic Count'); ?></th>
		<th><?php echo __('Post Count'); ?></th>
		<th><?php echo __('Forum Topic Id'); ?></th>
		<th><?php echo __('Forum Post Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forumPost['Forum'] as $forum): ?>
		<tr>
			<td><?php echo $forum['id']; ?></td>
			<td><?php echo $forum['user_id']; ?></td>
			<td><?php echo $forum['title']; ?></td>
			<td><?php echo $forum['slug']; ?></td>
			<td><?php echo $forum['description']; ?></td>
			<td><?php echo $forum['topic_count']; ?></td>
			<td><?php echo $forum['post_count']; ?></td>
			<td><?php echo $forum['forum_topic_id']; ?></td>
			<td><?php echo $forum['forum_post_id']; ?></td>
			<td><?php echo $forum['created']; ?></td>
			<td><?php echo $forum['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forums', 'action' => 'view', $forum['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forums', 'action' => 'edit', $forum['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forums', 'action' => 'delete', $forum['id']), array(), __('Are you sure you want to delete # %s?', $forum['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
