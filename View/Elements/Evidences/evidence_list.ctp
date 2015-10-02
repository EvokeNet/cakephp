<div id="moreEvidencesTarget" class="evidences-list">
	<?php 
	if (isset($evidences)):
		foreach($evidences as $e):
			echo $this->element('Evidences/evidence_list_item', array('e' => $e));
		endforeach;
	endif; ?>
</div>

<!-- BUTTON LOAD MORE -->
<div class="moreEvidencesButtonContainer text-center margin all-1 bottom-2">
	<a id="btnLoadMoreEvidences" class="button-icon highlight-black">
		<span class="fa-stack fa-lg">
			<i class="fa fa-circle fa-stack-2x"></i>
			<i class="fa fa-arrow-down fa-stack-1x fa-inverse"></i>
		</span>
		<p class="text-color-highlight"><?= __('Load more') ?></p>
	</a>
</div>

<!-- LOADING ANIMATION -->
<div class="moreEvidencesLoading hidden padding all-1">
	<?php echo $this->element('loading_animation'); ?>
</div>

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
	$this->Html->script('requirejs/app/Elements/Evidences/evidence_list.js', array('inline' => false));
?>