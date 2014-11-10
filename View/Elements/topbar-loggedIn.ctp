<?php
	if(isset($loggedInUser['User']))
		$loggedInUser = $loggedInUser['User'];
?>

<!-- MENU LOGGED IN -->

    <!-- Right Nav Section -->
    <ul class="right">
		<li>
			<?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>
		</li>

		<li class="evoke divider"></li>

      <li class="active"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $loggedInUser['id'])); ?>"><?= sprintf(__('Agent %s'), $loggedInUser['firstname']) ?></a></li>
      <li class="has-dropdown">
        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $loggedInUser['id'])); ?>" class="button-icon">
			<?php
			//debug($loggedInUser);

			$pic = $this->webroot.'webroot/img/user_avatar.jpg';
			if ((!isset($loggedInUser['photo_attachment']) || ($loggedInUser['photo_attachment'] == null))
			 	&& (isset($loggedInUser['facebook_id']) && ($loggedInUser['facebook_id'] != null))) {
				if($loggedInUser['facebook_id'] != null) {
					$pic = "https://graph.facebook.com/". $loggedInUser['facebook_id'] ."/picture?type=large";
				}
			}
			elseif (isset($loggedInUser['photo_attachment'])) {
				$pic = $this->webroot.'files/attachment/attachment/'.$loggedInUser['photo_dir'].'/'.$loggedInUser['photo_attachment'];
			}
			?>

			<div class="centering-block">
				<img src="<?=$pic?>" class="img-circular profile-picture-40px border-style-solid border-width-01 border-color-highlight img-glow-on-hover-small" alt="<?= __('Your profile picture') ?>" />
			</div>
		</a>

        <ul class="dropdown">
          <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $loggedInUser['id'])); ?>" class="text-glow-on-hover text-color-highlight">
				<?php echo __('Edit profile'); ?>
			</a></li>
			<li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>" class="text-glow-on-hover text-color-highlight">
				<?php echo __('Sign out'); ?>
			</a></li>
          <!-- <li class="active"><a href="#">Active link in dropdown</a></li> -->
        </ul>
      </li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      	<li id = "menu_play">
			<div class="column">
				<a href="#" class="text-glow-on-hover text-color-highlight"><?php echo __('How to play'); ?></a>
			</div>
		</li>
		<li id = "menu_missions">
			<div class="column">
				<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="text-glow-on-hover text-color-highlight">
					<?php echo __('Missions'); ?>
				</a>
			</div>
		</li>
		<li id = "menu_evokations">
			<div class="column">
				<a href="#" class="text-glow-on-hover text-color-highlight"><?php echo __('Evokations'); ?></a>
			</div>
		</li>
		<li id = "menu_forums">
			<div class="column">
				<a href="<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'index')); ?>"  class="text-glow-on-hover text-color-highlight"><?php echo __('Forum'); ?></a>
			</div>
		</li>
		<?php if($loggedInUser['role'] != 'user'){ ?>
		<li>
			<div class="column">
				<a href="<?php echo $this->Html->url(array('controller' => 'panels', 'action' => 'main')); ?>" class="text-glow-on-hover text-color-highlight" id = "menu_panels"><?php echo __('Admin'); ?></a>
			</div>
		</li>
		<?php } ?>
    </ul>
  

	<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
	<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
	<!--send to correct address-->


<?php echo $this->Form->end(); ?>
<!-- MENU LOGGED IN -->


<?php $this->start('script'); ?>
<script> $("#menu_<?=$this->params['controller']?>").addClass("text-glow border-bottom-highlight"); </script>
<?php $this->end(); ?>