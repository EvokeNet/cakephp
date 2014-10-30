<div class="matchingQuestions form">
<?php echo $this->Form->create('MatchingQuestion'); ?>
	<fieldset>
		<legend><?php echo __('Add Matching Question'); ?></legend>
	<?php
		echo $this->Form->input('matching_question');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Matching Questions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List User Matching Answers'), array('controller' => 'user_matching_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Matching Answer'), array('controller' => 'user_matching_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
