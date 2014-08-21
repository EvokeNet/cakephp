<?php

	echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new',
			'circle'
		)
	);

?>

<div class="sticky">
	<nav class="top-bar" data-topbar data-options="sticky_on: large">
	  <ul class="title-area">
	    <li class="name">
	      <h1><a href="#">My Site</a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right">
	      <li class="active"><a href="#">Right Button Active</a></li>
	      <li class="has-dropdown">
	        <a href="#">Right Button Dropdown</a>
	        <ul class="dropdown">
	          <li><a href="#">First link in dropdown</a></li>
	        </ul>
	      </li>
	    </ul>

	    <!-- Left Nav Section -->
	    <ul class="left">
	      <li><a href="#">Left Nav Button</a></li>
	    </ul>
	  </section>
	</nav>
</div>

<div class="row row-full-width" data-equalizer>
  <div class="large-2 columns padding-left-0" data-equalizer-watch>
	  <div class = "menu-column">
	  	<div class = "text-align-center padding-05" style = "color:white"><?= _('Choose an organization') ?></div>
		<?php foreach($organizations as $o): ?>
	  			<a href = "<?= $this->Html->url(array('controller' => 'panels', 'action' => 'dashboard', $o['Organization']['id'])) ?>">
	  				<div class = "padding-05"><i class="fa fa-university fa-lg"></i>&nbsp;&nbsp;&nbsp;<span><?= $o['Organization']['name'] ?></span></div>
	  			</a>
		<?php endforeach; ?>

		<!-- <dl class="accordion" data-accordion>
		  <dd class="accordion-navigation">
		    <a href="#panel1"><?= _('Choose an organization') ?></a>
		    <div id="panel1" class="content">
		      	<?php foreach($organizations as $o): ?>
		  			<a href = "<?= $this->Html->url(array('controller' => 'panels', 'action' => 'dashboard', $o['Organization']['id'])) ?>">
		  				<div class = "padding-05"><i class="fa fa-university fa-lg"></i>&nbsp;&nbsp;&nbsp;<span><?= $o['Organization']['name'] ?></span></div>
		  			</a>
				<?php endforeach; ?>
		    </div>
		  </dd>
		  <dd class="accordion-navigation">
		    <a href="#panel2"><?= __('Add User') ?></a>
		    <div id="panel2" class="content">
		      Panel 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
		    </div>
		  </dd>
		  <dd class="accordion-navigation">
		    <a href="#panel3"><?= __('Add Organization') ?></a>
		    <div id="panel3" class="content">
		      Panel 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
		    </div>
		  </dd>
		  <dd class="accordion-navigation">
		    <a href="#panel4"><?= __('Add Admin Notification') ?></a>
		    <div id="panel4" class="content">
		      Panel 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
		    </div>
		  </dd>
		</dl> -->

	  </div>
  </div>
  <div class="large-10 columns" data-equalizer-watch>

  	<?php 
		$average_level = $userLevels['all']/sizeof($all_users);
		$average_level = number_format($average_level, 2);

		$average_points = $userLevels['allP']/sizeof($all_users);
		$average_points = number_format($average_points, 2);

		$allies_user = sizeof($allRelations)/sizeof($all_users);
		$allies_user = number_format($allies_user, 2);

		$chosenIssues = array();
		foreach ($pickedIssues as $issue) {
			$chosenIssues[$issue['quantity']][] = $issue['issue'];
		}
		krsort($chosenIssues);

		$pe = sizeof($pending_evokations)/sizeof($groups);
		$ae = sizeof($approved_evokations)/sizeof($groups);

	?>

	<!-- <ul class="small-block-grid-3">
	  <li>
	  	<div class="row" data-equalizer style = "width: 65%;">
		  <div class="large-4 columns" data-equalizer-watch style = "background-color:#8CD1E6; padding: 1.25rem;">
		  	<i class="fa fa-folder-open-o fa-4x" style = "margin-top: 10px; margin-left: -4px;"></i>
		  </div>
		  <div class="large-8 columns" data-equalizer-watch style = "background-color:#A5DBEB; padding: 1.25rem;">
		    <div style = "font-size:2em; line-height: 1.4em;"><?= sizeof($missions_issues) ?></div>
		  	<div style = "word-wrap: break-word;"><?= strtoupper(__('Missions')) ?></div>
		  </div>
		</div>
	  </li>
	  <li>
	  	<div class="row" data-equalizer style = "width: 65%;">
		  <div class="large-4 columns" data-equalizer-watch style = "background-color:#FFAC62; padding: 1.25rem;">
		  	<i class="fa fa-bank fa-4x" style = "margin-top: 10px; margin-left: -4px;"></i>
		  </div>
		  <div class="large-8 columns" data-equalizer-watch style = "background-color:#FFBD82; padding: 1.25rem;">
		    <div style = "font-size:2em; line-height: 1.4em;"><?= sizeof($organizations) ?></div>
		  	<div style = "word-wrap: break-word;"><?= strtoupper(__('Organizations')) ?></div>
		  </div>
		</div>
	  </li>
	  <li>
	  	<div class="row" data-equalizer style = "width: 65%;">
		  <div class="large-4 columns" data-equalizer-watch style = "background-color:#A8A8FF; padding: 1.40rem;">
		  	<i class="fa fa-shield fa-4x" style = "margin-top: 7px; margin-left: 5px;"></i>
		  </div>
		  <div class="large-8 columns" data-equalizer-watch style = "background-color:#B7B7FF; padding: 1.40rem;">
		    <div style = "font-size:2em; line-height: 1.4em;"><?= sizeof($badges) ?></div>
		  	<div style = "word-wrap: break-word;"><?= strtoupper(__('Badges')) ?></div>
		  </div>
		</div>
	  </li>
	  <li>
	  	<div class="row" data-equalizer style = "width: 65%;">
		  <div class="large-4 columns" data-equalizer-watch style = "background-color:#FF5353; padding: 1.25rem;">
		  	<i class="fa fa-star-o fa-4x" style = "margin-top: 10px; margin-left: -4px;"></i>
		  </div>
		  <div class="large-8 columns" data-equalizer-watch style = "background-color:#FF7373; padding: 1.25rem;">
		    <div style = "font-size:2em; line-height: 1.4em;"><?= sizeof($powerpoints) ?></div>
		  	<div style = "word-wrap: break-word;"><?= strtoupper(__('Powers')) ?></div>
		  </div>
		</div>
	  </li>
	  <li>
	  	<div class="row" data-equalizer style = "width: 65%;">
		  <div class="large-4 columns" data-equalizer-watch style = "background-color:#74BAAC; padding: 1.25rem;">
		  	<i class="fa fa-user fa-4x" style = "margin-top: 10px; margin-left: 4px;"></i>
		  </div>
		  <div class="large-8 columns" data-equalizer-watch style = "background-color:#8DC7BB; padding: 1.25rem;">
		    <div style = "font-size:2em; line-height: 1.4em;"><?= sizeof($all_users) ?></div>
		  	<div style = "word-wrap: break-word;"><?= strtoupper(__('Users')) ?></div>
		  </div>
		</div>
	  </li>
	  <li>
	  	<div class="row" data-equalizer style = "width: 65%;">
		  <div class="large-4 columns" data-equalizer-watch style = "background-color:#74BAAC; padding: 1.40rem;">
		  	<div><i class="fa fa-child fa-2x" style = "margin-top: 15px; margin-left:4px"></i><i class="fa fa-child fa-2x"></i></div>
		  </div>
		  <div class="large-8 columns" data-equalizer-watch style = "background-color:#8DC7BB; padding: 1.40rem;">
		    <div style = "font-size:2em; line-height: 1.4em;"><?= round($allies_user) ?></div>
		  	<div style = "word-wrap: break-word;"><?= strtoupper(__('Allies per user')) ?></div>
		  </div>
		</div>
	  </li>
	  <li>
	  	<div class="row" data-equalizer style = "width: 65%;">
		  <div class="large-4 columns" data-equalizer-watch style = "background-color:#FF5353; padding: 1.25rem;">
		  	<i class="fa fa-users fa-4x" style = "margin-top: 10px; margin-left: -4px;"></i>
		  </div>
		  <div class="large-8 columns" data-equalizer-watch style = "background-color:#FF7373; padding: 1.25rem;">
		    <div style = "font-size:2em; line-height: 1.4em;"><?= sizeof($groups) ?></div>
		  	<div style = "word-wrap: break-word;"><?= strtoupper(__('Evokation Teams')) ?></div>
		  </div>
		</div>
	  </li>
	</ul> -->

	<div class="row padding-top-1" data-equalizer>
		<div class="large-8 columns" data-equalizer-watch>
	<ul class="small-block-grid-3">
	  <li><!-- Your content goes here -->
	  	<div class="row" data-equalizer>
			<div class="large-4 columns" data-equalizer-watch>
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-folder-open-o fa-3x"></i></div>
			</div>
			<div class="large-8 columns" data-equalizer-watch>
				<div style = "font-size:2.5em;"><?= sizeof($missions_issues) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Missions Created')) ?></div>
			</div>
		</div>
	  	<!-- <div class = "overall-info-icon" style = "display: inline-block;">
		  	<i class="fa fa-folder-open-o fa-3x"></i>
		</div>
		<div>
		  	<div style = "font-size:2.5em;"><?= sizeof($missions_issues) ?></div>
			<div style = "word-wrap: break-word;"><?= strtoupper(__('Missions Created')) ?></div>
		</div> -->
	  </li>
	  <li><!-- Your content goes here -->
	  	<div class="row" data-equalizer>
			<div class="large-4 columns" data-equalizer-watch>
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-bank fa-3x"></i></div>
			</div>
			<div class="large-8 columns" data-equalizer-watch>
				<div style = "font-size:2.5em;"><?= sizeof($organizations) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Organizations')) ?></div>
			</div>
		</div>
	  	<!-- <div class = "overall-info-icon">
	  		<i class="fa fa-bank fa-3x"></i>
	  	</div>
	  	<div style = "font-size:2.5em;"><?= sizeof($organizations) ?></div>
		<div style = "word-wrap: break-word;"><?= strtoupper(__('Organizations')) ?></div> -->
	  </li>
	  <li><!-- Your content goes here -->
	  	<div class="row" data-equalizer>
			<div class="large-4 columns" data-equalizer-watch>
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-shield fa-3x"></i></div>
			</div>
			<div class="large-8 columns" data-equalizer-watch>
				<div style = "font-size:2.5em;"><?= sizeof($badges) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Badges')) ?></div>
			</div>
		</div>
	  	<!-- <div class = "overall-info-icon">
	  		<i class="fa fa-shield fa-3x"></i>
	  	</div>
	  	<div style = "font-size:2.5em;"><?= sizeof($badges) ?></div>
		<div style = "word-wrap: break-word;"><?= strtoupper(__('Badges')) ?></div> -->
	  </li>
	  <li><!-- Your content goes here -->
	  	<div class="row" data-equalizer>
			<div class="large-4 columns" data-equalizer-watch>
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-star-o fa-3x"></i></div>
			</div>
			<div class="large-8 columns" data-equalizer-watch>
				<div style = "font-size:2.5em;"><?= sizeof($powerpoints) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Power Points')) ?></div>
			</div>
		</div>
	  	<!-- <div class = "overall-info-icon">
	  		<i class="fa fa-star-o fa-3x"></i>
	  	</div>
	  	<div style = "font-size:2.5em;"><?= sizeof($powerpoints) ?></div>
		<div style = "word-wrap: break-word;"><?= strtoupper(__('Power Points')) ?></div> -->
	  </li>
	  <li><!-- Your content goes here -->
	  	<div class="row" data-equalizer>
			<div class="large-4 columns" data-equalizer-watch>
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-user fa-3x"></i></div>
			</div>
			<div class="large-8 columns" data-equalizer-watch>
				<div style = "font-size:2.5em;"><?= sizeof($all_users) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Users')) ?></div>
			</div>
		</div>
	  	<!-- <div class = "overall-info-icon">
	  		<i class="fa fa-user fa-3x"></i>
	  	</div>
	  	<div style = "font-size:2.5em;"><?= sizeof($all_users) ?></div>
		<div style = "word-wrap: break-word;"><?= strtoupper(__('Users')) ?></div> -->
	  </li>
	  <li><!-- Your content goes here -->
	  	<div class="row" data-equalizer>
			<div class="large-4 columns" data-equalizer-watch>
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-sitemap fa-3x"></i></div>
			</div>
			<div class="large-8 columns" data-equalizer-watch>
				<div style = "font-size:2.5em;"><?= round($allies_user) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Allies per user')) ?></div>
			</div>
		</div>
	  	<!-- <div class = "overall-info-icon">
	  		<i class="fa fa-sitemap fa-3x"></i>
	  	</div>
	  	<div style = "font-size:2.5em;"><?= round($allies_user) ?></div>
		<div style = "word-wrap: break-word;"><?= strtoupper(__('Allies per user')) ?></div> -->
	  </li>
	  <li><!-- Your content goes here -->
	  	<div class="row" data-equalizer>
			<div class="large-4 columns" data-equalizer-watch>
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-users fa-3x"></i></div>
			</div>
			<div class="large-8 columns" data-equalizer-watch>
				<div style = "font-size:2.5em;"><?= sizeof($groups) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Evokation Teams')) ?></div>
			</div>
		</div>
	  	<!-- div class = "overall-info-icon">
	  		<i class="fa fa-users fa-3x"></i>
	  	</div>
	  	<div style = "font-size:2.5em;"><?= sizeof($groups) ?></div>
		<div style = "word-wrap: break-word;"><?= strtoupper(__('Evokation Teams')) ?></div> -->
	  </li>
	</ul>
	</div>
	<div class="large-4 columns" data-equalizer-watch>
		<h5>Level</h5>
  		<div class="row">
		  <div class="large-6 columns" style = "padding-right:0;">
		    <!-- <i class="fa fa-edit fa-3x"></i> -->
	  		<div style = "font-size:2.5em; line-height: 1.4em;"><?= round($average_level) ?></div>
			<span style = "word-wrap: break-word;"><?= strtoupper(__('Average')) ?></span>
		  </div>
		  <div class="large-6 columns" style = "padding-right:0;">
		    <!-- <i class="fa fa-spinner fa-3x"></i> -->
	  		<div style = "font-size:2.5em; line-height: 1.4em;"><?= $userLevels['max'] ?></div>
			<div style = "word-wrap: break-word;"><?= strtoupper(__('Highest')) ?></div>
		  </div>
		</div>

		<h5 class = "padding-top-2">Points</h5>
  		<div class="row">
		  <div class="large-6 columns" style = "padding-right:0;">
		    <!-- <i class="fa fa-edit fa-3x"></i> -->
	  		<div style = "font-size:2em; line-height: 1.4em;"><?= round($average_points)*1000 ?></div>
			<div style = "word-wrap: break-word;"><?= strtoupper(__('Average')) ?></div>
		  </div>
		  <div class="large-6 columns" style = "padding-right:0;">
		    <!-- <i class="fa fa-spinner fa-3x"></i> -->
	  		<div style = "font-size:2em; line-height: 1.4em;"><?= $userLevels['maxP'] ?></div>
			<div style = "word-wrap: break-word;"><?= strtoupper(__('Highest')) ?></div>
		  </div>
		</div>
	</div>
</div>


	<div class="row padding-top-2" data-equalizer>
	  
	  <div class="large-4 columns" data-equalizer-watch>
	   	<h5 style = "text-align:center">Evokations</h5>

	   	<div class="row" data-equalizer>
			<!-- <div class="large-4 columns">
			   	<div style = "font-size:2em;"><?= sizeof($groups) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Evokation Teams')) ?></div>
			</div> -->

			<div class="large-6 columns" data-equalizer-watch style = "margin: 100px auto;">

				<div class="row" data-equalizer>
					<div class="large-4 columns" data-equalizer-watch>
						<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-file-text-o fa-3x"></i></div>
					</div>
					<div class="large-8 columns" data-equalizer-watch>
						<div style = "font-size:2.5em;"><?= sizeof($groups) ?></div>
						<div style = "word-wrap: break-word;"><?= strtoupper(__('Created')) ?></div>
					</div>
				</div>
			</div>

			<div class="large-6 columns" data-equalizer-watch>
				<div class="c100 p<?= round($pe*100) ?>">
			        <span><?= sizeof($pending_evokations) ?></span>
			        <div class="slice">
			            <div class="bar"></div>
			            <div class="fill"></div>
			        </div>
			    </div>
			    <p style = "text-align:center"><?= strtoupper(__('Pending')) ?></p>

			    <div class="c100 p<?= round($ae*100) ?>">
			        <span><?= sizeof($approved_evokations) ?></span>
			        <div class="slice">
			            <div class="bar"></div>
			            <div class="fill"></div>
			        </div>
			    </div>
			    <p style = "text-align:center"><?= strtoupper(__('Approved')) ?></p>

			</div>
		</div>
	  </div>

	  <div class="large-3 columns" data-equalizer-watch>
	    <h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
		<i class="fa fa-list-ul"></i>&nbsp;
  		<?= __('Chosen Issues') ?>
	  	</h1>
		<div id="piechart"></div>
	  </div>
	
	<div class="large-5 columns" data-equalizer-watch>

		VISITS

	</div>

	</div>

	<div class="row padding-top-2">
		<div class="large-7 columns">
			<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
		  			<?= __("Users Geolocation")?>
		  	</h1>
			<div id="mapchart"></div>
			<h5 style = "color: #555">
				<?= __('Users from unknown countries') . ': '.$unknown_countries ?>
			</h5>
		</div>
		<div class="large-5 columns">
			<div id="donutchart" style="width: 500px; height: 300px;"></div>
		</div>
	</div>

	<div class="row padding-top-2">
		<div class="large-4 columns">
			<input type="search" class="light-table-filter" data-table="order-table-org" placeholder="<?= __('Search organization') ?>">
			<table class="order-table-org paginated" id = "orgTable">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="checkAll('orgTable', 'org')" name="chk[]" id="org" /></th>
						<th><?= _('Organizations') ?></th>
			      		<th width="25"></th>
			      		<th width="25"><i class="fa fa-plus fa-lg"></i></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($organizations as $m): ?>
			  		<tr>
			  		  <td><input type="checkbox" name="chkbox[]"></td>
				      <td><?= $m['Organization']['name'] ?></td>
				      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
				      <td><i class="fa fa-times fa-lg"></i></td>
				    </tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="large-4 columns">

			<input type="search" class="light-table-filter" data-table="order-table-users" placeholder="<?= __('Search user') ?>">
			<table class="order-table-users paginated" id = "usersTable">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="checkAll('usersTable', 'user')" name="chk[]" id="user" /></th>
						<th><?= _('Users') ?></th>
			      		<th width="25"></th>
			      		<th width="25"><i class="fa fa-plus fa-lg"></i></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($users as $m): ?>
			  		<tr>
			  		  <td><input type="checkbox" name="chkbox[]"></td> 
				      <td><?= $m['User']['name'] ?></td>
				      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
				      <td><i class="fa fa-times fa-lg"></i></td>
				    </tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="large-4 columns">

			<div class="input-prepend">
	    		<span class="add-on"><i class="icon-key"></i></span>
				<input type="search" class="light-table-filter" data-table="order-table-nots" placeholder="<?= __('Search admin notification') ?>">
			</div>
			<table class="order-table-nots paginated" id = "ntsTable">
				<thead>
					<tr>
						<th><input type="checkbox" onclick="checkAll('ntsTable', 'nts')" name="chk[]" id="nts" /></th>
						<th><?= _('Admin Notification') ?></th>
					    <th width="25"></th>
			      		<th width="25"></th>
			      		<th width="25"><i class="fa fa-plus fa-lg"></i></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($admin_notifications as $m): ?>
				  		<tr>
				  		  <td><input type="checkbox" name="chkbox[]"></td>
					      <td><?= $m['AdminNotification']['title'] ?></td>
				      	  <td><i class="fa fa-expand"></i></td>
					      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
					      <td><i class="fa fa-times fa-lg"></i></td>
					    </tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
			
<!-- <INPUT type="button" value="Add Row" onclick="addRow('dataTable1')" />
<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable1')" />
<table id="dataTable1" border="1">
    <thead>
		<tr>
			<th>
            <INPUT type="checkbox" onchange="checkAll('dataTable1', 'selectallh')" name="chk[]" id="selectallh"/>
	        </th>
	        <th>Make</th>
	        <th>Model</th>
	        <th>Description</th>
	        
		</tr>
	</thead>
	<tbody>
		<?php foreach($admin_notifications as $m): ?>
	  		<tr>
	  		<td><input type="checkbox" name="chkbox[]"></td>
		      <td><?= $m['AdminNotification']['title'] ?></td>
		      <td><i class="fa fa-pencil-square-o fa-lg"></i></td>
		      <td><i class="fa fa-times fa-lg"></i></td>
		    </tr>
		<?php endforeach; ?>
	</tbody>
</table>

<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />
<table id="dataTable" border="1">
    <thead>
		<tr>
			<th><input type="checkbox" onclick="checkAll('dataTable', 'selectallq')" name="chk[]" id="selectallq" /></th>
	        <th>Make</th>
	        <th>Model</th>
	        <th>Description</th>
	        
		</tr>
	</thead>
	<tbody>
		<?php foreach($admin_notifications as $m): ?>
	  		<tr>
	  			<td><input type="checkbox" name="chkbox[]"></td>
		      	<td><?= $m['AdminNotification']['title'] ?></td>
		      	<td><i class="fa fa-pencil-square-o fa-lg"></i></td>
		      	<td><i class="fa fa-times fa-lg"></i></td>
		    </tr>
		<?php endforeach; ?>
	</tbody>
</table> -->

  </div>

  <!-- <div class="large-1 columns end" data-equalizer-watch>3 end</div> -->

</div>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	
	function checkAll(id, id1){
	    var tab = document.getElementById(id); // table with id tbl1
	    var elems = tab.getElementsByTagName('input');
	    var len = elems.length;

	    if($('#' + id1).is(":checked")) {
		    for(var i = 0; i<len; i++){
		    	if(elems[i].type == "checkbox")
		    		elems[i].checked = true;
		    }
		} else{
			for(var i = 0; i<len; i++){
		    	if(elems[i].type == "checkbox")
		    		elems[i].checked = false;
		    }
		}
	}

	// Implements search in tables
	(function(document) {
		'use strict';

		var LightTableFilter = (function(Arr) {

			var _input;

			function _onInputEvent(e) {
				_input = e.target;
				var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
				Arr.forEach.call(tables, function(table) {
					Arr.forEach.call(table.tBodies, function(tbody) {
						Arr.forEach.call(tbody.rows, _filter);
					});
				});
			}

			function _filter(row) {
				var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
				row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
			}

			return {
				init: function() {
					var inputs = document.getElementsByClassName('light-table-filter');
					Arr.forEach.call(inputs, function(input) {
						input.oninput = _onInputEvent;
					});
				}
			};
		})(Array.prototype);

		document.addEventListener('readystatechange', function() {
			if (document.readyState === 'complete') {
				LightTableFilter.init();
			}
		});

	})(document);

	//Paginates tables
	$('table.paginated').each(function() {
	    var currentPage = 0;
	    var numPerPage = 10;
	    var $table = $(this);
	    $table.bind('repaginate', function() {
	        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
	    });
	    $table.trigger('repaginate');
	    var numRows = $table.find('tbody tr').length;
	    var numPages = Math.ceil(numRows / numPerPage);
	    var $pager = $('<div class="pager"></div>');
	    for (var page = 0; page < numPages; page++) {
	        $('<a class="page-number"></a>').text(page + 1).bind('click', {
	            newPage: page
	        }, function(event) {
	            currentPage = event.data['newPage'];
	            $table.trigger('repaginate');
	            $(this).addClass('active').siblings().removeClass('active');
	        }).appendTo($pager).addClass('clickable');
	    }
	    $pager.insertAfter($table).find('a.page-number:first').addClass('active');
	});

	//Google charts
	google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Language', 'Speakers (in millions)'],
          <?php 
          	foreach ($chosenIssues as $issueQ => $issue) {
          		foreach ($issue as $is) {
	          		echo '["'.$is.'", '. $issueQ .'],';
          		}
          	}
          ?>
        ]);

      var options = {
        // legend: 'none',
        legend: {textStyle: {color: '#555'}},
        pieSliceText: 'label',
        // pieStartAngle: 100,
        backgroundColor: { fill:'transparent' }
      };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        	chart.draw(data, options);
      	}

      	google.load('visualization', '1', {'packages': ['geochart']});
     	google.setOnLoadCallback(drawRegionsMap);

     	function drawRegionsMap() {
	        var data = google.visualization.arrayToDataTable([
	          	['Country', 'Users '],
	          	<?php 
	          		foreach ($countries as $key => $value) {
	          			echo '["'.$key.'", '.$value.'],';
	          		}
	          	?>
	          // ['Germany', 200],
	          // ['United States', 300],
	          // ['Brazil', 400],
	          // ['Canada', 500],
	          // ['France', 600],
	          // ['RU', 700]
        ]);

        var options = {
        	projection: {
			      name: 'kavrayskiy-vii',
			},
	        backgroundColor: { fill:'transparent' },
	        width: '100%',

        };

        var data1 = google.visualization.arrayToDataTable([
	          	['Country', 'Users '],
	          	<?php 
	          		foreach ($countries as $key => $value) {
	          			echo '["'.$key.'", '.$value.'],';
	          		}
	          	?>
	        ]);

	        var options1 = {
	          title: 'My Daily Activities',
	          pieHole: 0.4,
	        };

        var chart = new google.visualization.GeoChart(document.getElementById('mapchart'));
        chart.draw(data, options);

        var chart1 = new google.visualization.PieChart(document.getElementById('donutchart'));
	        chart1.draw(data1, options1);
    };
</script>