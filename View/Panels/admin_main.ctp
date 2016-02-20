<?php

	$this->extend('/Common/admin_panel');

	$average_level = $average_points = $allies_user = 0;

	if (sizeof($all_users) > 0) {
		$average_level = $userLevels['all']/sizeof($all_users);
		$average_level = number_format($average_level, 2);


		$average_points = $userLevels['allP']/sizeof($all_users);
		$average_points = number_format($average_points, 2);


		$allies_user = sizeof($allRelations)/sizeof($all_users);
		$allies_user = number_format($allies_user, 2);
	}

	$pe = $ae = 0;

	if (isset($groups) && (sizeof($groups) > 0)) {
		$pe = sizeof($pending_evokations)/sizeof($groups);
		$ae = sizeof($approved_evokations)/sizeof($groups);
	}

?>

<?php $this->start('page_content'); ?>

<div class="row">
  <div class="large-4 columns">
    <div class="widget text-align-center bg-inverse">
        <div class="widget-stat-icon"><i class="fa fa-users"></i></div>
        <div class="widget-stat-info">
            <div class="widget-stat-title"><?= strtoupper(__('Missions Created')) ?></div>
            <div class="widget-stat-number"><?= sizeof($missions) ?></div>
            <!--<div class="widget-stat-text">(3.10% better than last week)</div>-->
        </div>
    </div>
  </div>
  <div class="large-4 columns">
    <div class="widget text-align-center bg-inverse">
        <div class="widget-stat-icon"><i class="fa fa-users"></i></div>
        <div class="widget-stat-info">
            <div class="widget-stat-title"><?= strtoupper(__('Organizations')) ?></div>
            <div class="widget-stat-number"><?= sizeof($organizations) ?></div>
            <!--<div class="widget-stat-text">(3.10% better than last week)</div>-->
        </div>
    </div>
  </div>
  <div class="large-4 columns">
    <div class="widget text-align-center bg-inverse">
        <div class="widget-stat-icon"><i class="fa fa-users"></i></div>
        <div class="widget-stat-info">
            <div class="widget-stat-title"><?= strtoupper(__('Badges')) ?></div>
            <div class="widget-stat-number"><?= sizeof($badges) ?></div>
            <!--<div class="widget-stat-text">(3.10% better than last week)</div>-->
        </div>
    </div>
  </div>
</div> 

<div class="row">
  <div class="large-4 columns">
    <div class="widget text-align-center bg-inverse">
        <div class="widget-stat-icon"><i class="fa fa-users"></i></div>
        <div class="widget-stat-info">
            <div class="widget-stat-title"><?= strtoupper(__('Users')) ?></div>
            <div class="widget-stat-number"><?= sizeof($all_users) ?></div>
            <!--<div class="widget-stat-text">(3.10% better than last week)</div>-->
        </div>
    </div>
  </div>
  <div class="large-4 columns">
    <div class="widget text-align-center bg-inverse">
        <div class="widget-stat-icon"><i class="fa fa-users"></i></div>
        <div class="widget-stat-info">
            <div class="widget-stat-title"><?= strtoupper(__('Allies per user')) ?></div>
            <div class="widget-stat-number"><?= round($allies_user) ?></div>
            <!--<div class="widget-stat-text">(3.10% better than last week)</div>-->
        </div>
    </div>
  </div>
  <div class="large-4 columns">
    <div class="widget text-align-center bg-inverse">
        <div class="widget-stat-icon"><i class="fa fa-users"></i></div>
        <div class="widget-stat-info">
            <div class="widget-stat-title"><?= strtoupper(__('Evokation Teams')) ?></div>
            <div class="widget-stat-number"><?= sizeof($groups) ?></div>
            <!--<div class="widget-stat-text">(3.10% better than last week)</div>-->
        </div>
    </div>
  </div>
</div>

<?php $this->end(); ?>