<?php
	echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new',
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

<?php
  $this->start('topbar');
  echo $this->element('top-bar-fixed');
  $this->end();
?>

<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="<?= $this->Html->url(array('controller' => 'admin_dashboards', 'action' => 'index'))?>" class = "uppercase">
                        <?= __('Admin Dashboard') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'admin_index'))?>" class = "uppercase"><?= __('Users') ?></a>
                </li>
                <li>
                    <a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'admin_index'))?>" class = "uppercase"><?= __('Missions') ?></a>
                </li>
                <li>
                    <a href="<?= $this->Html->url(array('controller' => 'organizations', 'action' => 'admin_index'))?>" class = "uppercase"><?= __('Organizations') ?></a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">

                      <h1>Simple Sidebar</h1>
                      <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screenstemplate has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                      <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
