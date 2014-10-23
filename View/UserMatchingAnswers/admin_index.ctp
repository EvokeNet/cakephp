<div class="userMatchingAnswers index">
	<h2><?php echo __('User Matching Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('matching_question_id'); ?></th>
			<th><?php echo $this->Paginator->sort('matching_answer'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userMatchingAnswers as $userMatchingAnswer): ?>
	<tr>
		<td><?php echo h($userMatchingAnswer['UserMatchingAnswer']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userMatchingAnswer['User']['name'], array('controller' => 'users', 'action' => 'view', $userMatchingAnswer['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userMatchingAnswer['MatchingQuestion']['matching_question'], array('controller' => 'matching_questions', 'action' => 'view', $userMatchingAnswer['MatchingQuestion']['id'])); ?>
		</td>
		<td><?php echo h($userMatchingAnswer['UserMatchingAnswer']['matching_answer']); ?>&nbsp;</td>
		<td><?php echo h($userMatchingAnswer['UserMatchingAnswer']['created']); ?>&nbsp;</td>
		<td><?php echo h($userMatchingAnswer['UserMatchingAnswer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userMatchingAnswer['UserMatchingAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userMatchingAnswer['UserMatchingAnswer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userMatchingAnswer['UserMatchingAnswer']['id']), array(), __('Are you sure you want to delete # %s?', $userMatchingAnswer['UserMatchingAnswer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User Matching Answer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Matching Questions'), array('controller' => 'matching_questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Matching Question'), array('controller' => 'matching_questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
