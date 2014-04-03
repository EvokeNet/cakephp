<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $userid)); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li class="name">
				<h1><?= sprintf(__('Hi %s'), $username[0]) ?></h1>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $userid)); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="margin top-2">
	<div class="row max-width">
		<div class="large-12 columns">
			<h1><?= __('Admin Panel') ?></h1>
			<dl class="tabs" data-tab>
				<dd class="<?php echo $organizations_tab; ?>"><a href="#organizations"><?= __('Organizations') ?></a></dd>
				<dd class="<?php echo $missions_tab; ?>"><a href="#missions"><?= __('Missions') ?></a></dd>
				<?php if($flags['_admin']) : ?>
					<dd class="<?php echo $issues_tab; ?>"><a href="#issues"><?= __('Issues') ?></a></dd>
					<dd class="<?php echo $levels_tab; ?>"><a href="#levels"><?= __('Levels') ?></a></dd>
				<?php endif; ?>	
				<dd class="<?php echo $badges_tab; ?>"><a href="#badges"><?= __('Badges') ?></a></dd>
				<dd class="<?php echo $users_tab; ?>"><a href="#users"><?= __('Users') ?></a></dd>
				<?php if($flags['_admin']) echo '<dd class="<?php echo $media_tab; ?>"><a href="#media">'.__('Media').'</a></dd>'; ?>
				<dd class="<?php echo $statistics_tab; ?>"><a href="#statistics"><?= __('Statistics') ?></a></dd>
			</dl>
			<div class="tabs-content">
				<div class="content <?php echo $organizations_tab; ?>" id="organizations">
					<?php
						if($flags['_admin']) :
							echo '<h4>'. __('Organizations in EVOKE:') .'</h4>';
						else :
							echo '<h4>'. __('My organizations in EVOKE:') .'</h4>';
						endif;
					?>
					<table class="paginated">
						<?php foreach ($organizations as $organization) { ?>
							<tr>
								<td><?php echo $this->Html->Link($organization['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['Organization']['id'])); ?></td>
								<td><?php echo $this->Html->Link(__('Edit'), array('controller' => 'organizations', 'action' => 'edit', $organization['Organization']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink(__('Delete'), array('controller' => 'organizations', 'action' => 'delete', $organization['Organization']['id']), array( 'class' => 'button tiny alert')); ?></td>
								</tr>
						<?php }	?>
					</table>

					<button class="button small" data-reveal-id="myModalOrganization" data-reveal><?php echo __('New Organization');?></button>
					<div id="myModalOrganization" class="reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('Organization', array(
 						   		'url' => array(
 						   			'controller' => 'panels',
 						   			'action' => 'add_org')
								)); ?>
						<fieldset>
							<legend><?php echo __('Add an Organization'); ?></legend>
							<?php
								echo $this->Form->input('name', array('label' => __('Name'), 'required' => true));
								echo $this->Form->input('birthdate', array('label' => __('Birthdate')));
								echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
								echo $this->Form->input('website', array('label' => __('Website')));
								echo $this->Form->input('facebook');
								echo $this->Form->input('twitter');
								echo $this->Form->input('blog');
								if($flags['_admin']) {
									//if its an admin, use $possible_managers..
									echo $this->Form->input('UserOrganization.users_id', array(
										'label' => __('Possible Managers'),
										'options' => $possible_managers,
										'multiple' => 'checkbox',
										'required' => true
									));
								} else {
									//else use my id
									echo $this->Form->hidden('UserOrganization.user_id', array('value' => $userid));
								}				
							?>
						</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				</div>
				<div class="content <?php echo $missions_tab; ?> large-12 columns" id="missions">
					<div class="large-10 columns">
						<?php echo $this->Html->Link(__('Add new Mission'), array('controller' => 'panels', 'action' => 'add_mission'), array( 'class' => 'button'));?>
				  		
					  		<!-- creating delete post buttons to be referenced at js -->
					  		<?php foreach ($missions_issues as $mi) : ?>
					  				<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'missions', 'action' => 'delete', $mi['Mission']['id']), array( 'class' => 'button tiny alert', 'id' => 'deleteMission'.$mi['Mission']['id'], 'style' => 'display:none')); ?>
							<?php endforeach; ?>
						
						<div id="MissionsHolder" style="width:auto"></div>
					</div> 
				</div>
				<div class="content <?php echo $issues_tab; ?>" id="issues">
					<div class="large-10 columns">
			  			<button class="button" data-reveal-id="myModalIssue" data-reveal><?php echo __('New Issue');?></button>
			    		
			    		<div id="myModalIssue" class="reveal-modal tiny" data-reveal>
							<?php echo $this->Form->create('Issue', array(
		 				   		'url' => array(
		 				   			'controller' => 'panels',
		 				   			'action' => 'add_issue')
								)); ?>
							<fieldset>
								<legend><?php echo __('Add an Issue'); ?></legend>
								<?php
									//echo $this->Form->input('parent_id');
									echo $this->Form->input('name', array('label' => __('Name')));
									echo $this->Form->input('slug', array('label' => __('Slug')));
								?>
							</fieldset>
							<button class="button small" type="submit">
								<?php echo __('Add'); ?>
							</button>
							<?php echo $this->Form->end(); ?>
							<a class="close-reveal-modal">&#215;</a>
						</div>			    			
					</div>
				</div>
				<div class="content <?php echo $levels_tab; ?>" id="levels">
					<p>Not defined.. levels details go here.</p>
				</div>
				<div class="content <?php echo $badges_tab; ?>" id="badges">
					<button class="button small" data-reveal-id="myModalBadge" data-reveal><?php echo __('New Badge');?></button>
					<div id="myModalBadge" class="reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('Badge', array(
 						   		'url' => array(
 						   			'controller' => 'panels',
 						   			'action' => 'add_badge')
								)); ?>
							<fieldset>
								<legend><?php echo __('Add a Badge'); ?></legend>
							<?php
								echo $this->Form->input('name', array('label' => __('Name'), 'required' => true));
								echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
								echo $this->Form->input('organization_id', array(
									'label' => __('Organization'),
									'options' => $organizations_list
								));
							?>
							</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
					<table class="paginated">
						<?php foreach ($badges as $badge) : ?>
							<tr>
								<td><?php echo $this->Html->Link($badge['Badge']['name'], array('controller' => 'badges', 'action' => 'view', $badge['Badge']['id'])); ?></td>
								<td><?php echo $this->Html->Link(__('Edit'), array('controller' => 'badges', 'action' => 'edit', $badge['Badge']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink(__('Delete'), array('controller' => 'badges', 'action' => 'delete', $badge['Badge']['id']), array( 'class' => 'button tiny alert', 'id' => 'deleteBadge'.$badge['Badge']['id'])); ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
				<div class="content <?php echo $users_tab; ?>" id="users">
					<!--<div class="large-2 columns filter">
			  			<fieldset>
			    			<?php if($flags['_admin']) : ?>
					    		<legend><?= __('Roles') ?></legend>
			    			 	<ul id="filters2">
					    		<?php foreach ($roles as $role) : ?>
								    <li>
								       	<input type="checkbox" checked="true" value="role_<?php echo $role['Role']['id'];?>" id="filter-role_<?php echo $role['Role']['id'];?>" />
								       	<label for="filter-role_<?php echo $role['Role']['id'];?>">
								       		<?php echo $role['Role']['name'];?>
								       	</label>
								    </li>
							<?php endforeach; ?>
							<?php else : ?>
					    		<legend><?= __('My Missions') ?></legend>
			    			 	<ul id="filters2">
					    		<?php foreach ($missions_issues as $mission) : ?>
									<li>
								       	<input type="checkbox" checked="true" value="mission_<?php echo $mission['Mission']['id'];?>" id="filter-mission_<?php echo $mission['Mission']['id'];?>" />
								       	<label for="filter-mission_<?php echo $mission['Mission']['id'];?>">
								       		<?php echo $mission['Mission']['title'];?>
								       	</label>
								    </li>
								<?php endforeach; ?>
							<?php endif; ?>
							</ul>
						</fieldset>
					</div>-->
					<div class="large-10 columns">
						<?php if($flags['_admin']) :
								foreach ($all_users as $user) : ?>
									<!-- Lightbox for editing user role -->
									<div id="user-<?php echo $user['User']['id']; ?>" class="reveal-modal tiny" data-reveal>
										<?php 
											echo $this->Form->create('User', array(
										 		'url' => array(
										 			'controller' => 'panels',
										 			'action' => 'edit_user_role', 
										 			$user['User']['id']
										 		)
											));
										 ?>
										<fieldset>
											<legend><?php echo __('Change role') .': '. $user['User']['name']; ?></legend>
										<?php
											echo $this->Form->hidden('id', array('value' => $user['User']['id']));
											echo $this->Form->input('role_id', array(
												'label' => __('Role'),
												'options' => $roles_list,
												'value' => $user['User']['role_id']
											));
										?>
										</fieldset>
											<button class="button tiny" type="submit">
												<?php echo __('Save Changes')?>
											</button>
											<?php echo $this->Form->end(); ?>
										<a class="close-reveal-modal">&#215;</a>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							<div id="UsersHolder"></div>
					</div>
				</div>
				<div class="content <?php echo $media_tab; ?>" id="media">
					<p>Upload videos/images and choose actions that triggers them...</p>
				</div>
				<div class="content <?php echo $statistics_tab; ?>" id="statistics">
					<p><?php echo __('Users') . ": " . sizeof($all_users);?></p>
					<p><?php echo __('Groups') . ": " . sizeof($groups);?></p>
					<p><?php echo __('Organizations') . ": " . sizeof($organizations);?></p>
					<p><?php echo __('Badges') . ": ".sizeof($badges);?></p>
					<p>AND MORE!</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js" type="text/javascript"></script> -->


    
<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');
	echo $this->Html->script('/components/foundation/js/foundation.min.js');
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));

	echo $this->Html->script('panels');
?>
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js" type="text/javascript"></script>
<link rel='stylesheet' href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css"/>
<?php
	echo $this->Html->script('jquery.watable');
?>

<script type="text/javascript">
    $(document).ready( function() {

        //An example with all options.
         var waTableMissions= $('#MissionsHolder').WATable({
            //debug:true,                 //Prints some debug info to console
            pageSize: 10,                //Initial pagesize
            transition: 'slide',       //Type of transition when paging (bounce, fade, flip, rotate, scroll, slide).Requires https://github.com/daneden/animate.css.
            transitionDuration: 0.2,    //Duration of transition in seconds.
            filter: true,               //Show filter fields
            pageSizes: [],  //Set custom pageSizes. Leave empty array to hide button.
            hidePagerOnEmpty: true,     //Removes the pager if data is empty.
            preFill: false, //true,              //Initially fills the table with empty rows (as many as the pagesize).
            types: {                    //Following are some specific properties related to the data types
                string: {
                    //filterTooltip: "Giggedi..."    //What to say in tooltip when hoovering filter fields. Set false to remove.
                    //placeHolder: "Type here..."    //What to say in placeholder filter fields. Set false for empty.
                },
                number: {
                    decimals: 1   //Sets decimal precision for float types
                },
                bool: {
                    //filterTooltip: false
                },
                date: {
                  utc: true,            //Show time as universal time, ie without timezones.
                  //format: 'yy/dd/MM',   //The format. See all possible formats here http://arshaw.com/xdate/#Formatting.
                  datePicker: true      //Requires "Datepicker for Bootstrap" plugin (http://www.eyecon.ro/bootstrap-datepicker).
                }
            },
            tableCreated: function(data) {    //Fires when the table is created / recreated. Use it if you want to manipulate the table in any way.
                console.log('table created'); //data.table holds the html table element.
                console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                console.log('row clicked');   //data.event holds the original jQuery event.
                console.log(data);            //data.row holds the underlying row you supplied.
                                              //data.column holds the underlying column you supplied.
                                              //data.checked is true if row is checked.
                                              //'this' keyword holds the clicked element.
                if ( $(this).hasClass('userId') ) {
                  data.event.preventDefault();
                  alert('You clicked userId: ' + data.row.userId);
                }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              console.log('column clicked');  //data.event holds the original jQuery event
              console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              console.log('page changed');    //data.event holds the original jQuery event
              console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              console.log('pagesize changed');//data.event holds teh original event
              console.log(data);              //data.pageSize holds the new pagesize
            }
        }).data('WATable');  //This step reaches into the html data property to get the actual WATable object. Important if you want a reference to it as we want here.

        //Generate some data
        var data = getDataMissions();
        waTableMissions.setData(data);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTableMissions.getData(false); //Gets the data you previously set.
        var checkedRows = waTableMissions.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTableMissions.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTableMissions.option("pageSize"); //Get option
        //waTable.option("pageSize", pageSize); //Set option


        //An example with all options.
         var waTableUsers = $('#UsersHolder').WATable({
            //debug:true,                 //Prints some debug info to console
            pageSize: 10,                //Initial pagesize
            transition: 'slide',       //Type of transition when paging (bounce, fade, flip, rotate, scroll, slide).Requires https://github.com/daneden/animate.css.
            transitionDuration: 0.2,    //Duration of transition in seconds.
            filter: true,               //Show filter fields
            pageSizes: [],  //Set custom pageSizes. Leave empty array to hide button.
            hidePagerOnEmpty: true,     //Removes the pager if data is empty.
            preFill: false, //true,              //Initially fills the table with empty rows (as many as the pagesize).
            types: {                    //Following are some specific properties related to the data types
                string: {
                    //filterTooltip: "Giggedi..."    //What to say in tooltip when hoovering filter fields. Set false to remove.
                    //placeHolder: "Type here..."    //What to say in placeholder filter fields. Set false for empty.
                },
                number: {
                    decimals: 1   //Sets decimal precision for float types
                },
                bool: {
                    //filterTooltip: false
                },
                date: {
                  utc: true,            //Show time as universal time, ie without timezones.
                  //format: 'yy/dd/MM',   //The format. See all possible formats here http://arshaw.com/xdate/#Formatting.
                  datePicker: true      //Requires "Datepicker for Bootstrap" plugin (http://www.eyecon.ro/bootstrap-datepicker).
                }
            },
            tableCreated: function(data) {    //Fires when the table is created / recreated. Use it if you want to manipulate the table in any way.
                console.log('table created'); //data.table holds the html table element.
                console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                console.log('row clicked');   //data.event holds the original jQuery event.
                console.log(data);            //data.row holds the underlying row you supplied.
                                              //data.column holds the underlying column you supplied.
                                              //data.checked is true if row is checked.
                                              //'this' keyword holds the clicked element.
                if ( $(this).hasClass('userId') ) {
                  data.event.preventDefault();
                  alert('You clicked userId: ' + data.row.userId);
                }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              console.log('column clicked');  //data.event holds the original jQuery event
              console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              console.log('page changed');    //data.event holds the original jQuery event
              console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              console.log('pagesize changed');//data.event holds teh original event
              console.log(data);              //data.pageSize holds the new pagesize
            }
        }).data('WATable');  //This step reaches into the html data property to get the actual WATable object. Important if you want a reference to it as we want here.

        //Generate some data
        var dataU = getDataUsers();
        waTableUsers.setData(dataU);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTableUsers.getData(false); //Gets the data you previously set.
        var checkedRows = waTableUsers.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTableUsers.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTableUsers.option("pageSize"); //Get option

    });

    //Generates some data. This step is of course normally done by your web server.
    function getDataMissions() {

        //First define the columns
        var cols = {
            userRole: {
                index: 1, //The order this column should appear in the table
                type: "string", //The type. Possible are string, number, bool, date(in milliseconds).
                friendly: "Issue",  //Name that will be used in header. Can also be any html as shown here.
                format: "<a href='role.com' class='userId' target='_blank'>{0}</a>",  //Used to format the data anything you want. Use {0} as placeholder for the actual data.
                //unique: true,  //This is required if you want checkable rows, or to use the rowClicked callback. Be certain the values are really unique or weird things will happen.
                sortOrder: "asc", //Data will initially be sorted by this column. Possible are "asc" or "desc"
                tooltip: "<?= __('Each mission is related to an issue')?>", //Show some additional info about column
                placeHolder: "<?= __('Search missions by issue...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
                //filter: "1..400" //Set initial filter.
            },
            name: {
                index: 2,
                type: "string",
                friendly: "Title",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find missions, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search missions by title...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
	    	$mission_titles_array = "";
	    	$mission_ids_array = "";
	    	foreach ($missions_issues as $mi) :
	    		$mission_titles_array .= '"'. $mi['Mission']['title'] .'", ';
	    		$mission_ids_array .= '"'. $mi['Mission']['id'] .'", ';
	    	endforeach;
	    	$mission_ids_array = substr($mission_ids_array, 0, strlen($mission_ids_array) - 2);
	    	$mission_titles_array = substr($mission_titles_array, 0, strlen($mission_titles_array) - 2);
	    ?>
    
    	<?php 
	    	$mission_issues_array = "";
	    	$mission_issues_id_array = "";
	    	foreach ($issues as $issue) 
	    	 	foreach ($missions_issues as $mi)
	    			foreach ($mi['MissionIssue'] as $i) 
	    				if($issue['Issue']['id'] == $i['issue_id']) {
	    					$mission_issues_array .= '"'. $issue['Issue']['name'] .'", ';
	    					$mission_issues_id_array .= '"'. $issue['Issue']['id'] .'", ';
	    				}
	    	$mission_issues_array = substr($mission_issues_array, 0, strlen($mission_issues_array) - 2);
    		$mission_issues_id_array = substr($mission_issues_id_array, 0, strlen($mission_issues_id_array) - 2);
    	?>
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;
        while(i <= <?php echo sizeof($missions_issues); ?>)
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            var doc = {
                userRole: missionIssue(i-1),//"user",//GET ROLE OF USER
                userRoleFormat: "<a href='issues/view/"+ missionIssueId(i-1) +"' class='userId' target='_blank'>{0}</a>",
                name: missionName(i-1),
                nameFormat: "<a href='missions/view/"+ missionId(i-1) +"/1' class='name' target='_blank'>{0}</a>:     " + missionButtons(i-1)
            };
            rows.push(doc);
            i++;
        }

        //Create the returning object. Besides cols and rows, you can also pass any other object you would need later on.
        var data = {
            cols: cols,
            rows: rows,
            otherStuff: {
                thatIMight: 1,
                needLater: true
            }
        };

        return data;
    }

    function getDataUsers() {

        //First define the columns
        var cols = {
            userRole: {
                index: 1, //The order this column should appear in the table
                type: "string", //The type. Possible are string, number, bool, date(in milliseconds).
                <?php 
                	if($flags['_admin']) echo 'friendly: "Role",';
                	else echo 'friendly: "Missions",';
                ?>
                  //Name that will be used in header. Can also be any html as shown here.
                format: "<a href='role.com' class='userId' target='_blank'>{0}</a>",  //Used to format the data anything you want. Use {0} as placeholder for the actual data.
                //unique: true,  //This is required if you want checkable rows, or to use the rowClicked callback. Be certain the values are really unique or weird things will happen.
                sortOrder: "asc", //Data will initially be sorted by this column. Possible are "asc" or "desc"
                tooltip: "<?= __('Check and modify users role')?>", //Show some additional info about column
                placeHolder: "<?= __('Search users by role...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
                //filter: "1..400" //Set initial filter.
            },
            name: {
                index: 2,
                type: "string",
                friendly: "User",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find users')?>", //Show some additional info about column
                placeHolder: "<?= __('Search users by name...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
	    	$users_name_array = "";
	    	$users_id_array = "";
	    	if($flags['_admin']) :
		    	foreach ($all_users as $user) :
		    		$users_name_array .= '"'. $user['User']['name'] .'", ';
		    		$users_id_array .= '"'. $user['User']['id'] .'", ';
		    	endforeach;
		  	else :
		  		foreach ($users_of_my_missions as $user) :
		    		$users_name_array .= '"'. $user['User']['name'] .'", ';
		    		$users_id_array .= '"'. $user['User']['id'] .'", ';
		    	endforeach;
		  	endif;
		   	$users_name_array = substr($users_name_array, 0, strlen($users_name_array) - 2);
		   	$users_id_array = substr($users_id_array, 0, strlen($users_id_array) - 2);
	    ?>

    	<?php 
	    	$users_role_array = "";
	    	$users_roleid_array = "";
	    	if($flags['_admin']) {
		    	foreach ($all_users as $user) 
		    		foreach ($roles as $role) 
		    			if($role['Role']['id'] == $user['User']['role_id']) {
		    				$users_role_array .= '"'. $role['Role']['name'] .'", ';	
		    				$users_roleid_array .= '"'. $role['Role']['id'] .'", ';	
		    			}
		    } else {
		    	foreach ($all_users as $user) 
		    		foreach ($roles as $role) 
		    			if($role['Role']['id'] == $user['User']['role_id']) {
		    				$users_role_array .= '"'. $role['Role']['name'] .'", ';	
		    				$users_roleid_array .= '"'. $role['Role']['id'] .'", ';	
		    			}
		  	}
		   	$users_role_array = substr($users_role_array, 0, strlen($users_role_array) - 2);	
	    	$users_roleid_array = substr($users_roleid_array, 0, strlen($users_roleid_array) - 2);	
    	?>
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;

        <?php 
        	if($flags['_admin']) 
        		echo 'while(i <= '. sizeof($all_users) .')';
        	else
        		echo 'while(i <= '. sizeof($users_of_my_missions) .')';
        ?>
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            //var strU = '"deleteMission' + missionsId[i] + '"';
            var doc = {
                userRole: usersRole[i-1],//"user",//GET ROLE OF USER
                userRoleFormat: "<a href='#' data-reveal-id='user-" + usersId[i-1] + "' class='userId' target='_blank' data-reveal>{0}</a>",
                name: usersName[i-1],
                nameFormat: "<a href='users/view/"+ usersId[i-1] +"' class='name' target='_blank'>{0}</a>"
            };
            rows.push(doc);
            i++;
        }

        //Create the returning object. Besides cols and rows, you can also pass any other object you would need later on.
        var data = {
            cols: cols,
            rows: rows,
            otherStuff: {
                thatIMight: 1,
                needLater: true
            }
        };

        return data;
    }
    

    var usersName = new Array(<?php echo $users_name_array?>);    
    var usersId = new Array(<?php echo $users_id_array?>);
    var usersRole = new Array(<?php echo $users_role_array?>);    
    var usersRoleId = new Array(<?php echo $users_roleid_array?>);

    var issueName = new Array(<?php echo $mission_issues_array ?>);
    var issueId = new Array(<?php echo $mission_issues_id_array ?>);
    var missionsId = new Array(<?php echo $mission_ids_array ?>);
    var missionsTitle = new Array(<?php echo $mission_titles_array ?>);

    function missionId(i) {
        return missionsId[i];
    }

    function missionName(i) {
        return missionsTitle[i];
    }

    function missionIssue(i) {
    	return issueName[i];
    }

    function missionIssueId(i) {
    	return issueId[i];
    }

    function missionButtons(i) {
    	var str = "'deleteMission" + missionsId[i] + "'";
    	return '<a href="panels/edit_mission/'+ missionsId[i] +'" >Edit</a> | <a href="#" onclick="document.getElementById(' + str +').click();" >Delete</a>';
    }

    
</script>