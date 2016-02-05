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
			'evoke-new',
			'panels-new',
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
		<div class="users view">
		<h2><?php echo __('User'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($user['User']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Role Id'); ?></dt>
				<dd>
					<?php echo h($user['User']['role_id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Facebook Id'); ?></dt>
				<dd>
					<?php echo h($user['User']['facebook_id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Facebook Token'); ?></dt>
				<dd>
					<?php echo h($user['User']['facebook_token']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Google Id'); ?></dt>
				<dd>
					<?php echo h($user['User']['google_id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Google Token'); ?></dt>
				<dd>
					<?php echo h($user['User']['google_token']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Organization Id'); ?></dt>
				<dd>
					<?php echo h($user['User']['organization_id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Name'); ?></dt>
				<dd>
					<?php echo h($user['User']['name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Firstname'); ?></dt>
				<dd>
					<?php echo h($user['User']['firstname']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Lastname'); ?></dt>
				<dd>
					<?php echo h($user['User']['lastname']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Birthdate'); ?></dt>
				<dd>
					<?php echo h($user['User']['birthdate']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Email'); ?></dt>
				<dd>
					<?php echo h($user['User']['email']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Sex'); ?></dt>
				<dd>
					<?php echo h($user['User']['sex']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Biography'); ?></dt>
				<dd>
					<?php echo h($user['User']['biography']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Mini Biography'); ?></dt>
				<dd>
					<?php echo h($user['User']['mini_biography']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Username'); ?></dt>
				<dd>
					<?php echo h($user['User']['username']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Password'); ?></dt>
				<dd>
					<?php echo h($user['User']['password']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Level'); ?></dt>
				<dd>
					<?php echo h($user['User']['level']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Facebook'); ?></dt>
				<dd>
					<?php echo h($user['User']['facebook']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Twitter'); ?></dt>
				<dd>
					<?php echo h($user['User']['twitter']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Google Plus'); ?></dt>
				<dd>
					<?php echo h($user['User']['google_plus']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Instagram'); ?></dt>
				<dd>
					<?php echo h($user['User']['instagram']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Website'); ?></dt>
				<dd>
					<?php echo h($user['User']['website']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Blog'); ?></dt>
				<dd>
					<?php echo h($user['User']['blog']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Country'); ?></dt>
				<dd>
					<?php echo h($user['User']['country']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Language'); ?></dt>
				<dd>
					<?php echo h($user['User']['language']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Basic Training'); ?></dt>
				<dd>
					<?php echo h($user['User']['basic_training']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Photo Dir'); ?></dt>
				<dd>
					<?php echo h($user['User']['photo_dir']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Photo Attachment'); ?></dt>
				<dd>
					<?php echo h($user['User']['photo_attachment']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Status'); ?></dt>
				<dd>
					<?php echo h($user['User']['status']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Superhero Identity Id'); ?></dt>
				<dd>
					<?php echo h($user['User']['superhero_identity_id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($user['User']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($user['User']['modified']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
	</div>
</div>	
