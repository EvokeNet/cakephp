<!-- IMAGE HEADER -->
<?php if (isset($imgSrc)) { ?>
<div class="full-width image-header centering-block">
	<div class="centered-block">
		<h1> <?= (isset($imgHeaderTitle) ? $imgHeaderTitle ? '') ?></h1>
	</div>
	<img src="<?= $imgSrc ?>" class="standard-width" />
</div>
<?php } ?>