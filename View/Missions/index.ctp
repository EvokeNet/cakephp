<?php
	
	echo $this->Html->css('mission_hover');

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
?>

<section class="evoke default-background">
	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-9 medium-9 large-9 columns maincolumn">

	  	<h3 class = "evoke padding top-2"> <?= strtoupper(__('Choose a mission')) ?> </h3>
			
			<?php foreach($missions as $mission): ?>

				<h1 style = "position: absolute; color: #fff; z-index: 1; font-size: 1.5vw; left: 30px; margin-top: 20px; font-family: 'AlegreyaBold'; text-shadow: 0 0 12px rgba(0,0,0,0.85);"><?= strtoupper($mission['Mission']['title']) ?> </h1>
                <div class="evoke default view view-first">
                    <?php if(!is_null($mission['Mission']['cover_dir'])) :?>
						<img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>">
                    <?php else :?>
						<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
                	<?php endif ?>
                    
                    <div class="mask">
                        <!-- <h2><?= $mission['Mission']['title'] ?></h2> -->
                        <p><?= substr($mission['Mission']['description'], 0, 140) ?></p>
                        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], 1)); ?>" class="button general info"><?= __('Go to mission') ?></a>
                    </div>
                </div> 

			<?php endforeach; ?>

		</div>

		<div class="medium-1 end columns"></div>

	</div>
</section>

<?php
	echo $this->Html->script('image_hover', array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
?>