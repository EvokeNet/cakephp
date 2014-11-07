<?php 

	//ELEMENT: TAB DOSSIER
	$this->start('tabDossierContent');
	echo __('This section is not available in preview.');
	$this->end();


	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');


	//ELEMENT: TAB EVIDENCES
	$this->start('tabEvidencesContent');
	echo __('This section is not available in preview.');
	$this->end();

?>