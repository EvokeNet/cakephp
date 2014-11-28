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
                	foreach ($mission['Phase'] as $mission_phase):
                		$mission_phase_url = "#";

                		//CURRENT PHASE
                		if ($mission_phase['id'] == $phase['Phase']['id']) {
                			$mission_phase_status = 'current';
                			$mission_status_message = "<br />".__("<strong><span class='text-color-dark'>Current phase.</span></strong>");
                		}
                		else {
                        	$mission_status_message = "<br />".__("<strong><span class='text-color-dark'>Only the first phase is available for preview.</span></strong>");
                        	$mission_phase_status = 'disabled';
                        	$mission_phase_url = "#";
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

	//TEMPLATE ELEMENT: TAB DOSSIER
	$this->start('tabDossierContent'); ?>
		<div class="tabs-content background-color-standard opacity-07 full-width full-height padding all-2">
			<?= __('This section is not available in preview.') ?>
		</div><?php
	$this->end();

	//TEMPLATE ELEMENT: TAB EVIDENCES
	$this->start('tabEvidencesContent'); ?>
		<div class="padding all-2">
			<?= __('This section is not available in preview.') ?>
		</div><?php
	$this->end();

?>