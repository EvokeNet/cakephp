<?php //echo $this->Html->css('lightbox_ribbon'); ?>

<div id="<?= 'admin'.$notificationId?>" class="reveal-modal medium evoke lightbox phase text-align" data-reveal data-options="closeOnBackgroundClick:false">

  <h3><?= strtoupper(__('Notification')) ?></h3>
 	<div class = "evoke lightbox-margin">
  	<div class="green-ribbon-wrapper">
		<div class="green-ribbon-front">
			<h2 style = "color:#fff"><?= $notificationTitle ?></h2>
		</div>
		<div class="green-ribbon-edge-topleft"></div>
		<div class="green-ribbon-edge-topright"></div>
		<div class="green-ribbon-edge-bottomleft"></div>
		<div class="green-ribbon-edge-bottomright"></div>
		<div class="green-ribbon-back-left"></div>
		<div class="green-ribbon-back-right"></div>
	</div>
	</div>
  <p class="lead"><?= $notificationDescription ?></p>
  <!-- CLOSE_HERE -->
</div>

<?php 
	echo $this->Html->script('reveal_modal', array('inline' => false));
?>