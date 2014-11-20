<?php 
	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');

	//TEMPLATE ELEMENT: TAB DOSSIER
	$this->start('tabDossierContent'); ?>
	<div class="tabs-content tabDossierContent full-width full-height"></div><?php
	$this->end();

	//TEMPLATE ELEMENT: TAB EVIDENCES
	$this->start('tabEvidencesContent'); ?>
	<div class="tabs-content tabEvidencesContent full-width full-height"></div><?php
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