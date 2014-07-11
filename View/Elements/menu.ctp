<?php 
	$dashboardlink = '';
	$missionslink = '';
	$leaderboardlink = '';
	$badgeslink = '';
	$evokationslink = '';
	$forumslink = '';
	$notificationslink = '';

	$currentPlugin = $this->params['plugin'];
	$currentController = $this->params['controller'];
	$currentAction = $this->params['action'];

	if($currentController == 'users') {
		if($currentAction == 'dashboard') {
			$dashboardlink = 'class="evoke current"';
		} else {
			if($currentAction == 'leaderboard') {
				$leaderboardlink = 'class="evoke current"';
			}
		}
	} else {
		if($currentController == 'badges') {
			$badgeslink = 'class="evoke current"';
		} if($currentController == 'missions') {
			$missionslink = 'class="evoke current"';
		} if($currentController == 'notifications') {
			$notificationslink = 'class="evoke current"';
		} if($currentController == 'groups') {
			$evokationslink = 'class="evoke current"';
		} if($currentController == 'forums')	{
			$forumslink = 'class="evoke current"';
		}
	}

	if(isset($user['User']['role_id']))
		$src  = $user['User']['role_id'];
	else
		$src = $user['role_id'];

	$notesCount = count($userNotifications);

	//debug($userNotifications);
?>

<div class = "evoke menu-bg sidebar menucolumn">
	<ul>
	  <li <?=$dashboardlink?>><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard')) ?>"><i class="fa fa-folder-open" style="padding-right: 10px;"></i><?= strtoupper(__('Dashboard')) ?></a></li>
	  
	  <li <?=$missionslink?>><a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'index')) ?>"><i class="fa fa-crosshairs" style="padding-right: 10px;"></i><?= strtoupper(__('Missions')) ?></a></li>
	  
	  <li <?=$evokationslink?>><a href="<?= $this->Html->url(array('controller' => 'groups', 'action' => 'evokations')) ?>"><i class="fa fa-users" style="padding-right: 10px;"></i><?= strtoupper(__('Evokations')) ?></a></li>
	  
	  <li <?=$forumslink?>><a href="<?= $this->Html->url(array('controller' => 'forums', 'action' => 'index')) ?>"><i class="fa fa-comments" style="padding-right: 10px;"></i></i><?= strtoupper(__('Forums')) ?></a></li>
	  
	  <li <?=$badgeslink?>><a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index')) ?>"><i class="fa fa-shield" style="padding-right: 10px;"></i><?= strtoupper(__('Badges')) ?></a></li>
	  
	  <li <?=$notificationslink?>>
	  	<a id = "notificationsItem" href="<?= $this->Html->url(array('controller' => 'notifications', 'action' => 'index')) ?>">
	  		<i class="fa fa-exclamation-triangle" style="padding-right: 10px;"></i><?= strtoupper(__('Notifications')) ?>

	  		<div id="messages circle"><div class="message"></div></div>

	  		<?php if($notesCount > 0): ?>
		  		<!-- <span class = "circle"><?= $notesCount ?></span> -->
		  	<?php endif; ?>
  		</a>
  	  </li>
	  
	  <li <?=$leaderboardlink?>><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'leaderboard')) ?>"><i class="fa fa-trophy" style="padding-right: 10px;"></i><?=strtoupper(__('Leaderboard')) ?></a></li>
	  
	  <?php if($src <= 2) : ?>
	  	<li><a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'index')) ?>"><i class="fa fa-cogs" style="padding-right: 10px;"></i><?= strtoupper(__('Administration')) ?></a></li>
	  <?php endif ?>
	</ul>

</div>

<script src="http://localhost:8000/socket.io/socket.io.js"></script>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
?>

<script>

  //socket io client
  var socket = io.connect('http://localhost:8000');

  //on connetion, updates connection state and sends subscribe request
  socket.on('connect', function(data){
    setStatus('connected');
    socket.emit('subscribe', {channel:'notif'});
  });

  //when reconnection is attempted, updates status 
  socket.on('reconnecting', function(data){
    setStatus('reconnecting');
  });

  //on new message adds a new message to display
  socket.on('message', function (data) {
    // var msg = "";
    //var msg = data.text;
    var msg = data;
    // if (data.channel) {
    //   msg += 'Channel:' + data.channel + ', ' + data.text; 
    // } else {
    //   msg = data.text;
    // }
    addMessage(msg);
  });

  $(function() {
  	var datas = {user_id:"<?= $user['User']['id'] ?>"};
  	socket.emit('what', datas);
  });

  //updates status to the status div
  function setStatus(msg) {
    $('#status').html('Connection Status : ' + msg);
  }

  //adds message to messages div
  function addMessage(msg) {
    var str = '<div class="message">' + msg + '</div>';
    console.log(str)
    $('.message').replaceWith(str)
  }

</script>