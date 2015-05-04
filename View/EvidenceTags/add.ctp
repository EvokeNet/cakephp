<div class="evidenceTags form">
<?php echo $this->Form->create('EvidenceTag'); ?>
	<fieldset>
		<legend><?php echo __('Add Evidence Tag'); ?></legend>
	<?php
		echo $this->Form->input('evidence_id');
		echo $this->Chosen->select(
		    'tag_id',
		    array(1, 2),
		    array('data-placeholder' => '', 'multiple' => true, 'class' => 'chzn-select', 'default' => 1)
		);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Evidence Tags'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
