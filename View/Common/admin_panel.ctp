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
  echo $this->element('top-bar-fixed');
  $this->end();
?>

<div id="wrapper">

		<?php echo $this->element('adminsidebar'); ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <div class="container-fluid">

                  <?php echo $this->fetch('page_content'); ?>

        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php $this->Html->script('requirejs/app/Panels/main.js', array('inline' => false)); ?>
