<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Agent key strengths', 'imgSrc' => ($this->webroot.'img/header-profile.jpg')));
	$this->end();
?>

<div class="standard-width">
	<img src="<?= $this->webroot.'img/mockup-4-matching-results.jpg' ?>" class="full-width" />
</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>