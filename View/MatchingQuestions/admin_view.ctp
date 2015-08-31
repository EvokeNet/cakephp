<div class="matchingQuestions view">
<h2><?php echo __('Matching Question'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($matchingQuestion['MatchingQuestion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Matching Question'); ?></dt>
		<dd>
			<?php echo h($matchingQuestion['MatchingQuestion']['matching_question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($matchingQuestion['MatchingQuestion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($matchingQuestion['MatchingQuestion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Matching Question'), array('action' => 'edit', $matchingQuestion['MatchingQuestion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Matching Question'), array('action' => 'delete', $matchingQuestion['MatchingQuestion']['id']), array(), __('Are you sure you want to delete # %s?', $matchingQuestion['MatchingQuestion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Matching Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Matching Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Matching Answers'), array('controller' => 'users_matching_answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Matching Answer'), array('controller' => 'users_matching_answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users Matching Answers'); ?></h3>
	<?php if (!empty($matchingQuestion['UsersMatchingAnswer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Matching Question Id'); ?></th>
		<th><?php echo __('Matching Answer'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($matchingQuestion['UsersMatchingAnswer'] as $usersMatchingAnswer): ?>
		<tr>
			<td><?php echo $usersMatchingAnswer['id']; ?></td>
			<td><?php echo $usersMatchingAnswer['matching_question_id']; ?></td>
			<td><?php echo $usersMatchingAnswer['matching_answer']; ?></td>
			<td><?php echo $usersMatchingAnswer['created']; ?></td>
			<td><?php echo $usersMatchingAnswer['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users_matching_answers', 'action' => 'view', $usersMatchingAnswer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users_matching_answers', 'action' => 'edit', $usersMatchingAnswer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users_matching_answers', 'action' => 'delete', $usersMatchingAnswer['id']), array(), __('Are you sure you want to delete # %s?', $usersMatchingAnswer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Users Matching Answer'), array('controller' => 'users_matching_answers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
