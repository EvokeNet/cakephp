<?php
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

<section class="evoke fullpage">
	<div class="evoke row margin bottom-3">
		<div class="evoke small-12 medium-12 large-12 columns">
			<h1 class="text-center text-color-highlight margin top-1 bottom-05">Report an issue</h1>
		</div>
	</div>
</section>

<!-- FOOTER -->
<?php
	echo $this->element('footer', array('footerClass' => ''));
?>
<!-- FOOTER -->