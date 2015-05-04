<div class="issues form">
<?php echo $this->Form->create('Issue'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Issue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Issue.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Issue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
