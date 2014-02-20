<div class="phases form">
<?php echo $this->Form->create('Phase'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Phase'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Phase.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Phase.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Phases'), array('action' => 'index')); ?></li>
	</ul>
</div>
