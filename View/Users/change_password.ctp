<?php 
	$this->extend('/Common/topbar');
	$this->start('menu');
	echo $this->element('header', array('user' => $usr));
	$this->end(); 
?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns">
		  	<?php 
				echo $this->element('menu', array('user' => $usr));
			?>
	  	</div>

		<div class="small-10 medium-10 large-10 columns maincolumn margin top-2 body-padding">
			<?php echo $this->Session->flash(); ?>

		<h3 class = "margin bottom-1"><?= strtoupper(__('Change Password')) ?></h3>

		

			<div class="row full-width-alternate">

			    <div class="small-12 medium-12 large-12 columns evoke no-padding">
				  	<div class="evoke edit-bg users form">
						<?php echo $this->Form->create('User'); ?>
							<?php
								echo $this->Form->input('password', array('label' => __('Confirm current password'), 'required' => true));
								echo $this->Form->input('tmp', array('label' => __('Enter new password'), 'type' => 'password', 'required' => true));
								echo $this->Form->input('tmp2', array('label' => __('Re-type new password'), 'type' => 'password', 'required' => true));
								
							?>
						<div class = "evoke text-align"><button type="submit" class= "evoke button general submit-button-margin margin top-2"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Confirm new password')) ?></button> </div>
					</div>
			  	</div>

			</div>
		</div>

		<!-- <div class="medium-1 end columns"></div> -->

	</div>
</section>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	//echo $this->Html->script('/components/foundation/js/foundation.min.js');
	//echo $this->Html->script('/components/foundation/js/foundation.min.js', array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
?>