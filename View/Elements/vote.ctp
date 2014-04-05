<!-- Form for rating an evidence -->

<?php echo $this->Form->create('Vote', array('controller' => 'votes', 'action' => 'add')); ?>
	<fieldset>
		<legend><h3><?php echo __('Rate this evidence'); ?></h3></legend>
	<?php
		echo $this->Form->hidden('evokation_id', array('value' => $evokation_id));
		echo $this->Form->hidden('user_id', array('value' => $user_id));
		echo $this->Form->input('value', array(
			'div' => 'vote_radio',
		    'type' => 'radio',
		    'options' => array(1, 2, 3, 4, 5),
		    'legend' => false,
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Send vote')); ?>