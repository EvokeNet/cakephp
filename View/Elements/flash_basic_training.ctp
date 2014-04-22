<?php echo $this->Html->css('lightbox_ribbon'); ?>

<div id="formModal" class="reveal-modal medium evoke lightbox phase text-align" data-reveal data-options="closeOnBackgroundClick:true">

  <h3><?= strtoupper(__('Congratulations!')) ?></h3>
 	<div class = "evoke lightbox-margin">
  	<div class="green-ribbon-wrapper">
		<div class="green-ribbon-front">
			<h2><?= __('You have finished the Basic Training!') ?></h2>
		</div>
		<div class="green-ribbon-edge-topleft"></div>
		<div class="green-ribbon-edge-topright"></div>
		<div class="green-ribbon-edge-bottomleft"></div>
		<div class="green-ribbon-edge-bottomright"></div>
		<div class="green-ribbon-back-left"></div>
		<div class="green-ribbon-back-right"></div>
	</div>
	</div>
  <!-- <img src = '<?= $this->webroot.'img/ribbon.png' ?>'> -->
  <!-- <h1 style = "width: 44.6vw; position: static; margin-left: -83px; display: block; text-align: center;"><img src = '<?= $this->webroot.'img/ribbon.png' ?>'><h2>oi</h2></h1> -->
  	<!-- <div style = "position:relative">
	<div class="green-ribbon-wrapper">
		<div class="green-ribbon-front">
		
		</div>
		<div class="green-ribbon-edge-topleft"></div>
		<div class="green-ribbon-edge-topright"></div>
		<div class="green-ribbon-edge-bottomleft"></div>
		<div class="green-ribbon-edge-bottomright"></div>
		<div class="green-ribbon-back-left"></div>
		<div class="green-ribbon-back-right"></div>
	</div>
	</div> -->

  <p class="lead"><?= __('You are now ready to start your Evoke journey! The next step is to go to your dashboard and choose a mission! Good luck, agent!') ?></p>
  <a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user_id));?>" class = "button general"><?php echo __("Let's choose a mission!");?></a>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php 
  echo $this->Html->script('reveal_modal', array('inline' => false));
?>