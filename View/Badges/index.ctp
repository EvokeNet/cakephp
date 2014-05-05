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
	
	<div class="small-9 medium-9 large-9 columns maincolumn">
		
		<h3> <?= strtoupper(__('Badges')) ?> </h3>

		<div class = "evoke black-bg badges-bg">
			<ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
			  	<?php 

				foreach($badges as $badge): ?>
					<li>
						<?php if(isset($badge['Badge']['img_dir'])) : ?>
							<img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'>
						<?php else: ?>
							<img src = '<?= $this->webroot.'img/badge.png' ?>'>
						<?php endif ?>
						<h1><?= $badge['Badge']['name'] . '(' .$badge['Badge']['owns'] . ')';?></h1>
			  			<p><?= $badge['Badge']['description']?></p>
					</li>
				<?php endforeach;?>
			  	<!-- <img src = '<?= $this->webroot.'img/badge.png' ?>'> -->
			  	<!-- 
		  	  <li>
			  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
			  	<h1> Badge </h1>
			  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc.</p>
		  	  </li>
		  	-->
			</ul>
		</div>
	</div>

	<div class="medium-1 end columns"></div>

	</div>
</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>