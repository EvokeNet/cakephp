<?php 
	/* Top bar */
	$this->start('topbar');
	echo $this->element('top-bar-login');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Account Recovery'), 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>

<div class="row">

	<div class="small-12 columns margin top-2 body-padding">
		<h3 class="margin bottom-1"><?= strtoupper(__('Recover Password')) ?></h3>

			<div>
				<?php echo $this->Form->create('User'); ?>
					<?php
						echo $this->Form->input('email', array('label' => __('E-mail'), 'required' => true));
					?>
				<div class="text-center">
					<button type="submit" class= "button margin top-2">
						<i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i>
						<?= strtoupper(__('Submit')) ?>
					</button> 
				</div>
			</div>

	</div>

</div>
