<div class="userMatchingAnswers form">
<?php echo $this->Form->create('UserMatchingAnswer'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add User Matching Answer'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('matching_question_id');
		echo $this->Form->input('matching_answer');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Matching Answers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Matching Questions'), array('controller' => 'matching_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Matching Question'), array('controller' => 'matching_questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
