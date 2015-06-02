<div class="content background-color-dark-opacity-05">
	<!-- MISSION TITLE -->
	<div class="padding all-1">
		<h1 class="text-glow"><?= (isset($mission['Mission'])) ? $mission['Mission']['title'] : '' ?></h1>

		<?php
		//PHASES BAR
		echo $this->element('phases_bar',array(
			'mission' => $mission,
			'current_phase' => $phase_id
		));
		?>
	</div>

	<!-- EVOKATION AREA -->
	<h2 class="text-color-highlight text-center">
		<?= __('EVOKATION AREA '); ?>
	</h2>
</div>