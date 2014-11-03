<!-- MENU LOGGED IN -->
<ul class="<?php echo isset($ulClass) ? $ulClass : ''; ?>">

	<!-- USER PROFILE PICTURE -->
	<section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
    	<!-- LEVEL PROGRESS BAR -->
		<li>
			<?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>
		</li>

		<li class="evoke divider"></li>

		<!-- USER NAME -->
		<li class="active">
			<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $loggedInUser['id'])); ?>"><?= __('Agent ').$loggedInUser['firstname'] ?></a>
		</li>
		<li class="has-dropdown">
			<!-- USER PROFILE PICTURE -->
			<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $loggedInUser['id'])); ?>" class="button-icon">
				<?php
				$pic = $this->webroot.'webroot/img/user_avatar.jpg';
				if($loggedInUser['photo_attachment'] == null) {
					if($loggedInUser['facebook_id'] != null) {
						$pic = "https://graph.facebook.com/". $loggedInUser['facebook_id'] ."/picture?type=large";
					}
				}
				else {
					$pic = $this->webroot.'files/attachment/attachment/'.$loggedInUser['photo_dir'].'/'.$loggedInUser['photo_attachment'];
				}
				?>
				<div class="centering-block">
					<img src="<?=$pic?>" class="img-circular profile-picture-topbar border-style-solid border-width-01 border-color-highlight img-glow-on-hover-small" alt="<?= __('Your profile picture') ?>" />
				</div>
			</a>

			<!-- USER OPTIONS -->
	        <ul class="dropdown">
	        	<li>
	          		<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>" class="text-glow-on-hover text-color-highlight">
						<?php echo __('Sign out'); ?>
					</a>
				</li>
	        </ul>
		</li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li>
				<div class="column">
					<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
						<a href="#" class="text-glow-on-hover text-color-highlight"><?php echo __('How to play'); ?></a>
					</span>
				</div>
			</li>
			<li>
				<div class="column">
					<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="text-glow-on-hover text-color-highlight">
						<?php echo __('Missions'); ?>
					</a>
				</div>
			</li>
			<li>
				<div class="column">
					<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
						<a href="#" class="text-glow-on-hover text-color-highlight"><?php echo __('Evokations'); ?></a>
					</span>
				</div>
			</li>
			<li>
				<div class="column">
					<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
						<a href="#" class="text-glow-on-hover text-color-highlight"><?php echo __('Forum'); ?></a>
					</span>
				</div>
			</li>
			<li>
				<div class="column">
					<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
						<a href="#" class="text-glow-on-hover text-color-highlight"><?php echo __('Admin'); ?></a>
					</span>
				</div>
			</li>
    </ul>
  </section>

	<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
	<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
	<!--send to correct address-->
</ul>

<?php echo $this->Form->end(); ?>
<!-- MENU LOGGED IN -->
