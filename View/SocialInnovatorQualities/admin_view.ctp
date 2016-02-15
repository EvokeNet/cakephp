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
		<div class="socialInnovatorQualities">
		<h2><?php echo __('Social Innovator Quality'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Name'); ?></dt>
				<dd>
					<?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Short Name'); ?></dt>
				<dd>
					<?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['short_name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Description'); ?></dt>
				<dd>
					<?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['description']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($socialInnovatorQuality['SocialInnovatorQuality']['modified']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
	</div>
</div>

<?php $this->end(); ?>