<div class="userMatchingAnswers view">
<h2><?php echo __('User Matching Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userMatchingAnswer['UserMatchingAnswer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userMatchingAnswer['User']['name'], array('controller' => 'users', 'action' => 'view', $userMatchingAnswer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Matching Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userMatchingAnswer['MatchingQuestion']['matching_question'], array('controller' => 'matching_questions', 'action' => 'view', $userMatchingAnswer['MatchingQuestion']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Matching Answer'); ?></dt>
		<dd>
			<?php echo h($userMatchingAnswer['UserMatchingAnswer']['matching_answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userMatchingAnswer['UserMatchingAnswer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userMatchingAnswer['UserMatchingAnswer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Matching Answer'), array('action' => 'edit', $userMatchingAnswer['UserMatchingAnswer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Matching Answer'), array('action' => 'delete', $userMatchingAnswer['UserMatchingAnswer']['id']), array(), __('Are you sure you want to delete # %s?', $userMatchingAnswer['UserMatchingAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Matching Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Matching Answer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Matching Questions'), array('controller' => 'matching_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Matching Question'), array('controller' => 'matching_questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
