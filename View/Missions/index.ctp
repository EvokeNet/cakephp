<?php
	
	echo $this->Html->css('mission_hover');

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
?>

<section class="evoke default-background">
	<div class="evoke default row full-width-alternate">

<!-- 	  <div class="small-1 medium-1 large-1 columns">
	  	YAY
	  </div>
 -->
	  <div class="small-2 medium-2 large-2 columns">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-9 medium-9 large-9 columns">

	  	<h3 class = "evoke padding top-2"> <?= strtoupper(__('Choose a mission')) ?> </h3>
			
			<?php foreach($missions as $mission): ?>

                <div class="evoke default view view-first">
                    <?php if(!is_null($mission['Mission']['cover_dir'])) :?>
						<img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>">
                    <?php else :?>
						<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
                	<?php endif ?>
                    
                    <div class="mask">
                        <h2><?= $mission['Mission']['title'] ?></h2>
                        <p><?= $mission['Mission']['description'] ?></p>
                        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], 1)); ?>" class="button general info">Read More</a>
                    </div>
                </div> 

			<?php endforeach; ?>

		</div>

		<div class="medium-1 end columns"></div>

	</div>
</section>

<?php
	echo $this->Html->script('image_hover', array('inline' => false));
?>