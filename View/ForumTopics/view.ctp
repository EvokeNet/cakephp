<div class="forumTopics view">
<h2><?php echo __('Forum Topic'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('View Count'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['view_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumTopic['User']['name'], array('controller' => 'users', 'action' => 'view', $forumTopic['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumTopic['Forum']['id'], array('controller' => 'forums', 'action' => 'view', $forumTopic['Forum']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($forumTopic['ForumTopic']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forum Topic'), array('action' => 'edit', $forumTopic['ForumTopic']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forum Topic'), array('action' => 'delete', $forumTopic['ForumTopic']['id']), array(), __('Are you sure you want to delete # %s?', $forumTopic['ForumTopic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Forum Posts'); ?></h3>
	<?php if (!empty($forumTopic['ForumPost'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Forum Id'); ?></th>
		<th><?php echo __('Forum Topic Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forumTopic['ForumPost'] as $forumPost): ?>
		<tr>
			<td><?php echo $forumPost['id']; ?></td>
			<td><?php echo $forumPost['title']; ?></td>
			<td><?php echo $forumPost['slug']; ?></td>
			<td><?php echo $forumPost['description']; ?></td>
			<td><?php echo $forumPost['user_id']; ?></td>
			<td><?php echo $forumPost['forum_id']; ?></td>
			<td><?php echo $forumPost['forum_topic_id']; ?></td>
			<td><?php echo $forumPost['created']; ?></td>
			<td><?php echo $forumPost['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forum_posts', 'action' => 'view', $forumPost['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forum_posts', 'action' => 'edit', $forumPost['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forum_posts', 'action' => 'delete', $forumPost['id']), array(), __('Are you sure you want to delete # %s?', $forumPost['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
