<?php
	//MISSION COMMON LAYOUT
	$this->extend('/Common/mission_layout');

	//MENU TO OPEN PANELS (menu-icons)
	$this->start('panelsMenu');

		$menu_parameters = array();

		//Menu depends on the phase
		switch($phase['Phase']['type']) {
			//PHASES WITH GROUPS HAVE GROUP FORUM
			case Phase::TYPE_GROUP:
			case Phase::TYPE_EVOKATION:
				if (count($myGroups) > 0) {
					$group = $myGroups[0];
					$menu_parameters = array(
						'menu_buttons' => array('Back','Quests','Dossier','Evidences','GroupForum'),
						'group_forum' => $group['Forum']
					);
				}
				else {
					$menu_parameters = array(
						'menu_buttons' => array('Back','Quests','Dossier','Evidences')
					);
				}
		}

		//Render menu element
		echo $this->element('Missions/mission_menu_bar',$menu_parameters);

	$this->end();

	//PANELS MAIN CONTENT (does not change according to open tab)
	$this->start('panelsMainContent');

		//Content depends on the phase
		switch($phase['Phase']['type']) {
			//INDIVIDUAL PHASE
			case Phase::TYPE_INDIVIDUAL:
			case (isset($myGroups) && (count($myGroups) < 1)): //OR PERSON WITHOUT A GROUP
				echo $this->element('Missions/panel_mission_info',array('mission' => $mission, 'phase_id' => $phase['Phase']['id']));
				break;
			//GROUP PHASE
			case Phase::TYPE_GROUP:
				foreach ($myGroups as $group) {
					echo $this->element('Missions/panel_group_area', array('mission' => $mission, 'group' => $group, 'phase_id' => $phase['Phase']['id']));
				}
				break;
			//EVOKATION PHASE
			case Phase::TYPE_EVOKATION:
				foreach ($myGroups as $group) {
					echo $this->element('Missions/panel_evokation_area', array('mission' => $mission, 'group' => $group, 'phase_id' => $phase['Phase']['id']));
				}
		}

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
								<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= __('In preview mode you cannot submit an actual evidence.') ?>">
									<a class="button small open-mission-overlay" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'add', $q['mission_id'], $q['phase_id'], $q['id'], 'false')); ?>">
										<?= __('Submit your evidence') ?>
									</a>
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

<?php
	//SCRIPT
	$this->Html->script('requirejs/app/Common/mission_layout.js', array('inline' => false));
?>