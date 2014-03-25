<div class="evokationTags view">
<h2><?php echo __('Evokation Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($evokationTag['EvokationTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evokation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evokationTag['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $evokationTag['Evokation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo $this->Html->link($evokationTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $evokationTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($evokationTag['EvokationTag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($evokationTag['EvokationTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Evokation Tag'), array('action' => 'edit', $evokationTag['EvokationTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Evokation Tag'), array('action' => 'delete', $evokationTag['EvokationTag']['id']), null, __('Are you sure you want to delete # %s?', $evokationTag['EvokationTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Evokation Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Evokations'), array('controller' => 'evokations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation'), array('controller' => 'evokations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
