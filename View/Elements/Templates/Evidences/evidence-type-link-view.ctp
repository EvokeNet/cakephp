<?php
	//CSS
	echo $this->Html->css('linkpreview');
?>

<button id="refresh-button" class="hidden" type="button">Preview</button>

<div id="preview-container" class="row"></div>

<?php
$this->Html->script('requirejs/app/Elements/Templates/Evidences/evidence_type_link_view.js', array('inline' => false));
?>