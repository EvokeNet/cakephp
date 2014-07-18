<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	

	 	<div class="small-10 medium-10 large-10 columns margin top-2 maincolumn body-padding">
			
			<h3 class = "margin bottom-1"> <?= strtoupper(__('Notifications')) ?> </h3>

			<div class = "evoke black-bg badges-bg">

				<div id="whe"><div class="wew"></div></div>

			</div>

		</div>

		<!-- <div class="medium-1 end columns"></div> -->

	</div>

</section>

<script src="http://localhost:8000/socket.io/socket.io.js"></script>

<?php
	// echo $this->Html->scriptBlock("var userId = '" . json_encode($user['User']['id']) . "'", array('inline' => true));
	echo $this->Html->script('/components/jquery/jquery.min.js');
	//echo $this->Html->script('more_notifications');
	echo $this->Html->script('menu_height');
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

  //on new message adds a new message to display
  socket.on('message', function (data) {
    // var msg = data;

    var datas = {user_id:"<?= $user['User']['id'] ?>"};
  	socket.emit('get_all_notifications', datas); //Places notifications when the page is reloaded

  	if(data.notification_id){
    	var datas = {user_id:"<?= $user['User']['id'] ?>"};
    	socket.emit('get_notifications', datas);
    	//addNotification(data.notification_id);
    }

    // var datas = {user_id:"<?= $user['User']['id'] ?>"};
    // var i = msg.split('nid');
    // if(i[0]){
    // 	datas = {user_id:"<?= $user['User']['id'] ?>", notification_id:i[1]}; 
    // } 

    //get notifications from user
	  //var datas = {user_id:"<?= $user['User']['id'] ?>", notification_id:i};
	  // socket.emit('get_notifications', datas);
  });

  //get notifications from user
  // var data = {user_id:"<?= $user['User']['id'] ?>"};
  // socket.emit('get_notifications', data);

  $(document).ready(function() {
  	var data = {user_id:"<?= $user['User']['id'] ?>"};
  	socket.emit('get_all_notifications', data); //Places notifications when the page is reloaded
  });

  //returns notifications
  socket.on('retrieve_all_notifications', function (data) {
    console.log(data);
    addAllNotification(data);
  });

  //scrolling content div down
  function goBottom(){
    var objDiv = document.getElementById("maincolumn");
    objDiv.scrollTop = objDiv.scrollHeight;
  }

  //updates status to the status div
  function setStatus(msg) {
    $('#status').html('Connection Status : ' + msg);
  }

  //adds notfications to div
  function addAllNotification(data) {
    // var str = '<div class="circle message">' + msg + '</div>';
    // $('.message').replaceWith(str)
    // console.log(str)

    var str = '<div class="wew">' + data + '</div><br>';

    $('.wew').replaceWith(str);

    // $(str).appendTo('#wh');
  }

</script>