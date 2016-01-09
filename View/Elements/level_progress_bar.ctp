<label class = "font-green uppercase font-weight-bold">
    <?= __('Level') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if ((!isset($show_points)) || (isset($show_points) && ($show_points))): ?>
        <div class="right">
            <?= $userPoints ?> <span class="text-color-gray"><?= isset($userNextLevel) ? ' / '.$userNextLevel['points'] : '' ?></span>
        </div>
    <?php endif; ?>
    <div class="row margin-top-1em">
        <!-- PROGRESS BAR -->
        <div class="progress level-bar radius">
            <span class="meter" style="width: <?= $userLevelPercentage ?>%"></span>
        </div>
    </div>
</label>  
 