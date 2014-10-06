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

	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

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

		echo $this->Html->css('/components/foundation/css/foundation');
		echo $this->Html->css('/components/mrmrs-colors/css/colors.min');
		echo $this->Html->css('/components/font-awesome/css/font-awesome.min');
		echo $this->Html->css('/components/foundation/css/foundation');
		echo $this->Html->css('/components/fullpage.js/jquery.fullPage.css');

		echo $this->Html->css('evoke');
		
		if(file_exists(WWW_ROOT.$cssBaseUrl.$cssFileName)) {
			echo $this->Html->css($cssInclude);
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');

		echo $this->fetch('social-metatags');

	?>
	<script src="http://localhost:8000/socket.io/socket.io.js"></script>
	<script src="http://localhost:3000/socket.io/socket.io.js"></script>
</head>
<body class="evoke">

	<section role="main body">
		<?php echo $this->fetch('content'); ?>
	</section>

	<footer class="evoke footer fixed sticky" id="footer">
		<div class="row standard-width  padding top-1 bottom-1">
			<div class="small-12 medium-12 large-12 columns">
			  		&copy;

			  		<?= __('2014') ?> <?php echo strtoupper(__('Evoke'));?> 
			  		
			  		| <?= __('Report an issue') ?>

			  		| <a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'terms'))?>" target="_blank"><?= __('Terms of Service') ?></a>
					
					<a href = "http://www.worldbank.org/" target="_blank"><img src='<?= $this->webroot.'img/wblogo.png' ?>' alt = "<?= __('The World Bank') ?>"/></a>
			</div>
		</div>
	</footer>

	<!-- <script src="http://localhost:8000/socket.io/socket.io.js"></script> -->

	<?php

		echo $this->Html->script('/components/jquery/jquery.min.js');
		echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js");
		echo $this->Html->script('/components/modernizr/modernizr.js');
		echo $this->Html->script('/components/foundation/js/foundation.min.js');
		echo $this->Html->script('/components/fullpage.js/jquery.fullPage.js');
		echo $this->Html->script('/components/fullpage.js/vendors/jquery.easings.min.js');
		echo $this->Html->script('/components/fullpage.js/vendors/jquery.slimscroll.min.js');

		echo $this->Html->script('evoke');
		echo $this->Html->script('footer_bind');

		echo $this->fetch('script'); 
	?>

	<script>

	  //socket io client
	  var socket = io.connect('http://localhost:8000');

	  //on connetion, updates connection state and sends subscribe request
	  socket.on('connect', function(data){
	    setStatus('connected');
	    socket.emit('subscribe', {channel:'notif'});
	    socket.emit('subscribe', {channel:'notifs'});
	  });

	  //when reconnection is attempted, updates status 
	  socket.on('reconnecting', function(data){
	    setStatus('reconnecting');
	  });

/*
	  socket.on('popup', function (data) {
	  	$('#firstModal').foundation('reveal', 'open');
  	  });
*/
	</script>

	<!-- FullPage Login -->
	<script type="text/javascript">
		$(document).ready(function() {
		    $('.fullpage').fullpage({
		    	verticalCentered: true,
		    	paddingTop: ($('#top-bar-login').height()*(-2)).toString()+"px",
		    	paddingBottom: ($('.footer').height()*2).toString()+"px",
		        resize : true,
		        scrollOverflow: true,
		        fixedElements: '#top-bar-login',
				navigation: true, 
				navigationTooltips: ["<?php echo __('Examples of missions'); ?>",
					"<?php echo __('What is Evoke?'); ?>",
					"<?php echo __('Why was Evoke created?'); ?>",
					"<?php echo __('Gameplay'); ?>",
					"<?php echo __('Who is behind Evoke?'); ?>",
					"<?php echo __('How to become an agent?'); ?>"]
		    });
		});
	</script>
</body>
</html>