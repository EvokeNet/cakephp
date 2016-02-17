<?php

	$this->extend('/Common/admin_panel');

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => true, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
			'panels',
			'circle'
		)
	);

	$average_level = $average_points = $allies_user = 0;

	if (sizeof($all_users) > 0) {
		$average_level = $userLevels['all']/sizeof($all_users);
		$average_level = number_format($average_level, 2);

		$average_points = $userLevels['allP']/sizeof($all_users);
		$average_points = number_format($average_points, 2);

		$allies_user = sizeof($allRelations)/sizeof($all_users);
		$allies_user = number_format($allies_user, 2);
	}

	$chosenIssues = array();
	foreach ($pickedIssues as $issue) {
		$chosenIssues[$issue['quantity']][] = $issue['issue'];
	}
	krsort($chosenIssues);

	$pe = $ae = 0;
	if (isset($groups) && (sizeof($groups) > 0)) {
		$pe = sizeof($pending_evokations)/sizeof($groups);
		$ae = sizeof($approved_evokations)/sizeof($groups);
	}

?>

<?php $this->start('page_content'); ?>

<ul class="small-block-grid-3">
    <li>
        <div class = "font-green uppercase font-weight-bold" style = "font-size:2.5em;"><?= sizeof($missions_issues) ?></div>
        <div style = "word-wrap: break-word;"><?= strtoupper(__('Missions Created')) ?></div>
    </li>

    <li>
        <div class = "font-green uppercase font-weight-bold" style = "font-size:2.5em;"><?= sizeof($organizations) ?></div>
        <div style = "word-wrap: break-word;"><?= strtoupper(__('Organizations')) ?></div>
    </li>

    <li>
        <div class = "font-green uppercase font-weight-bold" style = "font-size:2.5em;"><?= sizeof($badges) ?></div>
        <div style = "word-wrap: break-word;"><?= strtoupper(__('Badges')) ?></div>
    </li>

    <li>
        <div class = "font-green uppercase font-weight-bold" style = "font-size:2.5em;"><?= sizeof($all_users) ?></div>
        <div style = "word-wrap: break-word;"><?= strtoupper(__('Users')) ?></div>
    </li>

    <!--<li>
        <div class = "font-green uppercase font-weight-bold" style = "font-size:2.5em;"><?= round($allies_user) ?></div>
        <div style = "word-wrap: break-word;"><?= strtoupper(__('Allies per user')) ?></div>
    </li>-->

    <li>
        <div class = "font-green uppercase font-weight-bold" style = "font-size:2.5em;"><?= sizeof($groups) ?></div>
        <div style = "word-wrap: break-word;"><?= strtoupper(__('Evokation Teams')) ?></div>
    </li>

</ul>
       
<?php $this->end(); ?>