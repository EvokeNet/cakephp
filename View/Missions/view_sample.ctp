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
                        	$mission_status_message = "<br />".__("<strong><span class='text-color-dark'>This phase is not available for preview.</span></strong>");
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
					   
					   <!-- PREVIEW MODE -->
						<div class="margin top-3">
							<p class="text-center">
								<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('In preview mode, you can test this form, but not submit an actual response. Click to test it!') ?>">
									<a href="#" class="button small disabled" disabled><?= __('Submit your evidence') ?></a>
								</span>
							</p>
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