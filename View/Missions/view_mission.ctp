<?php 
	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');

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
		}

		//Render menu element
		echo $this->element('Missions/mission_menu_bar',$menu_parameters);

	$this->end();

	//PANELS MAIN CONTENT (does not change according to open tab)
	$this->start('panelsMainContent');

		echo $this->element('Missions/panels_main_content',array('mission' => $mission, 'phase' => $phase, 'myGroups' => $myGroups));

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
	//Advanced phases display quest panel by default
	$open_by_default = false;
	if ($phase['Phase']['type'] != Phase::TYPE_INDIVIDUAL) {
		$open_by_default = true;
	}

	//debug($group);

	if ($phase['Phase']['type'] == Phase::TYPE_EVOKATION) {
		//LOADING QUESTS FOR EVOKATION PARTS
		$load_quests_url = $this->Html->url(array('controller' => 'missions', 'action' => 'renderEvokationQuests', 
			$phase['Phase']['id'], $mission['Mission']['id'], $group['Evokation'][0]['id']
		));
	}else{
		//LOADING QUESTS
		$load_quests_url = $this->Html->url(array('controller' => 'missions', 'action' => 'renderQuestsTab', 
			$phase['Phase']['id']
		));
	}
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

	//LOADING MAIN CONTENT
	$load_main_content_url = $this->Html->url(array('controller' => 'missions', 'action' => 'renderPanelsMainContent', $mission['Mission']['id']));

	//JAVASCRIPT VARIABLES
	$this->start('evoke_javascript_variables');
		echo "
		evokeData.missions_load_quests_url = '$load_quests_url';
		evokeData.missions_load_dossier_url = '$load_dossier_url';
		evokeData.missions_load_evidences_url = '$load_evidences_url';
		evokeData.open_quests_by_default = '$open_by_default';
		evokeData.load_main_content_url = '$load_main_content_url';
		";
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Missions/view_mission.js', array('inline' => false));
?>