<?php
	
	echo $this->Html->css('mission_hover');

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
?>

<section class="evoke default-background">
	<div class="evoke default row full-width-alternate">
	  <div class="small-12 small-centered columns">

	  	<h3 class = "evoke padding top-2"> <?= strtoupper(__('Choose a mission')) ?> </h3>
			
			<?php foreach($missions as $mission): ?>

                <div class="evoke default view view-first">
                    <img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
                    <div class="mask">
                        <h2><?= $mission['Mission']['title'] ?></h2>
                        <p><?= $mission['Mission']['description'] ?></p>
                        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], 1)); ?>" class="button general info">Read More</a>
                    </div>
                </div> 

			<?php endforeach; ?>

		</div>
	</div>
</section>

<?php
	echo $this->Html->script('image_hover', array('inline' => false));
?>