<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	

	 	<div class="small-10 medium-10 large-10 columns margin top-2 maincolumn body-padding">
			
			<?php echo $this->Session->flash(); ?>

			<h3 class = "margin bottom-1"> <?= strtoupper(__('Messages')) ?> </h3>

			<div class = "evoke black-bg badges-bg">

				<?php
					foreach ($allies as $usr) {
						
					}

				?>
				
			</div>

		</div>

		<!-- <div class="medium-1 end columns"></div> -->

	</div>

</section>

<?php
	// echo $this->Html->scriptBlock("var userId = '" . json_encode($user['User']['id']) . "'", array('inline' => true));
	echo $this->Html->script('/components/jquery/jquery.min.js');
	echo $this->Html->script('menu_height');
?>