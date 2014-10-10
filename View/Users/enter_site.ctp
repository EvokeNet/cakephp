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

<div class="standard-width text-center padding all-1">
	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $user_id)); ?>">
		<img src="<?= $this->webroot.'img/mockup-5-option1.jpg' ?>" alt="Option 1 - Create your identity" class="img-glow-on-hover-small margin right-1" />
	</a>
	<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>">
		<img src="<?= $this->webroot.'img/mockup-5-option2.jpg' ?>" alt="Option 2 - Engage in a mission" class="img-glow-on-hover-small margin right-1" />
	</a>
	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'evokation')); ?>">
		<img src="<?= $this->webroot.'img/mockup-5-option3.jpg' ?>" alt="Option 3 - Create your evokation" class="img-glow-on-hover-small margin right-1" />
	</a>
</div>


<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>