<?php 
	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');

	//MISSION SUBMENU
	$this->start('missionsSubmenuContent'); ?>
	<div class="content">
		<h1 class="text-glow"><?= (isset($mission['Mission'])) ? $mission['Mission']['title'] : '' ?></h1>

		<!-- PROGRESS BAR -->
		<div class="button-bar phases-bar padding top-05 bottom-05">
			<ul class="button-group radius">
				<?php
                	//FOR NOW THE PHASE ICONS ARE HARDCODED!
                	$mission_phase_icons = array("fa-graduation-cap", "fa-flag", "fa-fighter-jet", "fa-eye", "fa-flash");

                	$current_phase_counter = 0;
                	$last_phase_completed = false;
                	foreach ($mission['Phase'] as $mission_phase):
                		$mission_phase_url = "#";
                		$mission_status_message = "";

                		//CURRENT PHASE
                		if ($mission_phase['id'] == $phase['Phase']['id']) {
                			$mission_phase_status = 'current';
                			$mission_status_message = "<br /><strong><span class='text-color-dark'>".__('Current phase.')."</span></strong>";
                		}
                		else {
                			//PAST OR AVAILABLE FUTURE (completed last phase) - CAN GO BACK
                    		if (($mission_phase['completed']) || ($current_phase_counter > 0 && $mission['Phase'][$current_phase_counter-1]['completed'])) {
                				$mission_phase_status = 'available';
                				$mission_status_message = "<br /><strong><span class='text-color-dark'>".__('Click to access the phase content.')."</span></strong>";

                        		//DEFINE MISSION URL DEPENDING ON WHETHER THE USER IS LOGGED IN OR NOT
	                        	if (isset($loggedIn) && ($loggedIn)) {
	                        		$mission_phase_url = $this->Html->url(array('controller' => 'missions', 'action' => 'view_mission', $mission['Mission']['id'], $mission_phase['position']));
	                        	}
	                        	else {
	                        		$mission_phase_url = $this->Html->url(array('controller' => 'missions', 'action' => 'view_sample', $mission['Mission']['id'], $mission_phase['position']));
	                        	}


	                        	$last_phase_completed = true; //for the next phase
	                        }
	                        //FUTURE - CAN'T GO YET
	                        else {
	                        	$mission_status_message = "<br /><strong><span class='text-color-dark'>".__("This phase will be available when you complete the mandatory quests of the previous phase.")."</span></strong>";
	                        	$mission_phase_status = 'looks-disabled';
	                        	$mission_phase_url = "#";
	                        }
                		}
                		
                        ?>
                		
                		<li>
                			<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= $mission_phase['description'].$mission_status_message ?>">
								<a href="<?= $mission_phase_url ?>" class="button small thin <?= $mission_phase_status ?> font-weight-bold">
									<?php
									if (array_key_exists($mission_phase['position'], $mission_phase_icons)): ?>
										<i class="fa <?= $mission_phase_icons[$mission_phase['position']] ?> fa-lg"></i> <?php
									endif; ?>
									<?= $mission_phase['name'] ?>
								</a>
							</span>
						</li><?php

						$current_phase_counter++;
                	endforeach;
                ?>
			</ul>
		</div>

		<!-- MISSION DESCRIPTION -->
		<p class="text-shadow-dark mission-description"><?php echo h($mission['Mission']['description']); ?></p>
	</div><?php
	$this->end();


	//TEMPLATE ELEMENT: TAB QUESTS
	$this->start('tabQuestsContent'); ?>
		<dl class="tabs vertical table-cell full-width  margin right-1" id="questsTabs" data-tab>
			<?php 
				$counter = 1;
				$active = 'class = "active"';

				if (isset($phase['Quest'])) {
					foreach($phase['Quest'] as $q): 
						if($counter != 1)
							$active = null;
						?>
						<dd <?= $active ?>><a href="#quest<?= $counter ?>" class="text-glow-on-hover"><?= $q['title'] ?></a></dd>
						<?php
						$counter++;
					endforeach;

					//NO QUESTS: Show alert
					if (count($phase['Quest']) < 1) { ?>
						<div data-alert="" class="alert-box radius">
							<?= __('There are no quests available in this mission.') ?>
							<a href="" class="close">×</a>
						</div>
					<?php }
				}
			?>
		</dl>

		<div class="tabs-content table-cell vertical-align-top full-width gradient-on-left">
			<?php 
				$counter = 1;
				$active = 'active'; ?>

			<?php 
				if (isset($phase['Quest'])) {
					foreach($phase['Quest'] as $q): 
						if($counter != 1)
							$active = null;
						?>
				
				<div class="content <?= $active ?>" id="quest<?= $counter ?>">
					<div class = "margin right-1">
						<!-- QUEST TITLE AND DESCRIPTION -->
						<h3 class="text-color-highlight text-center"><?= $q['title'] ?></h3>
						<?= $q['description'] ?>

						<!-- REWARDS -->
						<h5 class="text-color-highlight text-center"><?= __('REWARDS') ?></h5>
						<p class="text-center"><?= __('Submitting an evidence for this quest is worth skills for these badges:') ?></p>
						<p class="text-center">
							<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge1.png' ?>" alt="Quests" />
							<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge2.png' ?>" alt="Quests" />
							<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge3.png' ?>" alt="Quests" />
						</p>
					   
					   <!-- CALL TO ACTION -->
						<div class="margin top-3"><?php							
							//CREATE EVIDENCE
							if ($q['type'] == Quest::TYPE_EVIDENCE): ?>
								<p class="text-center">
									<a class="button small open-mission-overlay" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'add', $mission['Mission']['id'], $q['phase_id'], $q['id'], 'false')); ?>">
										<?= __('Create your evidence') ?>
									</a>
								</p><?php
							//CREATE GROUP
							elseif ($q['type'] == Quest::TYPE_GROUP_CREATION): ?>
								<p class="text-center">
									<a class="button small open-mission-overlay" href="<?php echo $this->Html->url(array('controller'=> 'groups', 'action' => 'index')); ?>">
										<?= __('Create your group') ?>
									</a>
								</p>
								<p class="text-center">
									<?= __('Or join groups already created for this phase:') ?>
								</p>

								<?php
								foreach($phase['Group'] as $e):
									// if ($e['quest_id'] == $q['id']):
										echo $this->element('Groups/group_box', array('e' => $e));
									// endif;
								endforeach;
							//BRAINSTORM
							elseif ($q['type'] == Quest::TYPE_BRAINSTORM): ?>
								<h5 class="text-color-highlight text-center"><?= __('EVIDENCE CREATION PROCESS') ?></h5><?php
									echo $this->element('BrainstormSessionEvoke.timeline',array('states' => $q['Timeline']));
							endif; ?>
						</div>
					</div>
				</div>

			<?php
					$counter++;
					endforeach;
				} ?>

		</div><?php
	$this->end();

	//TEMPLATE ELEMENT: TAB DOSSIER
	$this->start('tabDossierContent'); ?>
	<div class="tabs-content tabDossierContent full-width full-height"></div><?php
	$this->end();

	//TEMPLATE ELEMENT: TAB EVIDENCES
	$this->start('tabEvidencesContent'); ?>
	<div class="tabs-content tabEvidencesContent table full-width full-height"></div><?php
	$this->end(); ?>


<?php
	//LOADING DOSSIER
	$load_dossier_url = $this->Html->url(array('controller' => 'missions', 'action' => 'renderDossierTab', 
		'?' => array(
			'mission_id' => $mission['Mission']['id'], 
			'limit' => 10)
	));
	$load_dossier_url = str_replace('amp;', '', $load_dossier_url); //Workaround for Cakephp 2.x

	//LOADING EVIDENCES
	$load_evidences_url = $this->Html->url(array('controller' => 'missions', 'action' => 'renderEvidenceList', 
		'?' => array(
			'mission_id' => $mission['Mission']['id'], 
			'limit' => 10)
	));
	$load_evidences_url = str_replace('amp;', '', $load_evidences_url); //Workaround for Cakephp 2.x

	//SCRIPT VARIABLES
	$this->Html->scriptStart(array('inline' => false)); ?>
		var missions_load_dossier_url = "<?= $load_dossier_url ?>";
		var missions_load_evidences_url = "<?= $load_evidences_url ?>";
	<?php
	$this->Html->scriptEnd();

	//SCRIPT
	$this->Html->script('requirejs/app/Missions/view_mission.js', array('inline' => false));
?>