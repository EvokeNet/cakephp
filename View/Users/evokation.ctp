<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

<div class="standard-width">
	<img src="<?= $this->webroot.'img/mockup-6-evokation.jpg' ?>" class="full-width" />
</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>