<div id="moreEvidencesTarget" class="evidences-list">
	<?php 
	if (isset($evidences)):
		$lastEvidence = null; //keep track of which one is the last

		foreach($evidences as $e):
			$lastEvidence = $e['Evidence']['id'];
			
			echo $this->element('Evidences/evidence_list_item', array('e' => $e));
		endforeach;
		
		//REFERENCE OF LAST EVIDENCE RENDERED
		?><meta name="lastEvidence" content="<?php echo $lastEvidence; ?>"><?php
	endif; ?>
</div>
<div class="moreEvidencesLoading text-center hidden padding all-1"><i class="fa fa-spinner fa-spin fa-3x"></i></div>

<!-- SCRIPT -->
<?php
	//LOADING EVIDENCES
	$load_evidences_url = $this->Html->url(array('controller' => 'missions', 'action' => 'moreEvidences', 
		'?' => array('mission_id' => $this->request->query('mission_id'))
	));
	$load_evidences_url = str_replace('amp;', '', $load_evidences_url); //Workaround for Cakephp 2.x

	//SCRIPT VARIABLES
	$this->Html->scriptStart(array('inline' => false)); ?>
		var missions_evidence_list_load_limit = "<?= $this->request->query('limit') ?>";
		var missions_evidence_list_load_evidences_url = "<?= $load_evidences_url ?>";
	<?php
	$this->Html->scriptEnd();

	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evidences/evidence-list.js', array('inline' => false));
?>