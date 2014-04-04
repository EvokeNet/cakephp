<div class="evidenceTags form">
<?php echo $this->Form->create('EvidenceTag'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Evidence Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('evidence_id');
		echo $this->Form->input('tag_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EvidenceTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('EvidenceTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Evidence Tags'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
