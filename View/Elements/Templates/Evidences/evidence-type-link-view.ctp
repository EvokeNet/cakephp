<?php
	//CSS
	echo $this->Html->css('/css/plugins/linkpreview');
?>

<button id="refresh-button" class="refresh-button hidden" type="button">Preview</button>

<div id="preview-container" class="preview-container row"></div>

<?php
$this->Html->script('requirejs/app/Elements/Templates/Evidences/evidence_type_link_view.js', array('inline' => false));
?>