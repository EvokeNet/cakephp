<?php
	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');

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