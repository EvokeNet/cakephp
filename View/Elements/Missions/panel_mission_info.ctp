<div class="content">
	<div class="padding all-1">
		<h1 class="text-glow"><?= (isset($mission['Mission'])) ? $mission['Mission']['title'] : '' ?></h1>

		<?php
		//PHASES BAR
		echo $this->element('phases_bar',array(
			'mission' => $mission,
			'current_phase' => $phase_id
		));
		?>
	

		<!-- MISSION DESCRIPTION -->
		<p class="text-shadow-dark mission-description"><?php echo h($mission['Mission']['description']); ?></p>
	</div>
</div>