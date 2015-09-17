<?php if(($user_id)) : ?>

	<?php echo $this->Form->create('Comment', array('controller' => 'comments', 'action' => 'add')); ?>
		<h1><?php echo __('Share a Thought'); ?></h1>
		<?php
			echo $this->Form->hidden('evokation_id', array('value' => $evokation_id));
			echo $this->Form->hidden('user_id', array('value' => $user_id));
			echo $this->Form->hidden('evokation_update_id', array('value' => $updateId));
			echo $this->Form->input('content', array('label' => false));
		?>

	<button type="submit" class= "evoke button general submit-button-margin"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i>
		<?= strtoupper(__('Post')) ?>
	</button>
	<?php //echo $this->Form->end(); ?>
<?php else :?>
	<h1><?php echo __('Agent, log in to share a thought'); ?></h1>
	
	<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>" class= "evoke button general submit-button-margin">
		<?= strtoupper(__('Log in')) ?>
	</a>
<?php endif; ?>