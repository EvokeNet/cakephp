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
	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'enter_site')); ?>">
		<img src="<?= $this->webroot.'img/mockup-4-matching-results.jpg' ?>" class="full-width" />
	</a>
</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>