<div class="forumCategories view">
<h2><?php echo __('Forum Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($forumCategory['ForumCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($forumCategory['ForumCategory']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($forumCategory['ForumCategory']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($forumCategory['ForumCategory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($forumCategory['ForumCategory']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Forum'); ?></dt>
		<dd>
			<?php echo $this->Html->link($forumCategory['Forum']['title'], array('controller' => 'forums', 'action' => 'view', $forumCategory['Forum']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($forumCategory['ForumCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($forumCategory['ForumCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forum Category'), array('action' => 'edit', $forumCategory['ForumCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forum Category'), array('action' => 'delete', $forumCategory['ForumCategory']['id']), array(), __('Are you sure you want to delete # %s?', $forumCategory['ForumCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
	</ul>
</div>
