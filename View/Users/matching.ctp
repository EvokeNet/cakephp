<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Generating your user profile', 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>

<div class="standard-width">
	<img src="<?= $this->webroot.'img/mockup-3-matching-questions.jpg' ?>" class="full-width" />
</div>


<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>