<?php if(($user_id)) : ?>
	<?php echo $this->Form->create('Vote', array('controller' => 'votes', 'action' => 'add')); ?>
		<fieldset>
			<legend><h3><?php echo __('Rate this evidence'); ?></h3></legend>
		<?php
			echo $this->Form->hidden('evokation_id', array('value' => $evokation_id));
			echo $this->Form->hidden('user_id', array('value' => $user_id));
			echo $this->Form->hidden('evokation_update_id', array('value' => $update_id));
			echo $this->Form->input('value', array(
				'div' => 'vote_radio',
			    'type' => 'radio',
			    'options' => array(1, 2, 3, 4, 5),
			    'legend' => false,
			));
		?>
		</fieldset>
	<?php //echo $this->Form->end(__('Send vote')); ?>

	<button type="submit" class= "evoke button general submit-button-margin"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Vote')) ?></button>
<?php else :?>
	<h1><?php echo __('Agent, log in to rate this evokation'); ?></h1>
	
	<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>" class= "evoke button general submit-button-margin">
		<?= strtoupper(__('Log in')) ?>
	</a>
<?php endif; ?>