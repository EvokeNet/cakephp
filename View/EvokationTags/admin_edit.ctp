<div class="evokationTags form">
<?php echo $this->Form->create('EvokationTag'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Evokation Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('evokation_id');
		echo $this->Form->input('tag_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EvokationTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EvokationTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Evokation Tags'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Evokations'), array('controller' => 'evokations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evokation'), array('controller' => 'evokations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
