<div class="evokationFollowers view">
<h2><?php echo __('Evokation Follower'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evokationFollower['EvokationFollower']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evokationFollower['User']['name'], array('controller' => 'users', 'action' => 'view', $evokationFollower['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evokation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evokationFollower['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $evokationFollower['Evokation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evokationFollower['EvokationFollower']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evokationFollower['EvokationFollower']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evokation Follower'), array('action' => 'edit', $evokationFollower['EvokationFollower']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evokation Follower'), array('action' => 'delete', $evokationFollower['EvokationFollower']['id']), null, __('Are you sure you want to delete # %s?', $evokationFollower['EvokationFollower']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evokation Followers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation Follower'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evokations'), array('controller' => 'evokations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation'), array('controller' => 'evokations', 'action' => 'add')); ?> </li>
	</ul>
</div>
