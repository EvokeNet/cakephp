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

	<h2><?php echo __('Add Group'); ?></h2>
	<?php
		echo $this->Form->input('title', array('required' => true));
		if(isset($mission)) 
			echo $this->Form->hidden('mission_id', array('value' => $mission['Mission']['id']));
		else
			echo $this->Form->input('mission_id');
		echo $this->Form->hidden('user_id', array('value' => $userid));
		echo $this->Form->input('description', array('required' => true, 'type' => 'textarea'));

	?>

<?php //echo $this->Form->end(__('Create Group')); ?>

<button type="submit" class= "evoke button general"><?= strtoupper(__('Create Group')) ?></button>
</div>