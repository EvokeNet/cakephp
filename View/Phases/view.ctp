<div class="phases view">
<h2><?php echo __('Phase'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($phase['Phase']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($phase['Phase']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($phase['Phase']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($phase['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $phase['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($phase['Phase']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($phase['Phase']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($phase['Phase']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($phase['Phase']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Phase'), array('action' => 'edit', $phase['Phase']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Phase'), array('action' => 'delete', $phase['Phase']['id']), null, __('Are you sure you want to delete # %s?', $phase['Phase']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Phases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Phase'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
	</ul>
</div>
