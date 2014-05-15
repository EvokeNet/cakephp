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

		//echo $this->Html->script('/components/jquery/jquery.min');

		echo $this->Html->css('/components/foundation/css/foundation.min');
		echo $this->Html->css('/components/mrmrs-colors/css/colors.min');
		echo $this->Html->css('/components/font-awesome/css/font-awesome.min');

		echo $this->Html->css('evoke');


		if(file_exists(WWW_ROOT.$cssBaseUrl.$cssFileName)) {
			echo $this->Html->css($cssInclude);
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');

		echo $this->fetch('social-metatags');

	?>
</head>
<body class="evoke">

	<section role="main body">
		<?php echo $this->fetch('content'); ?>
	</section>

	<footer class="footer" id="footer">
		<div class="row">
			<div class="small-12 medium-12 large-12 columns">
				<div class="row">
				  <div class="small-5 small-centered columns">
				  
				  	<div class = "evoke footer-margin-top">
					  	<h2><?php echo strtoupper(__('Evoke'));?></h2>
					  	<h6>2014 &nbsp;&nbsp; EVOKE | <?= __('Report an issue') ?> | <a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'terms'))?>" target="_blank"><?= __('Terms of Service') ?></a></h6>
						<div class = "evoke footer-world-bank"><img src = '<?= $this->webroot.'img/wblogo.png' ?>' alt = ""/></div>
					</div>
					
				  </div>
				</div>
			</div>
		</div>
	</footer>
	<?php

		echo $this->Html->script('/components/jquery/jquery.min.js');
		echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js");
		echo $this->Html->script('/components/modernizr/modernizr.js');
		echo $this->Html->script('/components/foundation/js/foundation.min.js');
		echo $this->Html->script('evoke');
		echo $this->Html->script('footer_bind');

		echo $this->fetch('script'); 
	?>
</body>
</html>