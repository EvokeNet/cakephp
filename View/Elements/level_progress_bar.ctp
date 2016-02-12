<?php
  $nextLevelPoints = isset($userNextLevel) ? ' / '.$userNextLevel['points'] : '';
?>

<div class = "points-bar-width">
  <div>
    <label class = "font-green uppercase font-weight-bold left"><?= __('Level') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    <label class = "font-green uppercase font-weight-bold right"><?php echo $userPoints . $nextLevelPoints; ?></label>
  </div>

  <div class="points-bar">
      <span class="meter" style="width: <?= $userLevelPercentage ?>%"></span>
  </div>

</div>
