<?php echo $this->Form->create('Comment', array('controller' => 'comments', 'action' => 'add')); ?>
	<h1><?php echo __('Share a Thought'); ?></h1>
	<?php
		echo $this->Form->hidden('evidence_id', array('value' => $evidence_id));
		echo $this->Form->hidden('user_id', array('value' => $user_id));
		echo $this->Form->input('content', array('label' => false));
	?>

<button type="submit" class= "evoke button general submit-button-margin"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Post')) ?></button>
