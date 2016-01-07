<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>

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

<div class="row">
	<div class="columns">
		<h2 class="text-glow"><?=__("Admin Panel")?></h2>
	</div>
</div>
<div class="row full-width" data-equalizer>
	<div class="large-2 columns padding-left-0 gradient-on-right" data-equalizer-watch>

		<div class="side-menu">
		    <ul class="side-menu side-nav">
				<li id="statisticsLink" class = "active">
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'new_main')) ?>">
						<?= __('Statistics') ?>
					</a>
				</li>
				<li id="usersLink" class"">
					<a id="btnShowUserMenu">
						<?= __('Users') ?>
					</a>
				</li>
			<?php foreach($organizations as $o): ?>
				<li>
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'organization', $o['Organization']['id'])) ?>">
						<?= __('Organization ').$o['Organization']['name'] ?>
					</a>
				</li>
			<?php endforeach; ?>

		    </ul>
		</div>
	</div>
  	<div class="large-10 columns" data-equalizer-watch>
  		
		<div id="content">
			<div id="statistics" class="row padding-top-1"  >
				<div class="large-12 columns"  >
					<ul class="small-block-grid-3">
						<li><!-- Your content goes here -->
					  		<div class="row"  >
								<div class="large-4 columns"  >
									<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-folder-open-o fa-3x"></i>
									</div>
								</div>
								<div class="large-8 columns"  >
									<div style = "font-size:2.5em;"><?= sizeof($missions_issues) ?>
									</div>
									<div style = "word-wrap: break-word;"><?= strtoupper(__('Missions Created')) ?>
									</div>
								</div>
							</div>
					  	</li>

						<li><!-- Your content goes here -->
						  	<div class="row"  >
								<div class="large-4 columns"  >
									<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-bank fa-3x"></i></div>
								</div>
								<div class="large-8 columns"  >
									<div style = "font-size:2.5em;"><?= sizeof($organizations) ?></div>
									<div style = "word-wrap: break-word;"><?= strtoupper(__('Organizations')) ?></div>
								</div>
							</div>
						</li>

						<li><!-- Your content goes here -->
						  	<div class="row"  >
								<div class="large-4 columns"  >
									<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-shield fa-3x"></i></div>
								</div>
								<div class="large-8 columns"  >
									<div style = "font-size:2.5em;"><?= sizeof($badges) ?></div>
									<div style = "word-wrap: break-word;"><?= strtoupper(__('Badges')) ?></div>
								</div>
							</div>
						</li>

						<li><!-- Your content goes here -->
						  	<div class="row"  >
								<div class="large-4 columns"  >
									<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-user fa-3x"></i></div>
								</div>
								<div class="large-8 columns"  >
									<div style = "font-size:2.5em;"><?= sizeof($all_users) ?></div>
									<div style = "word-wrap: break-word;"><?= strtoupper(__('Users')) ?></div>
								</div>
							</div>
						</li>

						<li><!-- Your content goes here -->
						  	<div class="row"  >
								<div class="large-4 columns"  >
									<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-sitemap fa-3x"></i></div>
								</div>
								<div class="large-8 columns"  >
									<div style = "font-size:2.5em;"><?= round($allies_user) ?></div>
									<div style = "word-wrap: break-word;"><?= strtoupper(__('Allies per user')) ?></div>
								</div>
							</div>
						</li>

						<li><!-- Your content goes here -->
						  	<div class="row"  >
									<div class="large-4 columns"  >
										<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-users fa-3x"></i></div>
									</div>
									<div class="large-8 columns"  >
										<div style = "font-size:2.5em;"><?= sizeof($groups) ?></div>
										<div style = "word-wrap: break-word;"><?= strtoupper(__('Evokation Teams')) ?></div>
									</div>
								</div>
						</li>

					</ul>
				</div>
			</div>
			<div id="userMenu" class="row padding-top-1 hidden">
				<div class="large-12 columns"  >
					<ul class="small-block-grid-3">
						<li>
							<input type="search" class="light-table-filter" data-table="order-table-users" placeholder="<?= __('Search user') ?>">
							<table class="order-table-users paginated" id = "usersTable">
								<thead>
									<tr>
										<th width="25"><input type="checkbox" onclick="checkAll('usersTable', 'user')" name="chk[]" id="user" /></th>
										<th><?= _('Users') ?></th>
							      		<th width="25"></th>
							      		<th width="25"><a href="#" data-reveal-id="myModalAddUser"><i class="fa fa-plus fa-lg"></i></a></th><!-- Button to add new user -->
									</tr>
								</thead>
								<tbody>
									<?php foreach($users as $m): ?>
							  		<tr>
							  		  <td><input type="checkbox" name="chkbox[]"></td>
								      <td><?= $m['User']['name'] ?></td>
								      <td><a href="#" data-reveal-id="myModalEditUser<?= $m['User']['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
								      <td><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'panel_delete', $m['User']['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></td>
								    </tr>

								    <?= $this->element('panel/edit_user', array('m' => $m)) ?>

								<?php endforeach; ?>
								</tbody>
							</table>

							<?= $this->element('panel/add_user') ?>

						</li>
					</ul>
				</div>
			</div>
		</div>		
	</div>
</div>
<?php
	//SCRIPT
  	$this->Html->script('requirejs/app/Panels/main.js', array('inline' => false));
?>