<div class="row collapse ">
	<div class="row">
		<!-- QUESTIONS -->
		<span class="left text-glow uppercase padding right-2"><?= __('Questions') ?></span>

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