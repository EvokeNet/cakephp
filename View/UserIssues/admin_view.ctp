<div class="userIssues view">
<h2><?php echo __('User Issue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userIssue['UserIssue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userIssue['User']['name'], array('controller' => 'users', 'action' => 'view', $userIssue['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Issue'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userIssue['Issue']['name'], array('controller' => 'issues', 'action' => 'view', $userIssue['Issue']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Issue'), array('action' => 'edit', $userIssue['UserIssue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Issue'), array('action' => 'delete', $userIssue['UserIssue']['id']), null, __('Are you sure you want to delete # %s?', $userIssue['UserIssue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Issues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Issue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Issues'), array('controller' => 'issues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues', 'action' => 'add')); ?> </li>
	</ul>
</div>
