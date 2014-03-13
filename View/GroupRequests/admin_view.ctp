<div class="groupRequests view">
<h2><?php echo __('Group Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupRequest['GroupRequest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupRequest['User']['name'], array('controller' => 'users', 'action' => 'view', $groupRequest['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupRequest['Group']['title'], array('controller' => 'groups', 'action' => 'view', $groupRequest['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($groupRequest['GroupRequest']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($groupRequest['GroupRequest']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($groupRequest['GroupRequest']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group Request'), array('action' => 'edit', $groupRequest['GroupRequest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group Request'), array('action' => 'delete', $groupRequest['GroupRequest']['id']), null, __('Are you sure you want to delete # %s?', $groupRequest['GroupRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Request'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
