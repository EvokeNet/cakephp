<div class="forums view">
<h2><?php echo __('Forum'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forum['User']['name'], array('controller' => 'users', 'action' => 'view', $forum['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Topic Count'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['topic_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Count'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['post_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum Topic Id'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['forum_topic_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum Post Id'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['forum_post_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($forum['Forum']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forum'), array('action' => 'edit', $forum['Forum']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forum'), array('action' => 'delete', $forum['Forum']['id']), array(), __('Are you sure you want to delete # %s?', $forum['Forum']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Subscriptions'), array('controller' => 'forum_subscriptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Subscription'), array('controller' => 'forum_subscriptions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Forum Posts'); ?></h3>
	<?php if (!empty($forum['ForumPost'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Forum Id'); ?></th>
		<th><?php echo __('Topic Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('UserIP'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Up'); ?></th>
		<th><?php echo __('Down'); ?></th>
		<th><?php echo __('Score'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forum['ForumPost'] as $forumPost): ?>
		<tr>
			<td><?php echo $forumPost['id']; ?></td>
			<td><?php echo $forumPost['forum_id']; ?></td>
			<td><?php echo $forumPost['topic_id']; ?></td>
			<td><?php echo $forumPost['user_id']; ?></td>
			<td><?php echo $forumPost['userIP']; ?></td>
			<td><?php echo $forumPost['content']; ?></td>
			<td><?php echo $forumPost['up']; ?></td>
			<td><?php echo $forumPost['down']; ?></td>
			<td><?php echo $forumPost['score']; ?></td>
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
<div class="related">
	<h3><?php echo __('Related Forum Subscriptions'); ?></h3>
	<?php if (!empty($forum['ForumSubscription'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Forum Id'); ?></th>
		<th><?php echo __('Topic Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forum['ForumSubscription'] as $forumSubscription): ?>
		<tr>
			<td><?php echo $forumSubscription['id']; ?></td>
			<td><?php echo $forumSubscription['user_id']; ?></td>
			<td><?php echo $forumSubscription['forum_id']; ?></td>
			<td><?php echo $forumSubscription['topic_id']; ?></td>
			<td><?php echo $forumSubscription['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forum_subscriptions', 'action' => 'view', $forumSubscription['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forum_subscriptions', 'action' => 'edit', $forumSubscription['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forum_subscriptions', 'action' => 'delete', $forumSubscription['id']), array(), __('Are you sure you want to delete # %s?', $forumSubscription['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Forum Subscription'), array('controller' => 'forum_subscriptions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Forum Topics'); ?></h3>
	<?php if (!empty($forum['ForumTopic'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Forum Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Excerpt'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Post Count'); ?></th>
		<th><?php echo __('View Count'); ?></th>
		<th><?php echo __('FirstPost Id'); ?></th>
		<th><?php echo __('LastPost Id'); ?></th>
		<th><?php echo __('LastUser Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($forum['ForumTopic'] as $forumTopic): ?>
		<tr>
			<td><?php echo $forumTopic['id']; ?></td>
			<td><?php echo $forumTopic['forum_id']; ?></td>
			<td><?php echo $forumTopic['user_id']; ?></td>
			<td><?php echo $forumTopic['title']; ?></td>
			<td><?php echo $forumTopic['slug']; ?></td>
			<td><?php echo $forumTopic['excerpt']; ?></td>
			<td><?php echo $forumTopic['status']; ?></td>
			<td><?php echo $forumTopic['type']; ?></td>
			<td><?php echo $forumTopic['post_count']; ?></td>
			<td><?php echo $forumTopic['view_count']; ?></td>
			<td><?php echo $forumTopic['firstPost_id']; ?></td>
			<td><?php echo $forumTopic['lastPost_id']; ?></td>
			<td><?php echo $forumTopic['lastUser_id']; ?></td>
			<td><?php echo $forumTopic['created']; ?></td>
			<td><?php echo $forumTopic['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'forum_topics', 'action' => 'view', $forumTopic['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'forum_topics', 'action' => 'edit', $forumTopic['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'forum_topics', 'action' => 'delete', $forumTopic['id']), array(), __('Are you sure you want to delete # %s?', $forumTopic['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
