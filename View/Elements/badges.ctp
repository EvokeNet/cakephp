  <!-- <div class="right">
  	<a href = "<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index')); ?>" class = "button thin"><?php echo __('See All');?></a>
  </div> -->

<ul class="small-block-grid-2 medium-block-grid-3">

<?php 
	$count = 0;
	foreach($badges as $badge): 
		$count++;
		if($count > 12) {
			break;
		} ?>
			<li class="padding right-1">
				<?php if(isset($badge['Badge']['img_dir'])) : ?>
					<img src='<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>' alt="<?= $badge['Badge']['Name'] ?>">
				<?php else: ?>
					<img src='<?= $this->webroot.'img/badge4.png' ?>' class="full-width" alt="Badge" />
				<?php endif ?>
			</li>
<?php endforeach;?>

</ul>