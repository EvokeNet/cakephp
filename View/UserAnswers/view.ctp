<div class="userAnswers view">
<h2><?php echo __('User Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userAnswer['UserAnswer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAnswer['User']['name'], array('controller' => 'users', 'action' => 'view', $userAnswer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAnswer['Question']['description'], array('controller' => 'questions', 'action' => 'view', $userAnswer['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userAnswer['Answer']['description'], array('controller' => 'answers', 'action' => 'view', $userAnswer['Answer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($userAnswer['UserAnswer']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userAnswer['UserAnswer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userAnswer['UserAnswer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Answer'), array('action' => 'edit', $userAnswer['UserAnswer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Answer'), array('action' => 'delete', $userAnswer['UserAnswer']['id']), null, __('Are you sure you want to delete # %s?', $userAnswer['UserAnswer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Answer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Answers'), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer'), array('controller' => 'answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
