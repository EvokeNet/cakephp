<?php echo $this->Html->css('lightbox_ribbon'); ?>

<div id="formModal" class="reveal-modal medium evoke lightbox phase text-align" data-reveal data-options="closeOnBackgroundClick:true">

  <h3><?= strtoupper(__('Congratulations!')) ?></h3>
 	<div class = "evoke lightbox-margin">
  	<div class="green-ribbon-wrapper">
		<div class="green-ribbon-front">
			<h2><?= __('You have won the badge') ?>&nbsp;<h2 style = "color:#fff"><?= $badge_name ?></h2></h2>
			<img src="<?= $this->webroot.'files/attachment/attachment/'.$imgPath.'/thumb_'.$imgFile ?>"/>
		</div>
		<div class="green-ribbon-edge-topleft"></div>
		<div class="green-ribbon-edge-topright"></div>
		<div class="green-ribbon-edge-bottomleft"></div>
		<div class="green-ribbon-edge-bottomright"></div>
		<div class="green-ribbon-back-left"></div>
		<div class="green-ribbon-back-right"></div>
	</div>
	</div>

	<p class="lead"><?= $badge_desc ?></p>
  	<p class="lead"><?= __('Keep on with the good work, agent!') ?></p>
  	<a class="close-reveal-modal">&#215;</a>
</div>

<?php 
  echo $this->Html->script('reveal_modal', array('inline' => false));
?>