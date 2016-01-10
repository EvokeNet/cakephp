<div class="forumTopics form">
<?php echo $this->Form->create('ForumTopic'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Forum Topic'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('slug');
		echo $this->Form->input('content');
		echo $this->Form->input('status');
		echo $this->Form->input('view_count');
		echo $this->Form->input('user_id');
		echo $this->Form->input('forum_categorie_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ForumTopic.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ForumTopic.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Categories'), array('controller' => 'forum_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Categorie'), array('controller' => 'forum_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
