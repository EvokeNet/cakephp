<div class="userIssues form">
<?php echo $this->Form->create('UserIssue'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Issue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('issue_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserIssue.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserIssue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Issues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
