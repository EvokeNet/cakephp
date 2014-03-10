<div class="groups view">
<h2><?php echo __('Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($group['Group']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($group['Group']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($group['User']['name'], array('controller' => 'users', 'action' => 'view', $group['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($group['Group']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($group['Group']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group'), array('action' => 'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group'), array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evokations'), array('controller' => 'evokations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation'), array('controller' => 'evokations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Evokations'); ?></h3>
	<?php if (!empty($group['Evokation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Gdrive File Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Abstract'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($group['Evokation'] as $evokation): ?>
		<tr>
			<td><?php echo $evokation['id']; ?></td>
			<td><?php echo $evokation['group_id']; ?></td>
			<td><?php echo $evokation['gdrive_file_id']; ?></td>
			<td><?php echo $evokation['title']; ?></td>
			<td><?php echo $evokation['abstract']; ?></td>
			<td><?php echo $evokation['language']; ?></td>
			<td><?php echo $evokation['created']; ?></td>
			<td><?php echo $evokation['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'evokations', 'action' => 'view', $evokation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'evokations', 'action' => 'edit', $evokation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'evokations', 'action' => 'delete', $evokation['id']), null, __('Are you sure you want to delete # %s?', $evokation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Evokation'), array('controller' => 'evokations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($group['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Facebook Id'); ?></th>
		<th><?php echo __('Facebook Token'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Birthdate'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Biography'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Facebook'); ?></th>
		<th><?php echo __('Twitter'); ?></th>
		<th><?php echo __('Instagram'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('Blog'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($group['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['role_id']; ?></td>
			<td><?php echo $user['facebook_id']; ?></td>
			<td><?php echo $user['facebook_token']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['birthdate']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['sex']; ?></td>
			<td><?php echo $user['biography']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['facebook']; ?></td>
			<td><?php echo $user['twitter']; ?></td>
			<td><?php echo $user['instagram']; ?></td>
			<td><?php echo $user['website']; ?></td>
			<td><?php echo $user['blog']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
