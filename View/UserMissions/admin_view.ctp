<div class="userMissions view">
<h2><?php echo __('User Mission'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userMission['UserMission']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userMission['User']['name'], array('controller' => 'users', 'action' => 'view', $userMission['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userMission['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $userMission['Mission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userMission['UserMission']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userMission['UserMission']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Mission'), array('action' => 'edit', $userMission['UserMission']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Mission'), array('action' => 'delete', $userMission['UserMission']['id']), null, __('Are you sure you want to delete # %s?', $userMission['UserMission']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Missions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Mission'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Missions'), array('controller' => 'missions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mission'), array('controller' => 'missions', 'action' => 'add')); ?> </li>
	</ul>
</div>
