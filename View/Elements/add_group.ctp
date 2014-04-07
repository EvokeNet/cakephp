<div class="groups form">
<?php
	if(isset($mission))
		echo $this->Form->create('Group', array(
			'controller' => 'groups',
			'action' => 'add',
			$mission['Mission']['id']
		));
	else
		echo $this->Form->create('Group', array(
			'controller' => 'groups',
			'action' => 'add'
		));
?>
	<fieldset>
		<legend><?php echo __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('title', array('required' => true));
		if(isset($mission)) 
			echo $this->Form->hidden('mission_id', array('value' => $mission['Mission']['id']));
		else
			echo $this->Form->input('mission_id');
		echo $this->Form->hidden('user_id', array('value' => $userid));
		echo $this->Form->input('description', array('required' => true, 'type' => 'textarea'));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Create Group')); ?>
</div>