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

		echo $this->Html->css('/components/foundation/css/foundation');
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

					<!-- Reveal Modals begin -->
					<div id="firstModal" class="reveal-modal" data-reveal>
					  <h2>This is a modal.</h2>
					  <p>Reveal makes these very easy to summon and dismiss. The close button is simply an anchor with a unicode character icon and a class of <code>close-reveal-modal</code>. Clicking anywhere outside the modal will also dismiss it.</p>
					  <p>Finally, if your modal summons another Reveal modal, the plugin will handle that for you gracefully.</p>
					  <p><a href="#" data-reveal-id="secondModal" class="secondary button">Second Modal...</a></p>
					  <a class="close-reveal-modal">&#215;</a>
					</div>
					
				  </div>
				</div>
			</div>
		</div>
	</footer>

	<script src="http://localhost:8000/socket.io/socket.io.js"></script>

	<?php

		echo $this->Html->script('/components/jquery/jquery.min.js');
		echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js");
		echo $this->Html->script('/components/modernizr/modernizr.js');
		echo $this->Html->script('/components/foundation/js/foundation.min.js');
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

	  socket.on('popup', function (data) {
	  	$('#firstModal').foundation('reveal', 'open');
  	  });

	</script>

</body>
</html>