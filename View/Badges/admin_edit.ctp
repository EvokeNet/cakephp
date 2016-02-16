<?php
	// TOPBAR MENU -->
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();

	

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
			'panels',
			'circle'
		)
	);

?>

<div class="row full-width" data-equalizer>
	
	<?php
		echo $this->element('panel/admin_sidebar');
		$this->end();
	?>


	<div class="large-10 columns hidden" id="panel-content" data-equalizer-watch>	
		<div class="badges form">
		<?php echo $this->Form->create('Badge'); ?>
			<fieldset>
				<legend><?php echo __('Admin Edit Badge'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('organization_id');
				echo $this->Form->input('mission_id');
				echo $this->Form->input('name');
				echo $this->Form->input('name_es');
				echo $this->Form->input('description');
				echo $this->Form->input('description_es');
				echo $this->Form->input('power_points_only');
				echo $this->Form->input('trigger');
				echo $this->Form->input('language');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>

				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Badge.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Badge.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Badges'), array('action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Badges'), array('controller' => 'user_badges', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Badge'), array('controller' => 'user_badges', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
</div>
