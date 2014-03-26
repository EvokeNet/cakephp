<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$title = __('Evoke Network');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title; ?>
	</title>
	<?php

		$cssInclude = strtolower($this->name);
		$cssFileName = strtolower($this->name).'.css';
		$cssBaseUrl = Configure::read('App.cssBaseUrl');

		echo $this->Html->meta('icon');

		echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');
		echo $this->Html->css('/components/foundation/css/foundation.min');
		echo $this->Html->css('/components/mrmrs-colors/css/colors.min');
		echo $this->Html->css('/components/font-awesome/css/font-awesome.min');
		echo $this->Html->css('evoke');


		if(file_exists(WWW_ROOT.$cssBaseUrl.$cssFileName)) {
			echo $this->Html->css($cssInclude);
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');

	?>
</head>
<body class="evoke">

	<section role="main body">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</section>

	<footer class="footer margin top-2">
		<div class="row">
			<div class="large-12 columns">
				<!-- <img src = '/evoke/webroot/img/world_bank.png' alt = "" class = "evoke world-bank-icon"/> -->
				<!-- TODO: standard footer -->
			</div>
		</div>
	</footer>
	
	<?php

		echo $this->Html->script('/components/jquery/jquery.min');
		echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js");
		echo $this->Html->script('/components/modernizr/modernizr');
		echo $this->Html->script('/components/foundation/js/foundation.min');
		echo $this->Html->script('/components/jcarousel/dist/jquery.jcarousel');
		echo $this->Html->script('/components/jcarousel/examples/responsive/jcarousel.responsive');
		echo $this->Html->script('evoke');
		
		echo $this->fetch('script'); 
	?>
</body>
</html>