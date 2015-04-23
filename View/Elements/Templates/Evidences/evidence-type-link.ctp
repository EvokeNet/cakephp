<script id="evidence-type-link-template" type="text/x-handlebars-template">
	<?php echo $this->Form->input('main-content', array('label' => __('Link'), 'class' => 'radius', 'id' => 'evidenceLink', 'value' => 'www.google.com')); ?>

	<button id="refresh-button" class="btn" type="button">Preview</button>

	<div id="preview-container"></div>
</script>

<?php
$this->Html->script('requirejs/app/Elements/Templates/Evidences/evidence_type_link.js', array('inline' => false));
?>