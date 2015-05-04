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
	if(!isset($user['User'])) {
		$src = 3;
	} else {
		if(isset($user['User']['role_id']))
			$src  = $user['User']['role_id'];
		else
			$src = $user['role_id'];
	}

	// $notesCount = count($userNotifications);

	//debug($userNotifications);
?>

<div class = "evoke menu-bg sidebar margin top-5">
	<ul class="no-marker">
	  <li <?=$dashboardlink?>><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard')) ?>"><i class="fa fa-folder-open" style="padding-right: 10px;"></i><?= strtoupper(__('Dashboard')) ?></a></li>
	  
	  <li <?=$missionslink?>><a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'index')) ?>"><i class="fa fa-crosshairs" style="padding-right: 10px;"></i><?= strtoupper(__('Missions')) ?></a></li>
	  
	  <li <?=$evokationslink?>><a href="<?= $this->Html->url(array('controller' => 'groups', 'action' => 'evokations')) ?>"><i class="fa fa-users" style="padding-right: 10px;"></i><?= strtoupper(__('Evokations')) ?></a></li>
	  
	  <li <?=$badgeslink?>><a href="<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index')) ?>"><i class="fa fa-shield" style="padding-right: 10px;"></i><?= strtoupper(__('Badges')) ?></a></li>
	 <!--  
	  <li <?=$notificationslink?>>
	  	<a id = "notificationsItem" href="#">
	  		<i class="fa fa-exclamation-triangle" style="padding-right: 10px;"></i><?= strtoupper(__('Notifications')) ?>
	  		<div id="msgs" style = "display:inline"><div class="message"></div></div>
  		</a>
  	  </li> -->
	  
	  <li <?=$leaderboardlink?>><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'leaderboard')) ?>"><i class="fa fa-trophy" style="padding-right: 10px;"></i><?=strtoupper(__('Leaderboard')) ?></a></li>
	  
	  <?php if($src <= 2) : ?>
	  	<li><a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'index')) ?>"><i class="fa fa-cogs" style="padding-right: 10px;"></i><?= strtoupper(__('Administration')) ?></a></li>
	  <?php endif ?>
	</ul>

	<div id="wh"><div class="ww"></div></div>

</div>