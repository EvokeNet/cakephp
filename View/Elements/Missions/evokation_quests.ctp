<div class="row">
	<div class="column padding left-3 top-2 right-3">
		<div class="row">
			<div class="column">
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
			</div>
			<div class="row">
				<div class="column">
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
				</div>
			</div>
			<div class="row">
				<div class="column small-12 medium-6 large-6 padding left-5">
						<!-- EVOKATION PREVIEW -->
						<div class="text-center">
							<button class="button thin disabled"><?= __('Preview') ?></button>
						</div>
				</div>
				<div class="column small-12 medium-6 large-6">
					<!-- SEND EVOKATION -->
					<div class="text-center">
						<button class="button thin disabled"><?= __('Send') ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		