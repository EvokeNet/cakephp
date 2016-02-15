<div class="superheroIdentities form">
<?php echo $this->Form->create('SuperheroIdentity'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Superhero Identity'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('quality_1');
		echo $this->Form->input('quality_2');
		echo $this->Form->input('primaryPower');
		echo $this->Form->input('secondaryPower');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SuperheroIdentity.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('SuperheroIdentity.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Superhero Identities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Social Innovator Qualities'), array('controller' => 'social_innovator_qualities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quality1'), array('controller' => 'social_innovator_qualities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Powers'), array('controller' => 'powers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Power1'), array('controller' => 'powers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
