<div class="users index">
	<h2><?php echo ('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('birthdate'); ?></th>
			<th><?php echo $this->Paginator->sort('sex'); ?></th>
			<th><?php echo $this->Paginator->sort('biography'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('facebook'); ?></th>
			<th><?php echo $this->Paginator->sort('twitter'); ?></th>
			<th><?php echo $this->Paginator->sort('instagram'); ?></th>
			<th><?php echo $this->Paginator->sort('website'); ?></th>
			<th><?php echo $this->Paginator->sort('blog'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('role'); ?></th>
			<th class="actions"><?php echo ('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['birthdate']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['sex']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['biography']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['facebook']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['twitter']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['instagram']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['website']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['blog']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(('Delete'), array('action' => 'delete', $user['User']['id']), null, ('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => ('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . ('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo ('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(('List Points'), array('controller' => 'points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(('New Point'), array('controller' => 'points', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(('List User Badges'), array('controller' => 'user_badges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(('New User Badge'), array('controller' => 'user_badges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(('List User Organizations'), array('controller' => 'user_organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(('New User Organization'), array('controller' => 'user_organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(('List Votes'), array('controller' => 'votes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(('New Vote'), array('controller' => 'votes', 'action' => 'add')); ?> </li>
	</ul>
</div>
