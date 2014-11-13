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
	/* SCRIPT */
	$this->start('script');

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
?>
	<script type="text/javascript">
		$(document).ready(function() {
			//CLICKING ON THE DOSSIER OFFCANVAS WILL LOAD CONTENT VIA AJAX ONCE (and keep the same content if the button is clicked later on)
			$("#menu-icon-tabDossier").one( "click", function() {
				$.ajax({
					url: "<?= $load_dossier_url ?>",
					type:"POST",
					beforeSend: function() {
						$('.tabDossierContent').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
					},
					success: function(data) {
						$('.tabDossierContent').html(data);
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
			});

			//CLICKING ON THE EVIDENCE OFFCANVAS WILL LOAD CONTENT VIA AJAX ONCE (and keep the same content if the button is clicked later on)
			$("#menu-icon-tabEvidences").one( "click", function() {
				$.ajax({
					url: "<?= $load_evidences_url ?>",
					type:"POST",
					beforeSend: function() {
						$('.tabEvidencesContent').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
					},
					success: function(data) {
						$('.tabEvidencesContent').html(data);
						$(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
					}
				});
			});
		});
	</script>
<?php $this->end(); ?>