<div class="row collapse <?= (isset($class) && ($class)) ? $class : '' ?>">
	<div class="row">
		<!-- LEVEL -->
		<span class="text-glow uppercase"><?= __('Level') ?>&nbsp;&nbsp;<?= $userLevel ?></span>

		<!-- POINTS -->
		<?php 
		//show by default
		if ((!isset($show_points)) || (isset($show_points) && ($show_points))): ?>
			<div class="right">
				<?= $userPoints ?> <span class="text-color-gray"><?= isset($userNextLevel) ? '/'.$userNextLevel['points'] : '' ?></span>
			</div>
		<?php endif; ?>
	</div>
	<div class="row margin top-05">
		<!-- PROGRESS BAR -->
		<div class="progress level-bar radius">
			<span class="meter" style="width: <?= $userLevelPercentage ?>%"></span>
		</div>
	</div>
</div>