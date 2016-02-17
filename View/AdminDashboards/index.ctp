<?php
	/* echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new',
			'circle'
		)
	); */

	$average_level = $average_points = $allies_user = 0;

	if (sizeof($all_users) > 0) {
		$average_level = $userLevels['all']/sizeof($all_users);
		$average_level = number_format($average_level, 2);

		$average_points = $userLevels['allP']/sizeof($all_users);
		$average_points = number_format($average_points, 2);

		//$allies_user = sizeof($allRelations)/sizeof($all_users);
		//$allies_user = number_format($allies_user, 2);
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

<?php
  $this->start('topbar');
  echo $this->element('topbar-fixed');
  $this->end();
?>

<div id="wrapper">

		<?php echo $this->element('adminsidebar'); ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <div class="container-fluid">

                  <h2 class = "uppercase font-weight-bold"><?= __("Statistics") ?></h2>
                  <!--<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                  <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>-->

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

        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php $this->Html->script('requirejs/app/Panels/main.js', array('inline' => false)); ?>
