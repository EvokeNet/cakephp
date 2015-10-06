<ul class="small-block-grid-2 medium-block-grid-3">

<?php 
	$count = 0;
	foreach($badges as $badge):
		$count++;
		if($count > 12) {
			break;
		} ?>
			<li class="padding right-1">
				<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= $badge['Badge']['name'] ?>">
					<?php if(isset($badge['Badge']['img_dir'])) : ?>
						<img src='<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>' alt="<?= $badge['Badge']['name'] ?>">
					<?php else: ?>
						<img src='<?= $this->webroot.'img/badge4.png' ?>' class="full-width" alt="Badge" />
					<?php endif ?>
				</span>
			</li>
<?php endforeach;?>

</ul>