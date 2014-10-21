<?php
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

<div class="evoke row background-color-standard full-width">
  <div class="medium-2 columns">
  	<?php if($user['User']['photo_attachment'] == null) : ?>
		<?php if($user['User']['facebook_id'] == null) : ?>
			<?php $pic = $this->webroot.'webroot/img/user_avatar.jpg'; ?>
		<?php else : ?>	
			<?php $pic = "https://graph.facebook.com/". $user['User']['facebook_id'] ."/picture?type=large"; ?>
		<?php endif; ?>
	<?php else : ?>
		<?php $pic = $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment']; ?>
	<?php endif; ?>
	<div class="centering-block"><img src = "<?=$pic?>" width="150px" style="border-radius:50%"/></div>
	<div><p><?php echo $user['User']['biography']; ?>lorem ipsum</p></div>
  </div>
  <div class="medium-8 columns">...</div>
  <div class="medium-2 columns">...</div>
</div>

<!-- <div class="full-width full-height">
	<img src="<?= $this->webroot.'img/mockup-1-evoke-profile.jpg' ?>"  class="full-width" />
</div> -->
