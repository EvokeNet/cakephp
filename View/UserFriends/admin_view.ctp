<div class="userFriends view">
<h2><?php echo __('User Friend'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userFriend['User']['name'], array('controller' => 'users', 'action' => 'view', $userFriend['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Friend Id'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['friend_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userFriend['UserFriend']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Friend'), array('action' => 'edit', $userFriend['UserFriend']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Friend'), array('action' => 'delete', $userFriend['UserFriend']['id']), null, __('Are you sure you want to delete # %s?', $userFriend['UserFriend']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Friends'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Friend'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
