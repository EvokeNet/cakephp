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
							<?php
								$btnSendClass = '';
								// if all evokation parts were sent
								if(!(isset($done)) || !$done){
									$btnSendClass = 'disabled';
								}
							?>
							<a class="button small open-mission-overlay large-6 medium-8 small-8 text-left" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'preview_evokation', 
										$evokation_id,
										$evokationQuests[0]['Quest']['mission_id']
									));?>">
								<i class="fa fa-pencil text-color-highlight"></i>
								<span class="font-highlight text-color-highlight "><?= __('Preview') ?></span>
							</a>
						</div>
				</div>
				<div class="column small-12 medium-6 large-6">
					<!-- SEND EVOKATION -->
					<div class="text-center">
						<a class="button small send-evokation <?= $btnSendClass ?>" href="<?php echo $this->Html->url(array('controller' => 'evokation', 'action' => 'edit',
								$evokation_id
							)); ?>">
							<i class="fa fa-pencil text-color-highlight"></i>
							<span class="font-highlight text-color-highlight "><?= __('Send') ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
//SCRIPT
	$this->Html->script('requirejs/app/Elements/Missions/evokation_quests.js', array('inline' => false));
?>