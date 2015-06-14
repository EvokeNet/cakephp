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
				if ($mission_phase['id'] == $current_phase) {
					$mission_phase_status = 'current';
					$mission_status_message = "<br /><strong><span class='text-color-dark'>".__('Current phase.')."</span></strong>";
				}
				//NOT LOGGED IN - JUST SEES FIRST PHASE
				else if (!isset($loggedIn) || (!$loggedIn)) {
					$mission_status_message = "<br /><strong><span class='text-color-dark'>".__("This phase is not available for preview.")."</span></strong>";
						$mission_phase_status = 'looks-disabled';
						$mission_phase_url = "#";
				}
				else {
					//PAST OR AVAILABLE FUTURE (completed last phase) - OR USER NOT LOGGED IN - CAN GO BACK
					if (($mission_phase['completed']) || ($current_phase_counter > 0 && $mission['Phase'][$current_phase_counter-1]['completed'])) {
						$mission_phase_status = 'available';
						$mission_status_message = "<br /><strong><span class='text-color-dark'>".__('Click to access the phase content.')."</span></strong>";

						//DEFINE MISSION URL DEPENDING ON WHETHER THE USER IS LOGGED IN OR NOT
						if (isset($loggedIn) && ($loggedIn)) {
							$mission_phase_url = $this->Html->url(array('controller' => 'missions', 'action' => 'view_mission', $mission['Mission']['id'], $mission_phase['position']));
						}
						else { //FOR NOW IT NEVER GETS HERE, BUT IF THEY WERE AVAILABLE...
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
					<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= $mission_status_message.'<br /><br />'.$mission_phase['description'] ?>">
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