<?php

	echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new',
			'circle'
		)
	);

	// $redis = new Redis() or die("Cannot load Redis module.");
	// $redis->connect('127.0.0.1');
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

<!-- TOPBAR MENU -->
<div id="missions-menu" class="sticky fixed">
	<?php echo $this->element('topbar', array('sticky' => '', 'fixed' => '')); ?>
</div>

<div class="row full-width padding top-4" data-equalizer>
  <!-- <div class="large-2 columns padding-left-0 gradient-on-right"  style = "background-color: #26dee0; padding-right:0px" data-equalizer-watch> -->
	<div class="large-2 columns padding-left-0 gradient-on-right" data-equalizer-watch>

		<div class = "side-menu">
		  <ul class="side-menu side-nav">

				<!-- <div style = "background-color: rgb(66, 157, 158); height:40px"></div> -->

				<li class = "active">
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'main')) ?>">
						<?= __('Statistics') ?>
					</a>
				</li>
			<?php foreach($organizations as $o): ?>
				<li>
					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'organization', $o['Organization']['id'])) ?>">
						<?= __('Organization ').$o['Organization']['name'] ?>
					</a>
				</li>

		  			<!-- <a href = "<?= $this->Html->url(array('controller' => 'panels', 'action' => 'organization', $o['Organization']['id'])) ?>">
		  				<div class = "padding-05"><i class="fa fa-university fa-lg"></i>&nbsp;&nbsp;&nbsp;<span><?= $o['Organization']['name'] ?></span></div>
		  			</a> -->
			<?php endforeach; ?>

		</ul>
			</div>

  </div>
  <div class="large-10 columns" data-equalizer-watch>
	<div class="row padding-top-1"  >
		<div class="large-8 columns"  >
	<ul class="small-block-grid-3">
	  <li><!-- Your content goes here -->
	  	<div class="row"  >
			<div class="large-4 columns"  >
				<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-folder-open-o fa-3x"></i></div>
			</div>
			<div class="large-8 columns"  >
				<div style = "font-size:2.5em;"><?= sizeof($missions_issues) ?></div>
				<div style = "word-wrap: break-word;"><?= strtoupper(__('Missions Created')) ?></div>
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
	<div class="large-4 columns"  >
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

	<div class="row padding-top-2"  >

	  <div class="large-4 columns"  >
	   	<h5><?= __('Evokations') ?></h5>

	   	<div class="row"  >
			<div class="large-6 columns"   style = "margin: 100px auto;">

				<div class="row" >
					<div class="large-4 columns" -watch>
						<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-file-text-o fa-3x"></i></div>
					</div>
					<div class="large-8 columns"  >
						<div style = "font-size:2.5em;"><?= sizeof($groups) ?></div>
						<div style = "word-wrap: break-word;"><?= strtoupper(__('Created')) ?></div>
					</div>
				</div>
			</div>

			<div class="large-6 columns" >
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

	  <!-- <div class="large-3 columns" >
	    <h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
		<i class="fa fa-list-ul"></i>&nbsp;
  		<?= __('Chosen Issues') ?>
	  	</h1>
		<div id="piechart"></div>
	  </div> -->

	<div class="large-8 columns" >
		<h5><?= __('Monthly Visitors') ?></h5>
		<div id="chart_div"></div>
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
			<div id="donutchart" style="width: 450px; height: 300px;"></div>
		</div>
	</div>

	<ul class="small-block-grid-3 padding-top-2">
		<li>
			<input type="search" class="light-table-filter" data-table="order-table-org" placeholder="<?= __('Search organization') ?>">
			<table class="order-table-org paginated" id = "orgTable">
				<thead>
					<tr>
						<th width="25"><input type="checkbox" onclick="checkAll('orgTable', 'org')" name="chk[]" id="org" /></th>
						<th><?= _('Organizations') ?></th>
			      		<th width="25"></th>
			      		<th width="25"><a href="#" data-reveal-id="myModalAddOrg"><i class="fa fa-plus fa-lg"></i></a></th><!-- Button to add new organization -->
					</tr>
				</thead>
				<tbody>
					<?php foreach($organizations as $m): ?>
			  		<tr>
			  		  <td><input type="checkbox" name="chkbox[]"></td>
				      <td><?= $m['Organization']['name'] ?></td>
				      <td><a href="#" data-reveal-id="myModalEditOrg<?= $m['Organization']['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
				      <td><a href = "/evoke/organizations/delete/<?= $m['Organization']['id'] ?>"><i class="fa fa-times fa-lg"></i></a></td>
				    </tr>

				    <!-- Add new organization form -->
					<div id="myModalEditOrg<?= $m['Organization']['id'] ?>" class="reveal-modal tiny" data-reveal>
					  <!-- <h2>Awesome. I have it.</h2>
					  <p class="lead">Your couch.  It is mine.</p>
					  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
					  <a class="close-reveal-modal">&#215;</a> -->

					  	<?php echo $this->Form->create('Organization', array(
					   		'url' => array(
					   			'controller' => 'organizations',
					   			'action' => 'edit',
					   			$m['Organization']['id'])
						)); ?>

						  <div class="row">
						    <div class="large-12 columns">
						    	<?= $this->Form->input('name', array('label' => __('Name'), 'required' => true, 'value' => $m['Organization']['name'])) ?>
						    </div>
						  </div>
						  <div class="row">
						    <div class="large-6 columns">
						    	<?= $this->Form->input('website', array('label' => __('Website'), 'value' => $m['Organization']['website'])) ?>
						    </div>
						    <div class="large-6 columns">
						     	<?= $this->Form->input('blog', array('label' => __('Blog'), 'value' => $m['Organization']['blog'])) ?>
						    </div>
						  </div>
						  <div class="row">
						    <div class="large-4 columns">
						    	<?= $this->Form->input('facebook', array('label' => __('Facebook'), 'value' => $m['Organization']['facebook'])) ?>
						    </div>
						    <div class="large-4 columns">
						     	<?= $this->Form->input('twitter', array('label' => __('Twitter'), 'value' => $m['Organization']['twitter'])) ?>
						    </div>
						    <div class="large-4 columns">
						      	<?php //$this->Form->input('google_plus', array('label' => __('Google +'), 'value' => $m['Organization']['google_plus'])) ?>
						    </div>
						  </div>
						  <div class="row">
						    <div class="large-12 columns">
						      <label><?= __('Date of Establishment') ?>
						      	<?=
						      		$this->Form->input('birthdate', array(
										'style' => 'width: 32.7%',
										'label' => '',
										'separator' => ' ',
										'dateFormat' => 'DMY',
										'minYear' => date('Y') - 100,
										'maxYear' => date('Y'),
										'value' => $m['Organization']['birthdate']
									));
								?>
						      </label>
						    </div>
						  </div>
						  <div class="row">
						    <div class="large-12 columns">
						    	<?= $this->Form->input('description', array('label' => __('Description'), 'required' => true, 'value' => $m['Organization']['description'])) ?>
						    </div>
						  </div>
						<?php echo $this->Form->end('Edit New Organization'); ?>

						<a class="close-reveal-modal">&#215;</a>
					</div>

					<?php endforeach; ?>
				</tbody>
			</table>

			<!-- Add new organization form -->
			<div id="myModalAddOrg" class="reveal-modal tiny" data-reveal>
			  <!-- <h2>Awesome. I have it.</h2>
			  <p class="lead">Your couch.  It is mine.</p>
			  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
			  <a class="close-reveal-modal">&#215;</a> -->

			  	<?php echo $this->Form->create('Organization', array(
			   		'url' => array(
			   			'controller' => 'organizations',
			   			'action' => 'add')
				)); ?>

				  <div class="row">
				    <div class="large-12 columns">
				    	<?= $this->Form->input('name', array('label' => __('Name'), 'required' => true)) ?>
				      <!-- <label><?= ('Name') ?>
				        <input name="data[Organization][name]" required="required"  type="text" placeholder="<?= ("Type organzation's name") ?>" id="OrganizationName"/>
				      </label> -->
				    </div>
				  </div>
				  <div class="row">
				    <div class="large-6 columns">
				    	<?= $this->Form->input('website', array('label' => __('Website'))) ?>
				      <!-- <label>Input Label
				        <input type="text" placeholder="large-4.columns" />
				      </label> -->
				    </div>
				    <div class="large-6 columns">
				     	<?= $this->Form->input('blog', array('label' => __('Blog'))) ?>
				    </div>
				  </div>
				  <div class="row">
				    <div class="large-4 columns">
				    	<?= $this->Form->input('facebook', array('label' => __('Facebook'))) ?>
				    </div>
				    <div class="large-4 columns">
				     	<?= $this->Form->input('twitter', array('label' => __('Twitter'))) ?>
				    </div>
				    <div class="large-4 columns">
				      	<?= $this->Form->input('google_plus', array('label' => __('Google +'))) ?>
				    </div>
				  </div>
				  <div class="row">
				    <div class="large-12 columns">
				      <label><?= __('Date of Establishment') ?>
				      	<?=
				      		$this->Form->input('birthdate', array(
								'style' => 'width: 32.7%',
								'label' => '',
								'separator' => ' ',
								'dateFormat' => 'DMY',
								'minYear' => date('Y') - 100,
								'maxYear' => date('Y'),
							));
						?>
				      </label>
				    </div>
				  </div>
				  <div class="row">
				    <div class="large-12 columns">
				    	<?= $this->Form->input('description', array('label' => __('Description'), 'required' => true)) ?>
				    </div>
				  </div>
				<?php echo $this->Form->end('Add New Organization'); ?>

				<a class="close-reveal-modal">&#215;</a>
			</div>

		</li>
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
		<li>

			<div class="input-prepend">
	    		<span class="add-on"><i class="icon-key"></i></span>
				<input type="search" class="light-table-filter" data-table="order-table-nots" placeholder="<?= __('Search admin notification') ?>">
			</div>
			<table class="order-table-nots paginated" id = "ntsTable">
				<thead>
					<tr>
						<th width="25"><input type="checkbox" onclick="checkAll('ntsTable', 'nts')" name="chk[]" id="nts" /></th>
						<th><?= _('Admin Notification') ?></th>
					    <th width="25"></th>
			      		<th width="25"></th>
			      		<th width="25"><a href="#" data-reveal-id="myModalAddNts"><i class="fa fa-plus fa-lg"></i></a></th><!-- Button to add new notification -->
					</tr>
				</thead>
				<tbody>
					<?php foreach($admin_notifications as $m): ?>
				  		<tr>
				  		  <td><input type="checkbox" name="chkbox[]"></td>
					      <td><?= $m['AdminNotification']['title'] ?></td>
				      	  <td><i class="fa fa-expand"></i></td>
					      <td><a href="#" data-reveal-id="myModalEditNts<?= $m['AdminNotification']['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
					      <td><a href="<?php echo $this->Html->url(array('controller'=>'AdminNotifications', 'action' => 'delete', $m['AdminNotification']['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></td>
					    </tr>

					    <!-- Add new notification form -->
						<div id="myModalEditNts<?= $m['AdminNotification']['id'] ?>" class="reveal-modal tiny" data-reveal>
						  <?php echo $this->Form->create('AdminNotification', array(
								'url' => array(
									'controller' => 'AdminNotifications',
									'action' => 'edit',
									$m['AdminNotification']['id']
								))); ?>

							<?php
								echo $this->Form->input('title', array(
									'label' => __('Title'),
									'required' => true,
									'value' => $m['AdminNotification']['title']
								));
								echo $this->Form->input('description', array(
									'label' => __('Description'),
									'required' => true,
									'type' => 'textarea',
									'value' => $m['AdminNotification']['description']
								));
								echo $this->Form->hidden('user_id', array(
									'value' => $user['User']['id']
								));

							?>
							<button class="button general" type="submit">
								<?php echo __('Edit'); ?>
							</button>
							<?php echo $this->Form->end(); ?>

						  <a class="close-reveal-modal">&#215;</a>
						</div>

					<?php endforeach; ?>
				</tbody>
			</table>

			<!-- Add new notification form -->
			<div id="myModalAddNts" class="reveal-modal tiny" data-reveal>
			  <?php echo $this->Form->create('AdminNotification', array(
					'url' => array(
						'controller' => 'AdminNotifications',
						'action' => 'add'
				))); ?>

				<?php
					echo $this->Form->input('title', array(
						'label' => __('Title'),
						'required' => true
					));
					echo $this->Form->input('description', array(
						'label' => __('Description'),
						'required' => true,
						'type' => 'textarea'
					));
					echo $this->Form->hidden('user_id', array(
						'value' => $user['User']['id']
					));

				?>
				<button class="button general" type="submit">
					<?php echo __('Add'); ?>
				</button>
				<?php echo $this->Form->end(); ?>

			  <a class="close-reveal-modal">&#215;</a>
			</div>

		</li>

		<li>
			<input type="search" class="light-table-filter" data-table="order-table-issues" placeholder="<?= __('Search issues') ?>">
			<table class="order-table-issues paginated" id = "issuesTable">
				<thead>
					<tr>
						<th width="25"><input type="checkbox" onclick="checkAll('issuesTable', 'iss')" name="chk[]" id="iss" /></th>
						<th><?= _('Issues') ?></th>
			      		<th width="25"></th>
			      		<th width="25"><a href="#" data-reveal-id="myModalAddIssue"><i class="fa fa-plus fa-lg"></i></a></th><!-- Button to add new user -->
					</tr>
				</thead>
				<tbody>
					<?php foreach($issues as $i): ?>
			  		<tr>
			  		  <td><input type="checkbox" name="chkbox[]"></td>
				      <td><?= $i['Issue']['name'] ?></td>
				      <td><a href="#" data-reveal-id="myModalEditIssue<?= $i['Issue']['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
				      <td><a href="<?php echo $this->Html->url(array('controller'=>'issues', 'action' => 'delete', $i['Issue']['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></td>
				    </tr>

				    <!-- Add new notification form -->
					<div id="myModalEditIssue<?= $i['Issue']['id'] ?>" class="reveal-modal tiny" data-reveal>
				  		<?php echo $this->Form->create('Issue', array(
	 				   		'url' => array(
	 				   			'controller' => 'issues',
	 				   			'action' => 'edit',
	 				   			$i['Issue']['id'])
							)); ?>

						<?php echo __('Edit Issue'); ?>
						<?php
							//echo $this->Form->input('parent_id');
							echo $this->Form->input('name', array('label' => __('Name'), 'value' => $i['Issue']['name']));
							echo $this->Form->input('slug', array('label' => __('Slug'), 'value' => $i['Issue']['slug']));
						?>

						<button class="button general" type="submit">
							<?php echo __('Edit'); ?>
						</button>
						<?php echo $this->Form->end(); ?>

					  <a class="close-reveal-modal">&#215;</a>
					</div>

					<?php endforeach; ?>
				</tbody>
			</table>

			<!-- Add new notification form -->
			<div id="myModalAddIssue" class="reveal-modal tiny" data-reveal>
			  		<?php echo $this->Form->create('Issue', array(
	 				   		'url' => array(
	 				   			'controller' => 'issues',
	 				   			'action' => 'add')
							)); ?>

						<?php echo __('Add an Issue'); ?>
						<?php
							//echo $this->Form->input('parent_id');
							echo $this->Form->input('name', array('label' => __('Name')));
							echo $this->Form->input('slug', array('label' => __('Slug')));
						?>

						<button class="button general" type="submit">
							<?php echo __('Add'); ?>
						</button>
						<?php echo $this->Form->end(); ?>

			  <a class="close-reveal-modal">&#215;</a>
			</div>

		</li>

		<li>
			<input type="search" class="light-table-filter" data-table="order-table-evokations" placeholder="<?= __('Search user') ?>">
			<table class="order-table-evokations paginated" id = "evokationsTable">
				<thead>
					<tr>
						<th width="25"><input type="checkbox" onclick="checkAll('evokationsTable', 'evo')" name="chk[]" id="evo" /></th>
						<th><?= _('Evokations') ?></th>
			      		<th><?= _('Status') ?></th>
			      		<th width="25"><!-- <a href="#" data-reveal-id="myModalAddUser"><i class="fa fa-plus fa-lg"></i></a> --></th><!-- Button to add new user -->
					</tr>
				</thead>
				<tbody>
					<?php
					$evokations = array_merge($all_evokations);

					$status = 'Approved';

					foreach($evokations as $m):
						if($m['Evokation']['approved'] != null) {
			            	$status = "Approved";
			            } else if($m['Evokation']['final_sent'] == 1){
			            	$status = "Pending";
			            } else{
			            	$status = "In Progress";
			            }
			        ?>

			  		<tr>
			  		  <td><input type="checkbox" name="chkbox[]"></td>
				      <td><?= $m['Evokation']['title'] ?></td>
				      <td><a href="#" data-reveal-id="myModalEditStatus<?= $m['Evokation']['id'] ?>"><?= $status ?></a></td>
				      <td><i class="fa fa-times fa-lg"></i></td>
				    </tr>

				    <!-- Add new notification form -->
					<div id="myModalEditStatus<?= $m['Evokation']['id'] ?>" class="reveal-modal tiny" data-reveal>
				  		<?php
							echo $this->Form->create('Evokation', array(
						 		'url' => array(
						 			'controller' => 'panels',
						 			'action' => 'changeEvokationStatus',
						 			$m['Evokation']['id']
						 		)
							));
								echo $this->Form->hidden('id', array('value' => $m['Evokation']['id']));

								echo $this->Form->radio('approved', array(0 => 'Unapproved', 1 => 'Approved'), array('default' => $m['Evokation']['approved']));
						?>
						<button class="button tiny" type="submit">
							<?php echo __('Save Changes')?>
						</button>
						<?php echo $this->Form->end(); ?>

					  <a class="close-reveal-modal">&#215;</a>
					</div>

					<?php endforeach; ?>

				</tbody>
			</table>
		  </li>

	</ul>

	<ul class="small-block-grid-3 padding-top-2">
		<li>
			<?php
				echo $this->Form->create('Config', array(
						'url' => array(
							'controller' => 'panels',
							'action' => 'settings'
						)
				));

				echo '<div class="row collapse">';

				// if(isset($groups[0]) && $groups[0]['Group']['max_global'] != 0) {
				// 	echo $this->Form->input('max_global', array(
				// 		//'label' => __('Define the limit of agents per group: '),
				// 		'value' => $groups[0]['Group']['max_global']
				// 	));
				// } else {
				// 	echo $this->Form->input('max_global', array(
				// 		'label' => __('Define the limit of agents per group: ')
				// 	));
				// }

				echo '</div>';

				echo '<legend>' . __('Points Definitions: ') . '</legend>';

				//points general def.

				if(!empty($register_points))
					echo $this->Form->input('Register.points', array(
						'label' => __("Agent's register is worth: "),
						'value' => $register_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('Register.points', array(
						'label' => __("Agent's register is worth: ")
					));


				if(!empty($allies_points))
					echo $this->Form->input('Allies.points', array(
						'label' => __("Agent's follow agent is worth: "),
						'value' => $allies_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('Allies.points', array(
						'label' => __("Agent's follow agent is worth: ")
					));


				if(!empty($like_points))
					echo $this->Form->input('Like.points', array(
						'label' => __("Agent's like is worth: "),
						'value' => $like_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('Like.points', array(
						'label' => __("Agent's like is worth: ")
					));

				if(!empty($vote_points))
					echo $this->Form->input('Vote.points', array(
						'label' => __("Agent's vote is worth: "),
						'value' => $vote_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('Vote.points', array(
						'label' => __("Agent's vote is worth: ")
					));


				if(!empty($evokationFollow_points))
					echo $this->Form->input('EvokationFollow.points', array(
						'label' => __("Agent's follow evokation is worth: "),
						'value' => $evokationFollow_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('EvokationFollow.points', array(
						'label' => __("Agent's follow evokation is worth: ")
					));

				if(!empty($evokationComment_points))
					echo $this->Form->input('EvokationComment.points', array(
						'label' => __("Agent's evokation comment is worth: "),
						'value' => $evokationComment_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('EvokationComment.points', array(
						'label' => __("Agent's evokation comment is worth: ")
					));

				if(!empty($evidenceComment_points))
					echo $this->Form->input('EvidenceComment.points', array(
						'label' => __("Agent's evidence comment is worth: "),
						'value' => $evidenceComment_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('EvidenceComment.points', array(
						'label' => __("Agent's evidence comment is worth: ")
					));

				if(!empty($basicTraining_points))
					echo $this->Form->input('BasicTraining.points', array(
						'label' => __("Agent's basic training is worth: "),
						'value' => $basicTraining_points['PointsDefinition']['points']
					));
				else
					echo $this->Form->input('BasicTraining.points', array(
						'label' => __("Agent's basic training is worth: ")
					));

			?>
			<button class="button general" type="submit">
				<?php echo __('Save Settings')?>
			</button>
			<?php echo $this->Form->end(); ?>
		</li>

		<li>
			<?php

				echo '<legend>' . __('Define Levels ') . '</legend>';

				$nextLevel = 1;
				echo $this->Form->create('Level', array(
					'url' => array(
						'controller' => 'panels',
						'action' => 'level'
					)
				));
				foreach ($levels as $level):
					echo '<div><label for="levelOld'.$level['Level']['id'].'">Level '.$level['Level']['level'].'</label></div>';

					echo $this->Form->input('level.old.'.$level['Level']['id'], array(
						'label' => false,
						'value' => $level['Level']['points'],
						'required' => true
					));

					$nextLevel++;
				endforeach;

				echo '<div><label for="levelNew'.$nextLevel.'">Level '.$nextLevel.'</label></div>';

				echo $this->Form->input('level.new.'.$nextLevel, array(
					'label' => false,
					'required' => true
				));

				$nextLevel++;
			?>
			<button class="button general" type="submit">
				<?php echo __('Save levels'); ?>
			</button>
			<?php echo $this->Form->end(); ?>
		</li>
	</ul>

  </div>

</div>

<?php
	//echo $this->Html->script('/webroot/components/jquery/jquery.min.js');
?>

<!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
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


</script>
