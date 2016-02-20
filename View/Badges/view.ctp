<div class="badges view">
<h2><?php echo __('Badge'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($badge['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $badge['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($badge['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $badge['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Es'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['name_es']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description Es'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['description_es']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Power Points Only'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['power_points_only']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trigger'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['trigger']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['language']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Badge'), array('action' => 'edit', $badge['Badge']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Badge'), array('action' => 'delete', $badge['Badge']['id']), array(), __('Are you sure you want to delete # %s?', $badge['Badge']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Badges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Badge'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Badge Power Points'), array('controller' => 'badge_power_points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Badge Power Point'), array('controller' => 'badge_power_points', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Badge Power Points'); ?></h3>
	<?php if (!empty($badge['BadgePowerPoint'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Badge Id'); ?></th>
		<th><?php echo __('Power Points Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($badge['BadgePowerPoint'] as $badgePowerPoint): ?>
		<tr>
			<td><?php echo $badgePowerPoint['id']; ?></td>
			<td><?php echo $badgePowerPoint['badge_id']; ?></td>
			<td><?php echo $badgePowerPoint['power_points_id']; ?></td>
			<td><?php echo $badgePowerPoint['quantity']; ?></td>
			<td><?php echo $badgePowerPoint['created']; ?></td>
			<td><?php echo $badgePowerPoint['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'badge_power_points', 'action' => 'view', $badgePowerPoint['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'badge_power_points', 'action' => 'edit', $badgePowerPoint['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'badge_power_points', 'action' => 'delete', $badgePowerPoint['id']), array(), __('Are you sure you want to delete # %s?', $badgePowerPoint['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Badge Power Point'), array('controller' => 'badge_power_points', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
