<?php
	
    $this->extend('/Common/admin_panel');

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
			'circle'
		)
	);

?>

<?php $this->start('page_content'); ?>

<div class="row full-width" data-equalizer>
	<div class="large-10 columns" id="panel-content" data-equalizer-watch>	
		<div class="superheroIdentities form">
		<?php echo $this->Form->create('SuperheroIdentity'); ?>
			<fieldset>
				<legend><?php echo __('Admin Edit Superhero Identity'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name');
				echo $this->Form->input('description');
				echo $this->Form->input('quality_1', array('type'=>'select','label' => 'Quality 1',
		   'options' => $qualities,'empty' => '(choose one)'));
				echo $this->Form->input('quality_2', array('type'=>'select','label' => 'Quality 2',
		   'options' => $qualities,'empty' => '(choose one)'));
				echo $this->Form->input('primary_power', array('type'=>'select','label' => 'Primary Power',
		   'options' => $powers,'empty' => '(choose one)'));
				echo $this->Form->input('secondary_power', array('type'=>'select','label' => 'Secondary Power',
		   'options' => $powers,'empty' => '(choose one)'));
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
	</div>
</div>

<?php $this->end(); ?>