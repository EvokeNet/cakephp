<div class="forumPosts view">
<h2><?php echo __('Forum Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($forumPost['ForumPost']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumPost['User']['name'], array('controller' => 'users', 'action' => 'view', $forumPost['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum Topic'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumPost['ForumTopic']['title'], array('controller' => 'forum_topics', 'action' => 'view', $forumPost['ForumTopic']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
	</ul>
</div>
