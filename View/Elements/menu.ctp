<?php 
	$dashboardlink = '';
	$missionslink = '';
	$leaderboardlink = '';
	$badgeslink = '';
	$evokationslink = '';
	$forumlink = '';
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
		} else {
			if($currentController == 'missions') {
				$missionslink = 'class="evoke current"';
			} if($currentController == 'notifications') {
				$notificationslink = 'class="evoke current"';
			} if($currentController == 'groups') {
				$evokationslink = 'class="evoke current"';
			} if(($currentPlugin == 'forum') && ($currentController == 'forum'))	{
				$forumlink = 'class="evoke current"';
			}
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
	  <li <?=$dashboardlink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'dashboard')) ?>"><i class="fa fa-folder-open" style="padding-right: 10px;"></i><?= strtoupper(__('Dashboard')) ?></a></li>
	  
	  <li <?=$missionslink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'missions', 'action' => 'index')) ?>"><i class="fa fa-crosshairs" style="padding-right: 10px;"></i><?= strtoupper(__('Missions')) ?></a></li>
	  
	  <li <?=$evokationslink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'groups', 'action' => 'evokations')) ?>"><i class="fa fa-users" style="padding-right: 10px;"></i><?= strtoupper(__('Evokations')) ?></a></li>
	  
	  <li <?=$forumlink?>><a href="<?= $this->Html->url(array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'index')) ?>"><i class="fa fa-comments" style="padding-right: 10px;"></i></i><?= strtoupper(__('Forum')) ?></a></li>
	  
	  <li <?=$badgeslink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'badges', 'action' => 'index')) ?>"><i class="fa fa-shield" style="padding-right: 10px;"></i><?= strtoupper(__('Badges')) ?></a></li>
	  
	  <li <?=$notificationslink?>>
	  	<a id = "notificationsItem" href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'notifications', 'action' => 'index')) ?>">
	  		<i class="fa fa-exclamation-triangle" style="padding-right: 10px;"></i><?= strtoupper(__('Notifications')) ?>
	  		<?php if($notesCount > 0): ?>
		  		<span class = "circle"><?= $notesCount ?></span>
		  	<?php endif; ?>
  		</a>
  	  </li>
	  
	  <li <?=$leaderboardlink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'leaderboard')) ?>"><i class="fa fa-trophy" style="padding-right: 10px;"></i><?=strtoupper(__('Leaderboard')) ?></a></li>
	  
	  <?php if($src <= 2) : ?>
	  	<li><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'panels', 'action' => 'index')) ?>"><i class="fa fa-cogs" style="padding-right: 10px;"></i><?= strtoupper(__('Administration')) ?></a></li>
	  <?php endif ?>
	</ul>
</div>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
?>

<script type="text/javascript" charset="utf-8">

	function saveReadNotifications(){
		//alert("YAY");
		jQuery.ajax({
		    type: 'POST',
		    url: "<?= 'saveNotifications/'. $userNotifications . '/' . $user['User']['id']?>",
		    success: function() {
		        alert("YAY1");
		    },
		    error: function() {
		        // console.log(e);
		    }
		});
	}

	jQuery("#notificationsItem").click(function (){
		saveReadNotifications();
	});

</script>