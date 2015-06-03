<?php 
	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');

	//PANELS MENU
	$this->start('panelsMenu');
	echo $this->element('Missions/mission_menu_bar');
	$this->end();

	//PANELS MAIN CONTENT
	$this->start('panelsMainContent');

		//Content depends on the phase
		switch($phase['Phase']['type']) {
			case Phase::TYPE_INDIVIDUAL:
				echo $this->element('Missions/panel_mission_info',array('mission' => $mission, 'phase_id' => $phase['Phase']['id']));
				break;
			case Phase::TYPE_GROUP:
				foreach ($myGroups as $group) {
					echo $this->element('Missions/panel_group_area', array('mission' => $mission, 'group' => $group, 'phase_id' => $phase['Phase']['id']));
				}
				break;
			case Phase::TYPE_EVOKATION:
				echo $this->element('Missions/panel_evokation_area', array('mission' => $mission, 'group' => $group, 'phase_id' => $phase['Phase']['id']));
		}

	$this->end();


	//TEMPLATE ELEMENT: TAB QUESTS
	$this->start('tabQuestsContent');
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


	//JAVASCRIPT VARIABLES
	$this->start('evoke_javascript_variables');
		echo json_encode(array(
			'missions_load_quests_url' => $load_quests_url,
			'missions_load_dossier_url' => $load_dossier_url,
			'missions_load_evidences_url' => $load_evidences_url
		));
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Missions/view_mission.js', array('inline' => false));
?>