<!-- IMAGE HEADER -->
<?php if (isset($imgSrc)) { ?>
<div class="background-cover full-width image-header table centering-block <?= (isset($margin) && !$margin ? '' : 'margin bottom-2') ?>"
	data-interchange="[<?= (isset($imgSrc) ? $imgSrc : '') ?>, (default)]">
	<noscript><img src="<?= (isset($imgSrc) ? $imgSrc : '') ?>" class="full-width"></noscript>
	<div class="table-cell vertical-align-middle">
		<div class="centered-block">
			<h1 class="text-color-highlight text-glow"><?= (isset($imgHeaderTitle) ? $imgHeaderTitle : '') ?></h1>
		</div>
	</div>
</div>
<?php } ?>