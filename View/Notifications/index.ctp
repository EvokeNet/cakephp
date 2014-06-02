<?php
$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	

	 	<div class="small-10 medium-10 large-10 columns margin top-2 maincolumn body-padding">
			
			<h3 class = "margin bottom-1"> <?= strtoupper(__('Notifications')) ?> </h3>

			<div class = "evoke black-bg badges-bg">

				<?php
					foreach($notifications as $n):
						//echo $this->element('notifications', array('e' => $n, 'user' => $user)); 
					endforeach;
				?>
			</div>

		</div>

		<!-- <div class="medium-1 end columns"></div> -->

	</div>

</section>
