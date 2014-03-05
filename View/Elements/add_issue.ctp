<div class="userIssues form">
<?php echo $this->Form->create('UserIssue', array('controller' => 'userissues', 'action' => 'add', 'name' => 'formIssue')); ?>
	<fieldset>
		<!-- <legend><?php echo __('Add User Issue'); ?></legend> -->
	<?php
		echo $this->Form->hidden('user_id', array('value' => $user_id));
		echo $this->Form->input('issue_id', array('type' => 'select', 'multiple' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>