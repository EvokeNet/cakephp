<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Generating your agent profile', 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>

<div class="standard-width">
	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'matching_results')); ?>">
		<img src="<?= $this->webroot.'img/mockup-3-matching-questions.jpg' ?>" class="full-width" />
	</a>
</div>


<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>