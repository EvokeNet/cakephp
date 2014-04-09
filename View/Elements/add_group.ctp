<div class="groups form">
<?php
	if(isset($mission))
		echo $this->Form->create('Group', array(
			'controller' => 'groups',
			'action' => 'add'
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

		if(isset($groups[0]) && $groups[0]['Group']['max_global'] != 0) {
			$opt = array();
			for($i = 2; $i <= $groups[0]['Group']['max_global']; $i++)
				$opt[$i] =  $i;

			echo $this->Form->input('max_local', array(
				'label' => __('Limit of agents of this group: '),
				'type' => 'select',
				'options' => $opt,
				'selected' => $groups[0]['Group']['max_global']
			));	

			echo $this->Form->hidden('max_global', array('value' => $groups[0]['Group']['max_global']));
		} else {
			echo $this->Form->input('max_local', array(
				'label' => __('Limit of agents of this group: ')
			));	
		}

	?>
	</fieldset>
	<button class="button small" type="submit">
		<?php echo __('Create Group')?>
	</button>
	<?php echo $this->Form->end(); ?>
</div>