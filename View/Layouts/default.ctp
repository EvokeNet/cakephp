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
	<meta http-equiv="X-UA-Compatible" content="IE=edge;" /> <!-- Forces IE to use the last compatible version -->
	
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title; ?>
	</title>
	<?php
		$cssInclude = strtolower($this->name);
		$cssFileName = strtolower($this->name).'.css';
		$cssBaseUrl = Configure::read('App.cssBaseUrl');

		echo $this->Html->meta('icon');

		
		echo $this->Html->css('/components/mrmrs-colors/css/colors.min');

		echo $this->Html->css('/components/font-awesome/css/font-awesome.min'); //Icon font - font-awesome
		echo $this->Html->css('font-awesome'); //Overriding some of the font-awesome css
		
		echo $this->Html->css('font-brankic'); //Icon font - brankic 1979
		
		echo $this->Html->css('/components/foundation/css/foundation');
		echo $this->Html->css('foundation'); //Overriding some of the foundation css

		echo $this->Html->css('evoke');
		
		
		if(file_exists(WWW_ROOT.$cssBaseUrl.$cssFileName)) {
			echo $this->Html->css($cssInclude); //CSS for each view set
		}

		echo $this->fetch('meta');
		echo $this->fetch('css');

		echo $this->fetch('social-metatags');

	?>
	<!--<script src="http://localhost:8000/socket.io/socket.io.js"></script>
	<script src="http://localhost:3000/socket.io/socket.io.js"></script>-->
</head>
<body class="evoke">

	<?php 
	if ($this->fetch('topbar')) {
		echo $this->fetch('topbar'); 
	}
	?>

	<section role="main body" class="full-height">
		<?php 
		if ($this->fetch('image_header')) {
			echo $this->fetch('image_header'); 
		}
		?>

		<?php echo $this->fetch('content'); ?>
	</section>

	<?php 
	if ($this->fetch('footer')) {
		echo $this->fetch('footer'); 
	}
	?>

	<!-- <script src="http://localhost:8000/socket.io/socket.io.js"></script> -->

	<?php
		// //JQUERY
		// echo $this->Html->script('/components/jquery/dist/jquery.min.js');
		// echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js");

		// //MODERNIZR
		// echo $this->Html->script('/components/modernizr/modernizr.js');

		// //FOUNDATION
		// echo $this->Html->script('/components/foundation/js/foundation.min.js');

		// echo $this->Html->script('evoke');

		//REQUIREJS ?>
		<script type="text/javascript">
            var webroot = "<?php echo $this->webroot; ?>";
        </script> <?php
        echo $this->Html->script("/components/requirejs/require", [
            'data-main' => $this->webroot.'js/requirejs/bootstrap'
        ]);

        //SCRIPTS IN EACH VIEW
		//echo $this->fetch('script');
	?>


	<script>
/*
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


	  socket.on('popup', function (data) {
	  	$('#firstModal').foundation('reveal', 'open');
  	  });
*/
	</script>

</body>
</html>