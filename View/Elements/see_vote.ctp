<!-- Form for edit the rating of an evidence -->

<?php echo $this->Form->create('Vote', array('url' =>  array('controller' => 'votes', 'action' => 'edit', $vote_id))); ?>
	<fieldset>
		<legend><h3><?php echo __('Rate this evidence'); ?></h3></legend>
	<?php
		// echo $vote_id;
		echo $this->Form->input('id', array('value' => $vote_id));
		echo $this->Form->hidden('evidence_id', array('value' => $evidence_id));
		echo $this->Form->hidden('user_id', array('value' => $user_id));
		echo $this->Form->input('value', array(
			'div' => 'vote_radio',
		    'type' => 'radio',
		    'value' => $vote_value,
		    'options' => array(1, 2, 3, 4, 5),
		    'legend' => false,
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Change Vote')); ?>