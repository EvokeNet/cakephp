<div class="votes view">
<h2><?php echo __('Vote'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vote['Vote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evidence'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vote['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $vote['Evidence']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vote['User']['name'], array('controller' => 'users', 'action' => 'view', $vote['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($vote['Vote']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vote['Vote']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($vote['Vote']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vote'), array('action' => 'edit', $vote['Vote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vote'), array('action' => 'delete', $vote['Vote']['id']), null, __('Are you sure you want to delete # %s?', $vote['Vote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Votes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vote'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
