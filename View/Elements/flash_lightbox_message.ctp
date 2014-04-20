
<?php echo $this->Html->css('lightbox_ribbon'); ?>

<div id="formModal" class="reveal-modal small evoke lightbox text-align" data-reveal>

  <h2><?= ("Agent %s, it's time to start your Basic Training") ?></h2>
  <!-- <h1 style = "width: 44.6vw; position: static; margin-left: -83px; display: block; text-align: center;"><img src = '<?= $this->webroot.'img/ribbon.png' ?>'><h2>oi</h2></h1> -->
  	<div style = "position:relative">
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
	</div>

  <p class="lead"><?= __('This training will show you the steps inside a missions so you can start being an agent of change') ?></p>
  <a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1)); ?>" class = "button general"><?php echo __("Let's get started!");?></a>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php 
  echo $this->Html->script('reveal_modal', array('inline' => false));
?>