<?php
	echo $this->Html->css('mission_hover');

	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

	  <div class="small-10 medium-10 large-10 columns maincolumn body-padding text-center full-width">

	  	<?php echo $this->Session->flash(); ?>
	  	
	  	<h3 class = "evoke padding top-1 padding bottom-1"> <?= strtoupper(__('Choose a mission')) ?> </h3>
			
			<?php foreach($missions as $mission): ?>
				<div class="background-color-dark-opacity-08 padding left-1 right-1" style="position: absolute; z-index: 1; left: 80px; margin-top: 20px;">
					<h1 class="text-color-highlight"
						style="font-size: 1.5vw; text-shadow: 0 0 12px rgba(0,0,0,0.85);">
						<?= strtoupper($mission['Mission']['title']) ?>
					</h1>
				</div>

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