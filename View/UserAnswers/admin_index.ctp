<div class="userAnswers index">
	<h2><?php echo __('User Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_id'); ?></th>
			<th><?php echo $this->Paginator->sort('answer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userAnswers as $userAnswer): ?>
	<tr>
		<td><?php echo h($userAnswer['UserAnswer']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userAnswer['User']['name'], array('controller' => 'users', 'action' => 'view', $userAnswer['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userAnswer['Question']['description'], array('controller' => 'questions', 'action' => 'view', $userAnswer['Question']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userAnswer['Answer']['description'], array('controller' => 'answers', 'action' => 'view', $userAnswer['Answer']['id'])); ?>
		</td>
		<td><?php echo h($userAnswer['UserAnswer']['description']); ?>&nbsp;</td>
		<td><?php echo h($userAnswer['UserAnswer']['created']); ?>&nbsp;</td>
		<td><?php echo h($userAnswer['UserAnswer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userAnswer['UserAnswer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userAnswer['UserAnswer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userAnswer['UserAnswer']['id']), null, __('Are you sure you want to delete # %s?', $userAnswer['UserAnswer']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User Answer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Answers'), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer'), array('controller' => 'answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
