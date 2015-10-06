<?php
	//CSS
	echo $this->Html->css('/css/plugins/linkpreview');
?>
<script id="evidence-type-link-template" type="text/x-handlebars-template">
	<?php echo $this->Form->input('evidenceLink', array('label' => __('Link'), 'class' => 'radius', 'id' => 'evidenceLink')); ?>

	<button id="refresh-button" class="hidden" type="button">Preview</button>

	<div id="preview-container" class="row"></div>
</script>

<?php
$this->Html->script('requirejs/app/Elements/Templates/Evidences/evidence_type_link.js', array('inline' => false));
?>