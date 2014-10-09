<div class="forums form">
<?php echo $this->Form->create('Forum'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Forum'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('slug');
		echo $this->Form->input('description');
		echo $this->Form->input('topic_count');
		echo $this->Form->input('post_count');
		echo $this->Form->input('lastTopic_id');
		echo $this->Form->input('lastPost_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Forums'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Posts'), array('controller' => 'forum_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Post'), array('controller' => 'forum_posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forum Topics'), array('controller' => 'forum_topics', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum Topic'), array('controller' => 'forum_topics', 'action' => 'add')); ?> </li>
	</ul>
</div>
