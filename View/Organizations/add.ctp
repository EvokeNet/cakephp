<div class="organizations form">
<?php echo $this->Form->create('Organization'); ?>
	<fieldset>
		<legend><?php echo __('Add Organization'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('birthdate');
		echo $this->Form->input('description');
		echo $this->Form->input('website');
		echo $this->Form->input('facerbook');
		echo $this->Form->input('twitter');
		echo $this->Form->input('blog');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Organizations'), array('action' => 'index')); ?></li>
	</ul>
</div>
