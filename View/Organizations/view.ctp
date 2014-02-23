<div class="organizations view">
<h2><?php echo __('Organization'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthdate'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['birthdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facerbook'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['facerbook']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['twitter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Blog'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['blog']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Organization'), array('action' => 'edit', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Organization'), array('action' => 'delete', $organization['Organization']['id']), null, __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Missions'); ?></h3>
	<?php if (!empty($organization['Mission'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('Language'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organization['Mission'] as $mission): ?>
		<tr>
			<td><?php echo $mission['id']; ?></td>
			<td><?php echo $mission['organization_id']; ?></td>
			<td><?php echo $mission['title']; ?></td>
			<td><?php echo $mission['description']; ?></td>
			<td><?php echo $mission['image']; ?></td>
			<td><?php echo $mission['language']; ?></td>
			<td><?php echo $mission['created']; ?></td>
			<td><?php echo $mission['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'missions', 'action' => 'view', $mission['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'missions', 'action' => 'edit', $mission['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'missions', 'action' => 'delete', $mission['id']), null, __('Are you sure you want to delete # %s?', $mission['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
