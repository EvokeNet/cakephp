<?php 
	/* Top bar */
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Change your password'), 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>

<div class="row">

	<div class="small-12 columns margin top-2 body-padding">
		<h3 class="margin bottom-1"><?= strtoupper(__('Change Password')) ?></h3>

			<div>
				<?php echo $this->Form->create('User'); ?>
					<?php
						echo $this->Form->input('password', array('label' => __('Confirm current password'), 'required' => true));
						echo $this->Form->input('tmp', array('label' => __('Enter new password'), 'type' => 'password', 'required' => true));
						echo $this->Form->input('tmp2', array('label' => __('Re-type new password'), 'type' => 'password', 'required' => true));
						
					?>
				<div class="text-center">
					<button type="submit" class= "button margin top-2">
						<i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i>
						<?= strtoupper(__('Confirm new password')) ?>
					</button> 
				</div>
			</div>

	</div>

</div>
