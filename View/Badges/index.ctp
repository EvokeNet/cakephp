<div class="badges index">
	<h2><?php echo __('Badges'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('mission_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('name_es'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('description_es'); ?></th>
			<th><?php echo $this->Paginator->sort('power_points_only'); ?></th>
			<th><?php echo $this->Paginator->sort('trigger'); ?></th>
			<th><?php echo $this->Paginator->sort('language'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($badges as $badge): ?>
	<tr>
		<td><?php echo h($badge['Badge']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($badge['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $badge['Organization']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($badge['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $badge['Mission']['id'])); ?>
		</td>
		<td><?php echo h($badge['Badge']['name']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['name_es']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['description']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['description_es']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['power_points_only']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['trigger']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['language']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $badge['Badge']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $badge['Badge']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $badge['Badge']['id']), array(), __('Are you sure you want to delete # %s?', $badge['Badge']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
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
		<li><?php echo $this->Html->link(__('New Badge'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Badge Power Points'), array('controller' => 'badge_power_points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Badge Power Point'), array('controller' => 'badge_power_points', 'action' => 'add')); ?> </li>
	</ul>
</div>
