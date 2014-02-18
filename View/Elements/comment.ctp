
<?php echo $this->Form->create('Comment', array('controller' => 'comments', 'action' => 'add')); ?>
	<fieldset>
	<legend><h3><?php echo __('Share a Thought'); ?></h3></legend>
	<?php
		echo $this->Form->hidden('evidence_id', array('value' => $evidence_id));
		echo $this->Form->hidden('user_id', array('value' => $user_id));
		echo $this->Form->input('content', array('label' => false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
