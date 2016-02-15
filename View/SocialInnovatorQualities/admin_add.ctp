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
		<div class="socialInnovatorQualities form">
		<?php echo $this->Form->create('SocialInnovatorQuality'); ?>
			<fieldset>
				<legend><?php echo __('Admin Add Social Innovator Quality'); ?></legend>
			<?php
				echo $this->Form->input('name');
				echo $this->Form->input('short_name');
				echo $this->Form->input('description');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>

				<li><?php echo $this->Html->link(__('List Social Innovator Qualities'), array('action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('List Matching Answers'), array('controller' => 'matching_answers', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Matching Answer'), array('controller' => 'matching_answers', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
</div>

<?php $this->end(); ?>