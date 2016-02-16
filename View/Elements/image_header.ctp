<!-- IMAGE HEADER -->
<?php if (isset($imgSrc)) { ?>
<div id="image-header" class="background-cover small-12 medium-7 large-12 colums right image-header 
  <?= (isset($hidden) && $hidden ? 'hidden' : 'table') ?> 
  centering-block
  <?= (isset($margin) && !$margin ? '' : 'margin bottom-2') ?>"
  
  data-interchange="[<?= (isset($imgSrc) ? $imgSrc : '') ?>, (default)]">

  <noscript><img src="<?= (isset($imgSrc) ? $imgSrc : '') ?>" class="full-width"></noscript>

  <div class="table-cell vertical-align-middle">
    <div class="centered-block">
      <h1 class="text-color-highlight text-glow"><?= (isset($imgHeaderTitle) ? $imgHeaderTitle : '') ?></h1>
    </div>
  </div>

</div>
<?php } ?>
