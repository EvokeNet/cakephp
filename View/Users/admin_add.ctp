<?php
	// TOPBAR MENU -->
	$this->start('topbar');
	echo $this->element('topbar');
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
		<div class="users form">
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<legend><?php echo __('Admin Add User'); ?></legend>
			<?php
				echo $this->Form->input('role_id');
				echo $this->Form->input('facebook_id');
				echo $this->Form->input('facebook_token');
				echo $this->Form->input('google_id');
				echo $this->Form->input('google_token');
				echo $this->Form->input('organization_id');
				echo $this->Form->input('name');
				echo $this->Form->input('firstname');
				echo $this->Form->input('lastname');
				echo $this->Form->input('birthdate');
				echo $this->Form->input('email');
				echo $this->Form->input('sex');
				echo $this->Form->input('biography');
				echo $this->Form->input('mini_biography');
				echo $this->Form->input('username');
				echo $this->Form->input('password');
				echo $this->Form->input('level');
				echo $this->Form->input('facebook');
				echo $this->Form->input('twitter');
				echo $this->Form->input('google_plus');
				echo $this->Form->input('instagram');
				echo $this->Form->input('website');
				echo $this->Form->input('blog');
				echo $this->Form->input('country');
				echo $this->Form->input('language');
				echo $this->Form->input('basic_training');
				echo $this->Form->input('photo_dir');
				echo $this->Form->input('photo_attachment');
				echo $this->Form->input('status');
				echo $this->Form->input('superhero_identity_id');
				echo $this->Form->input('Group');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
	</div>
</div>