<?php
	
    $this->extend('/Common/admin_panel');

?>

<?php $this->start('page_content'); ?>

<div class="row full-width" data-equalizer>
	<div class="large-10 columns" id="panel-content" data-equalizer-watch>
		<div class="powers form">
		<?php echo $this->Form->create('Power'); ?>
			<fieldset>
				<legend><?php echo __('Admin Add Power'); ?></legend>
			<?php
				echo $this->Form->input('name');
				echo $this->Form->input('description');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>

				<li><?php echo $this->Html->link(__('List Powers'), array('action' => 'index')); ?></li>
			</ul>
		</div>
	</div>	
</div>

<?php $this->end(); ?>