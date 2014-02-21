<div class="quests view">
<h2><?php echo __('Quest'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($quest['Quest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($quest['Quest']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($quest['Quest']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($quest['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $quest['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($quest['Quest']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($quest['Quest']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Quest'), array('action' => 'edit', $quest['Quest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Quest'), array('action' => 'delete', $quest['Quest']['id']), null, __('Are you sure you want to delete # %s?', $quest['Quest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Quests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quest'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Evidences'); ?></h3>
	<?php if (!empty($quest['Evidence'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Quest Id'); ?></th>
		<th><?php echo __('Mission Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($quest['Evidence'] as $evidence): ?>
		<tr>
			<td><?php echo $evidence['id']; ?></td>
			<td><?php echo $evidence['title']; ?></td>
			<td><?php echo $evidence['content']; ?></td>
			<td><?php echo $evidence['user_id']; ?></td>
			<td><?php echo $evidence['quest_id']; ?></td>
			<td><?php echo $evidence['mission_id']; ?></td>
			<td><?php echo $evidence['created']; ?></td>
			<td><?php echo $evidence['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'evidences', 'action' => 'view', $evidence['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'evidences', 'action' => 'edit', $evidence['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'evidences', 'action' => 'delete', $evidence['id']), null, __('Are you sure you want to delete # %s?', $evidence['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
