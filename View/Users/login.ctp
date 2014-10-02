<?php
	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>


<div class="row standard-width">

</div>



<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
	echo $this->Html->script("oauthpopup", array('inline' => false));
	echo $this->Html->script("google_login", array('inline' => false));
?>