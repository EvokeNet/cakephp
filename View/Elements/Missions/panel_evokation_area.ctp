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

	<!-- GROUP INFO -->
	<div class="padding left-1 right-1">
		<!-- GROUP TITLE -->
		<div class="text-center">
			<h5 class="text-color-highlight"><?= __('Group ').$group['title'] ?></h5>
		</div>

		<!-- LIST OF MEMBERS -->	
		<div class="padding top-2">
			<?php echo $this->element('Groups/member_list',array(
				'group' => $group,
				'groupOwner' => $group['Leader'],
				'members' => $group['Member'],
				'show_title' => false)); ?>
		</div>
	</div>

	<!-- EVOKATION STATUS -->
	<div class="padding left-1 right-1">
		<!-- TITLE -->
		<div class="text-center">
			<h5 class="text-color-highlight"><?= __('Evokation status') ?></h5>
		</div>

		<!-- STATUS -->	
		<div class="padding top-2">
			<?php echo $this->element('Evokations/evokation_status',array(
				'group' => $group,
				'groupOwner' => $group['Leader'],
				'members' => $group['Member'],
				'show_title' => false)); ?>
		</div>
	</div>
</div>