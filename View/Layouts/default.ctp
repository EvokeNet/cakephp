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

		echo $this->Html->script('/webroot/components/jquery/jquery.min');
		echo $this->Html->script('/webroot/components/foundation/js/foundation.min');

		echo $this->Html->script('facebook_share');
		echo $this->Html->script('google_share');
		echo $this->Html->script('foundation_tabs');

		echo $this->Html->css('tagsinput');
		echo $this->Html->css('/components/chosen/chosen');
		echo $this->Html->css('/components/tagmanager/tagmanager');
		echo $this->Html->css('/components/bootstrap-tagsinput/bootstrap-tagsinput');

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

	<section role="main">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</section>

	<footer class="evoke margin top-2">
		<div class="row">
			<div class="large-12 columns">
				<!-- TODO: standard footer -->
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	<?php
		echo $this->Html->script('/components/jquery/jquery.min');
		echo $this->Html->script('tagsinput');
		echo $this->Html->script('/components/chosen/chosen.jquery');
		echo $this->Html->script('/components/bootstrap-tagsinput/bootstrap-tagsinput');
		echo $this->Html->script('/components/bootstrap-tagsinput/bootstrap-tagsinput-angular');
		
		echo $this->Html->script('/components/foundation/js/foundation.min');
		echo $this->Html->script('evoke');
		echo $this->fetch('script'); 
	?>
</body>
</html>