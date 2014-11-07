<?php 
	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');

	//ELEMENTS
	$this->assign('tabDossierContent', __('This section is not available in preview.'));

	//Evidences
	$this->start('tabEvidencesContent');
	echo $this->element('evidence_list', array('evidences' => $evidences)); ?>
	$this->end();
?>