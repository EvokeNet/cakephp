<div class="forumCategories form">
<?php echo $this->Form->create('ForumCategory'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Forum Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('slug');
		echo $this->Form->input('description');
		echo $this->Form->input('user_id');
		echo $this->Form->input('forum_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ForumCategory.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ForumCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forum Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
	</ul>
</div>
