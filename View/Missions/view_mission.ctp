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
	$this->start('tabQuestsContent'); ?><?php
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
	//LOADING QUESTS
	$load_quests_url = $this->Html->url(array('controller' => 'missions', 'action' => 'renderQuestsTab', 
		$phase['Phase']['id']
	));
	$load_quests_url = str_replace('amp;', '', $load_quests_url); //Workaround for Cakephp 2.x

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
		var missions_load_quests_url = "<?= $load_quests_url ?>";
		var missions_load_dossier_url = "<?= $load_dossier_url ?>";
		var missions_load_evidences_url = "<?= $load_evidences_url ?>";
	<?php
	$this->Html->scriptEnd();

	//SCRIPT
	$this->Html->script('requirejs/app/Missions/view_mission.js', array('inline' => false));
?>