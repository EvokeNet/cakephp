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
		<div class="superheroIdentities">
		<h2><?php echo __('Superhero Identity'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Name'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Description'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['description']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Quality 1'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['quality_1']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Quality 2'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['quality_2']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Primary Power'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['primary_power']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Secondary Power'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['secondary_power']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($superheroIdentity['SuperheroIdentity']['modified']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
	</div>
</div>