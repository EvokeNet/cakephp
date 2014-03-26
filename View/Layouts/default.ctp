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

		echo $this->Html->script('/components/jquery/jquery.min');//

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
<body>

	<section role="main evoke body">
		<?php //echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</section>

	<footer class="evoke footer">
		<div class="row">
			<div class="large-12 columns">
				<div class="row">
				  <div class="small-5 small-centered columns">
				  
				  	<img src = '/evoke/webroot/img/evoke_icon_footer.png' alt = "" class = "evoke icon margin-top"/>
				  	<h6 class = "evoke heading terms">2014 &nbsp;&nbsp; EVOKE | Report an issue | Terms of Service</h6>
					<img src = '/evoke/webroot/img/wblogo.png' alt = ""/>
					
				  </div>
				</div>
				<!-- <div class = "evoke-logo">
					<img src = '/evoke/webroot/img/evoke_icon_footer.png' alt = ""/>
					<div>20142014201420142014</div>
				</div>
				<div class = "wb"><img src = '/evoke/webroot/img/world_bank.png' alt = ""/></div> -->
				<!-- TODO: standard footer -->
			</div>
		</div>
	</footer>
	<?php

		echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js', array('inline' => false));
		echo $this->Html->script('/components/foundation/js/foundation.min', array('inline' => false));
		echo $this->Html->script('evoke', array('inline' => false));

		echo $this->fetch('script'); 
	?>
</body>
</html>