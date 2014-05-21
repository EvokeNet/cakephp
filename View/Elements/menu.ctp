<?php 
	$dashboardlink = '';
	$missionslink = '';
	$leaderboardlink = '';
	$badgeslink = '';
	$evokationslink = '';
	$forumlink = '';

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
?>
<div class = "evoke menu-bg sidebar menucolumn">
	<ul>
	  <li <?=$dashboardlink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'dashboard')) ?>"><i class="fa fa-folder-open" style="padding-right: 10px;"></i><?= strtoupper(__('Dashboard')) ?></a></li>
	  <li <?=$missionslink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'missions', 'action' => 'index')) ?>"><i class="fa fa-crosshairs" style="padding-right: 10px;"></i><?= strtoupper(__('Missions')) ?></a></li>
	  <li <?=$evokationslink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'groups', 'action' => 'evokations')) ?>"><i class="fa fa-users" style="padding-right: 10px;"></i><?= strtoupper(__('Evokation Teams')) ?></a></li>
	  <li <?=$forumlink?>><a href="<?= $this->Html->url(array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'index')) ?>"><i class="fa fa-comments" style="padding-right: 10px;"></i></i><?= strtoupper(__('Forum')) ?></a></li>
	  <li <?=$badgeslink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'badges', 'action' => 'index')) ?>"><i class="fa fa-shield" style="padding-right: 10px;"></i><?= strtoupper(__('Badges')) ?></a></li>
	  <li <?=$leaderboardlink?>><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'leaderboard')) ?>"><i class="fa fa-trophy" style="padding-right: 10px;"></i><?=strtoupper(__('Leaderboard')) ?></a></li>
	  <?php if($src <= 2) : ?>
	  	<li><a href="<?= $this->Html->url(array('plugin' => '', 'controller' => 'panels', 'action' => 'index')) ?>"><i class="fa fa-cogs" style="padding-right: 10px;"></i><?= strtoupper(__('Administration')) ?></a></li>
	  <?php endif ?>
	</ul>
</div>