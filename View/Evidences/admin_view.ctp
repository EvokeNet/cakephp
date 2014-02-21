<div class="evidences view">
<h2><?php echo __('Evidence'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidence['User']['name'], array('controller' => 'users', 'action' => 'view', $evidence['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quest'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidence['Quest']['title'], array('controller' => 'quests', 'action' => 'view', $evidence['Quest']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evidence['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $evidence['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evidence['Evidence']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evidence'), array('action' => 'edit', $evidence['Evidence']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evidence'), array('action' => 'delete', $evidence['Evidence']['id']), null, __('Are you sure you want to delete # %s?', $evidence['Evidence']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Quests'), array('controller' => 'quests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quest'), array('controller' => 'quests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($evidence['Comment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Evidence Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evidence['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['id']; ?></td>
			<td><?php echo $comment['evidence_id']; ?></td>
			<td><?php echo $comment['user_id']; ?></td>
			<td><?php echo $comment['created']; ?></td>
			<td><?php echo $comment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Votes'); ?></h3>
	<?php if (!empty($evidence['Vote'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Evidence Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($evidence['Vote'] as $vote): ?>
		<tr>
			<td><?php echo $vote['id']; ?></td>
			<td><?php echo $vote['evidence_id']; ?></td>
			<td><?php echo $vote['user_id']; ?></td>
			<td><?php echo $vote['created']; ?></td>
			<td><?php echo $vote['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'votes', 'action' => 'view', $vote['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'votes', 'action' => 'edit', $vote['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'votes', 'action' => 'delete', $vote['id']), null, __('Are you sure you want to delete # %s?', $vote['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
