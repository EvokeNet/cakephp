<div class="row">
	<!-- UPPER TITLE -->
	<div class="text-center">
		<h4 class="text-color-highlight"><?= __('Now it\'s time to combine yours and your allies\' ideas:') ?></h4>
		<div class="padding top-2">
			<?php echo $this->element('Evokations/evokation_status',array(
				'type'     		  => Quest::TYPE_BRAINSTORM,
				'phase_id' 		  => $phase_id,
				'evokationQuests' => $evokationQuests,
				'show_title' 	  => false)); ?>
	</div>
</div>
<div class="row">
	<!-- LOWER TITLE -->
	<div class="text-center">
		<h4 class="text-color-highlight"><?= __('New quests for your evokation:') ?></h4>
		<div class="padding top-2">
			<?php echo $this->element('Evokations/evokation_status',array(
				'type'     		  => Quest::TYPE_EVOKATION_PART ,
				'phase_id' 		  => $phase_id,
				'evokationQuests' => $evokationQuests,
				'show_title' 	  => false)); ?>
	</div>
</div>