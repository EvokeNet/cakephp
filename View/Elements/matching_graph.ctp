<canvas id="radar-graph" height="<?= (isset($height) ? $height : '450') ?>" width="<?= (isset($width) ? $width : '500') ?>" ></canvas>

<?php
	/* Script */
	$this->start('script');
	echo $this->Html->script('requirejs/app/Elements/matching_graph.js');
	$this->end(); ?>