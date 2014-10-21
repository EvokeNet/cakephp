<?php
	
	echo $this->Html->css('mission_hover');
/*
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
	*/
?>

<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

	  <div class="small-10 medium-10 large-10 columns maincolumn body-padding text-center full-width">

	  	<?php echo $this->Session->flash(); ?>

	  	<h3 class = "evoke padding top-1 padding bottom-1"> <?= strtoupper(__('Choose a mission')) ?> </h3>
			
			<?php foreach($missions as $mission): ?>

				<h1 class="text-color-highlight"
					style="position: absolute; z-index: 1; font-size: 1.5vw; left: 80px; margin-top: 20px;">
					<?= strtoupper($mission['Mission']['title']) ?>
				</h1>
                <div class="evoke default view view-first">
                    <?php if(!is_null($mission['Mission']['cover_dir'])) :?>
						<img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>">
                    <?php else :?>
						<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
                	<?php endif ?>
                    
                    <div class="mask">
                        <p><?= substr($mission['Mission']['description'], 0, 140) ?></p>
                        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view_sample', $mission['Mission']['id'])); ?>" class="button general info"><?= __('Go to mission') ?></a>
                    </div>
                </div> 

			<?php endforeach; ?>

		</div>
</section>

<?php
	echo $this->Html->script('image_hover', array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>