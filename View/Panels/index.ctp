<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<?php if(isset($user['User'])) :?>
				<h1><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><?= strtoupper(__('Evoke')) ?></a></h1>
			<?php else : ?>
				<h1><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>"><?= strtoupper(__('Evoke')) ?></a></h1>
			<?php endif; ?>

		</li>
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
		
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="evoke right">

			<?php if(isset($user['User'])) :?>
				<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/></a></li>
			<?php endif; ?>

			<li class = "name">
				<?php if(isset($user['User'])) :?>
					<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>" class = "evoke top-bar-name"><?= $user['User']['name'] ?></a></h3>
				<?php else :?>
					<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>" class = "evoke top-bar-name"><?= __('Unidentified Agent, please login') ?></a></h3>
				<?php endif; ?>
			</li>

			<li class="evoke divider"></li>

			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>

			<li class="evoke divider"></li>
			
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<?php if(isset($user['User'])) :?>
						<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></h1></li>
						<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
					<?php else :?>
						<li><h1><?php echo $this->Html->link(__('Log in'), array('controller' => 'users', 'action' => 'login')); ?></h1></li>
					<?php endif; ?>
				</ul>
			</li>

		</ul>
		
		<ul class="evoke left">
			<li class="name">
				<h3><a href="#" class="evoke top-bar-name"><?php echo sprintf(__("Evoke's Administration Panel"));?></a></h3>
			</li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="margin top-2">
	<div class="row full-width">
		<div class="small-12 medium-12 large-12 columns">
			<dl class="tabs" data-tab>
				<dd class="<?php echo $organizations_tab; ?>"><a href="#organizations"><?= __('Organizations') ?></a></dd>
				<dd class="<?php echo $missions_tab; ?>"><a href="#missions"><?= __('Missions') ?></a></dd>
				<?php if($flags['_admin']) : ?>
					<dd class="<?php echo $issues_tab; ?>"><a href="#issues"><?= __('Issues') ?></a></dd>
					<dd class="<?php echo $levels_tab; ?>"><a href="#levels"><?= __('Levels') ?></a></dd>
					<dd class="<?php echo $powerpoints_tab; ?>"><a href="#powerpoints"><?= __('Power Points') ?></a></dd>
				<?php endif; ?>	
				<dd class="<?php echo $badges_tab; ?>"><a href="#badges"><?= __('Badges') ?></a></dd>
				<dd class="<?php echo $users_tab; ?>"><a href="#users"><?= __('Users') ?></a></dd>
				<?php if($flags['_admin']) : ?>
					<dd class="<?php echo $media_tab; ?>"><a href="#media"><?= __('Media') ?></a></dd>
					<dd class="<?php echo $settings_tab; ?>"><a href="#settings"><?= __('General Settings') ?></a></dd>
				<?php endif; ?>	
				<dd class="<?php echo $statistics_tab; ?>"><a href="#statistics"><?= __('Statistics') ?></a></dd>
			</dl>
			<div class="tabs-content">
				<div class="content <?php echo $organizations_tab; ?>" id="organizations">
					<div class="large-10 columns">
						<?php foreach ($organizations as $organization) { ?>
								<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'organizations', 'action' => 'delete', $organization['Organization']['id']), array( 'class' => 'button tiny alert', 'id' => 'orgsDelete'.$organization['Organization']['id'], 'style' => 'display:none' )); ?>
						<?php }	?>

						<button class="button" data-reveal-id="myModalOrganization" data-reveal><?php echo __('New Organization');?></button>
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
									echo $this->Form->input('birthdate', array(
										'label' => __('Birthdate'),
										'style' => 'width: auto',
										'separator' => '/',
										'dateFormat' => 'DMY',
    									'minYear' => date('Y') - 100,
    									'maxYear' => date('Y'),
									));

									echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
									echo $this->Form->input('website', array('label' => __('Website')));
									echo $this->Form->input('facebook');
									echo $this->Form->input('twitter');
									echo $this->Form->input('blog');
									if($flags['_admin']) {
										//if its an admin, use $possible_managers..
										/*echo $this->Form->input('UserOrganization.users_id', array(
											'label' => __('Possible Managers'),
											'options' => $possible_managers,
											'multiple' => 'checkbox',
											'required' => true
										));*/
										echo $this->Chosen->select(
										    'UserOrganization.users_id',
										    $possible_managers,
										    array(
										    	'data-placeholder' => __('Select the managers').'...', 
										    	'multiple' => true, 
										    	'style' => 'width: 100%; height: 36px;'
										    )
										);
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
						<div id="OrganizationsHolder"></div>
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

							<?php foreach ($issues as $i) : ?>
					  				<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'delete_issue', $i['Issue']['id']), array( 'class' => 'button tiny alert', 'id' => 'issuesDelete'.$i['Issue']['id'], 'style' => 'display:none')); ?>
							<?php endforeach; ?>
							<div id="IssuesHolder"></div>
					</div>
				</div>
				<div class="content <?php echo $levels_tab; ?>" id="levels">
					<p>Not defined.. levels details go here.</p>
				</div>
				<div class="content <?php echo $powerpoints_tab; ?>" id="powerpoints">
					<div class="large-10 columns">
			  			<button class="button" data-reveal-id="myModalPowerPoint" data-reveal><?php echo __('New Power Point');?></button>
			    		<div id="myModalPowerPoint" class="reveal-modal tiny" data-reveal>
							<?php echo $this->Form->create('PowerPoint', array(
		 				   		'url' => array(
		 				   			'controller' => 'panels',
		 				   			'action' => 'add_powerpoint')
								)); ?>
							<fieldset>
								<legend><?php echo __('Add a Power Point'); ?></legend>
								<?php
									echo $this->Form->input('name', array(
										'label' => __('Name'),
										'required' => true
									));
									echo $this->Form->input('description', array(
										'label' => __('Description'),
										'type' => 'textarea',
										'required' => true
									));
								?>
							</fieldset>
							<button class="button small" type="submit">
								<?php echo __('Add'); ?>
							</button>
							<?php echo $this->Form->end(); ?>

							<a class="close-reveal-modal">&#215;</a>
						</div>			    			

							<?php foreach ($powerpoints as $pp) : ?>
					  				<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'delete_powerpoint', $pp['PowerPoint']['id']), array( 'class' => 'button tiny alert', 'id' => 'powerpointsDelete'.$pp['PowerPoint']['id'], 'style' => 'display:none')); ?>
							<?php endforeach; ?>
							<div id="PowerPointsHolder"></div>
					</div>
				</div>
				<div class="content <?php echo $badges_tab; ?>" id="badges">
					<div class="large-10 columns">
						<button class="button" data-reveal-id="myModalBadge" data-reveal><?php echo __('New Badge');?></button>
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

							        echo '<fieldset><legend> ' .__('Necessary Power Points to get Badge') . '</legend>';
							        foreach ($powerpoints as $power) {
							            echo $this->Form->input('Power.' . $power['PowerPoint']['id'] . '.quantity', array(
							                'label' => $power['PowerPoint']['name'],
							                'value' => 0
							            ));
							        }
							        echo '</fieldset>';
									
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

						<?php foreach ($badges as $badge) : ?>
							<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'badges', 'action' => 'delete', $badge['Badge']['id']), array( 'class' => 'button tiny alert', 'id' => 'deleteBadge'.$badge['Badge']['id'], 'style' => 'display:none')); ?>
						<?php endforeach; ?>
						<div id="BadgesHolder"></div>
					</div>
				</div>
				<div class="content <?php echo $users_tab; ?>" id="users">
					<div class="large-10 columns">
						<?php if($flags['_admin']) :
							foreach ($all_users as $user) : ?>
								<button class="button small" id="ShowUser-<?php echo $user['User']['id']; ?>" data-reveal-id="user-<?php echo $user['User']['id']; ?>" style="display:none" data-reveal></button>
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
				<div class="content <?php echo $settings_tab; ?>" id="settings">
					<?php
						echo $this->Form->create('Config', array(
								'url' => array(
									'controller' => 'panels',
									'action' => 'settings'
								)
						));

						echo '<div class="row collapse">';

						if(isset($groups[0]) && $groups[0]['Group']['max_global'] != 0) {
							echo $this->Form->input('max_global', array(
								//'label' => __('Define the limit of agents per group: '),
								'value' => $groups[0]['Group']['max_global']
							));	
						} else {
							echo $this->Form->input('max_global', array(
								'label' => __('Define the limit of agents per group: ')
							));	
						}						

						echo '</div>';

						echo '<fieldset><legend>' . __('Points Definitions: ') . '</legend>';
						
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

						echo '</fieldset>';

					?>
					<button class="button small" type="submit">
						<?php echo __('Save Settings')?>
					</button>
					<?php echo $this->Form->end(); ?>
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
	echo $this->Html->css('animate');
	echo $this->Html->script('jquery.watable');

?>

<script type="text/javascript" charset="utf-8">
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
                //console.log('table created'); //data.table holds the html table element.
                //console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                //console.log('row clicked');   //data.event holds the original jQuery event.
                //console.log(data);            //data.row holds the underlying row you supplied.
                                              //data.column holds the underlying column you supplied.
                                              //data.checked is true if row is checked.
                                              //'this' keyword holds the clicked element.
                // if ( $(this).hasClass('userId') ) {
                //   data.event.preventDefault();
                //   alert('You clicked userId: ' + data.row.userId);
                // }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              // console.log('column clicked');  //data.event holds the original jQuery event
              // console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              // console.log('page changed');    //data.event holds the original jQuery event
              // console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              // console.log('pagesize changed');//data.event holds teh original event
              // console.log(data);              //data.pageSize holds the new pagesize
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
                // console.log('table created'); //data.table holds the html table element.
                // console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                // console.log('row clicked');   //data.event holds the original jQuery event.
                // console.log(data);            //data.row holds the underlying row you supplied.
                //                               //data.column holds the underlying column you supplied.
                //                               //data.checked is true if row is checked.
                //                               //'this' keyword holds the clicked element.
                // if ( $(this).hasClass('userId') ) {
                //   data.event.preventDefault();
                //   alert('You clicked userId: ' + data.row.userId);
                // }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              // console.log('column clicked');  //data.event holds the original jQuery event
              // console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              // console.log('page changed');    //data.event holds the original jQuery event
              // console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              // console.log('pagesize changed');//data.event holds teh original event
              // console.log(data);              //data.pageSize holds the new pagesize
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


        var waTableBadges = $('#BadgesHolder').WATable({
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
                // console.log('table created'); //data.table holds the html table element.
                // console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                // console.log('row clicked');   //data.event holds the original jQuery event.
                // console.log(data);            //data.row holds the underlying row you supplied.
                //                               //data.column holds the underlying column you supplied.
                //                               //data.checked is true if row is checked.
                //                               //'this' keyword holds the clicked element.
                // if ( $(this).hasClass('userId') ) {
                //   data.event.preventDefault();
                //   alert('You clicked userId: ' + data.row.userId);
                // }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              // console.log('column clicked');  //data.event holds the original jQuery event
              // console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              // console.log('page changed');    //data.event holds the original jQuery event
              // console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              // console.log('pagesize changed');//data.event holds teh original event
              // console.log(data);              //data.pageSize holds the new pagesize
            }
        }).data('WATable');  //This step reaches into the html data property to get the actual WATable object. Important if you want a reference to it as we want here.

        //Generate some data
        var dataB = getDataBadges();
        waTableBadges.setData(dataB);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTableBadges.getData(false); //Gets the data you previously set.
        var checkedRows = waTableBadges.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTableBadges.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTableBadges.option("pageSize"); //Get option



        var waTableOrgs = $('#OrganizationsHolder').WATable({
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
                // console.log('table created'); //data.table holds the html table element.
                // console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                // console.log('row clicked');   //data.event holds the original jQuery event.
                // console.log(data);            //data.row holds the underlying row you supplied.
                //                               //data.column holds the underlying column you supplied.
                //                               //data.checked is true if row is checked.
                //                               //'this' keyword holds the clicked element.
                // if ( $(this).hasClass('userId') ) {
                //   data.event.preventDefault();
                //   alert('You clicked userId: ' + data.row.userId);
                // }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              // console.log('column clicked');  //data.event holds the original jQuery event
              // console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              // console.log('page changed');    //data.event holds the original jQuery event
              // console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              // console.log('pagesize changed');//data.event holds teh original event
              // console.log(data);              //data.pageSize holds the new pagesize
            }
        }).data('WATable');  //This step reaches into the html data property to get the actual WATable object. Important if you want a reference to it as we want here.

        //Generate some data
        var dataO = getDataOrgs();
        waTableOrgs.setData(dataO);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTableOrgs.getData(false); //Gets the data you previously set.
        var checkedRows = waTableOrgs.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTableOrgs.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTableOrgs.option("pageSize"); //Get option




        var waTableIssues = $('#IssuesHolder').WATable({
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
                // console.log('table created'); //data.table holds the html table element.
                // console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                // console.log('row clicked');   //data.event holds the original jQuery event.
                // console.log(data);            //data.row holds the underlying row you supplied.
                //                               //data.column holds the underlying column you supplied.
                //                               //data.checked is true if row is checked.
                //                               //'this' keyword holds the clicked element.
                // if ( $(this).hasClass('userId') ) {
                //   data.event.preventDefault();
                //   alert('You clicked userId: ' + data.row.userId);
                // }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              // console.log('column clicked');  //data.event holds the original jQuery event
              // console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              // console.log('page changed');    //data.event holds the original jQuery event
              // console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              // console.log('pagesize changed');//data.event holds teh original event
              // console.log(data);              //data.pageSize holds the new pagesize
            }
        }).data('WATable');  //This step reaches into the html data property to get the actual WATable object. Important if you want a reference to it as we want here.

        //Generate some data
        var dataI = getDataIssues();
        waTableIssues.setData(dataI);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTableIssues.getData(false); //Gets the data you previously set.
        var checkedRows = waTableIssues.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTableIssues.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTableIssues.option("pageSize"); //Get option



        var waTablePP = $('#PowerPointsHolder').WATable({
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
                // console.log('table created'); //data.table holds the html table element.
                // console.log(data);            //'this' keyword also holds the html table element.
            },
            rowClicked: function(data) {      //Fires when a row is clicked (Note. You need a column with the 'unique' property).
                // console.log('row clicked');   //data.event holds the original jQuery event.
                // console.log(data);            //data.row holds the underlying row you supplied.
                //                               //data.column holds the underlying column you supplied.
                //                               //data.checked is true if row is checked.
                //                               //'this' keyword holds the clicked element.
                // if ( $(this).hasClass('userId') ) {
                //   data.event.preventDefault();
                //   alert('You clicked userId: ' + data.row.userId);
                // }
            },
            columnClicked: function(data) {    //Fires when a column is clicked
              // console.log('column clicked');  //data.event holds the original jQuery event
              // console.log(data);              //data.column holds the underlying column you supplied
                                              //data.descending is true when sorted descending (duh)
            },
            pageChanged: function(data) {      //Fires when manually changing page
              // console.log('page changed');    //data.event holds the original jQuery event
              // console.log(data);              //data.page holds the new page index
            },
            pageSizeChanged: function(data) {  //Fires when manually changing pagesize
              // console.log('pagesize changed');//data.event holds teh original event
              // console.log(data);              //data.pageSize holds the new pagesize
            }
        }).data('WATable');  //This step reaches into the html data property to get the actual WATable object. Important if you want a reference to it as we want here.

        //Generate some data
        var dataPP = getDataPowerPoints();
        waTablePP.setData(dataPP);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTablePP.getData(false); //Gets the data you previously set.
        var checkedRows = waTablePP.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTablePP.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTablePP.option("pageSize"); //Get option
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
            var url = getCorrectURL("missions/view/");
            var url2 = getCorrectURL("issues/view/");
            var doc = {
                userRole: missionIssue(i-1),//"user",//GET ROLE OF USER
                userRoleFormat: "<a href='"+ url2+ missionIssueId(i-1) +"' class='userId' target='_blank'>{0}</a>",
                name: missionName(i-1),
                nameFormat: "<a href='" + url + missionId(i-1) +"/1' class='name' target='_blank'>{0}</a>:     " + missionButtons(i-1)
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
	    	$users_missions_array = "";
	    	$users_missionsid_array = "";
	    	if($flags['_admin']) {
		    	foreach ($all_users as $user) 
		    		foreach ($roles as $role) 
		    			if($role['Role']['id'] == $user['User']['role_id']) {
		    				$users_role_array .= '"'. $role['Role']['name'] .'", ';	
		    				$users_roleid_array .= '"'. $role['Role']['id'] .'", ';	
		    			}

		    	$users_role_array = substr($users_role_array, 0, strlen($users_role_array) - 2);
	    		$users_roleid_array = substr($users_roleid_array, 0, strlen($users_roleid_array) - 2);
		    } else {
		    	//echo '/*'. debug($users_of_my_missions).'*/';
		    	foreach ($users_of_my_missions as $user) {
		    		$titles = "";
		    		$ids = "";
		    		foreach ($missions_issues as $mi) {
		    			if($mi['Mission']['id'] == $user['UserMission']['mission_id']) {
		    				$titles .= $mi['Mission']['title'] . "";
		    				$ids .= $mi['Mission']['id'] . "";
		    			}
		    		}
		    		$users_missions_array .= '"'. $titles .'", ';	
		    		$users_missionsid_array .= '"'. $ids .'", ';	
		    	}

		    	$users_missions_array = substr($users_missions_array, 0, strlen($users_missions_array) - 2);
	    		$users_missionsid_array = substr($users_missionsid_array, 0, strlen($users_missionsid_array) - 2);
		  	}
		   	
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
            var url = getCorrectURL("missions/view/");
            var strU = '"ShowUser-' + usersId[i-1] + '"';
            var strRoleFormat = "<a href='#' onclick='document.getElementById(" + strU +").click();' class='userId'>{0}</a>";
            var strMissionFormat = "<a href='" + url + usersMissionId[i-1] +"/1' class='name' target='_blank'>{0}</a>";//

            var doc = {
                <?php
                	if($flags['_admin']) {
                		echo "userRole: usersRole[i-1], userRoleFormat: strRoleFormat,";
                	} else {
                		echo "userRole: usersMission[i-1], userRoleFormat: strMissionFormat,";//
                	}
                ?>
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

    function getDataBadges() {

        //First define the columns
        var cols = {
            userRole: {
                index: 1, //The order this column should appear in the table
                type: "string", //The type. Possible are string, number, bool, date(in milliseconds).
                friendly: "Organization",  //Name that will be used in header. Can also be any html as shown here.
                format: "<a href='role.com' class='userId' target='_blank'>{0}</a>",  //Used to format the data anything you want. Use {0} as placeholder for the actual data.
                //unique: true,  //This is required if you want checkable rows, or to use the rowClicked callback. Be certain the values are really unique or weird things will happen.
                sortOrder: "asc", //Data will initially be sorted by this column. Possible are "asc" or "desc"
                tooltip: "<?= __('Organization owner of this badge')?>", //Show some additional info about column
                placeHolder: "<?= __('Search badges by organizations...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
                //filter: "1..400" //Set initial filter.
            },
            name: {
                index: 2,
                type: "string",
                friendly: "Badge",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find Badges, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for badges...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
        	$badges_size = 0;
	    	$badges_titles_array = "";
	    	$badges_ids_array = "";
	    	foreach ($badges as $badge) :
	    		if($badge['Badge']['id'] == "") continue;
	    		$badges_size++;
	    		$badges_titles_array .= '"'. $badge['Badge']['name'] .'", ';
	    		$badges_ids_array .= '"'. $badge['Badge']['id'] .'", ';
	    	endforeach;
	    	$badges_titles_array = substr($badges_titles_array, 0, strlen($badges_titles_array) - 2);
    		$badges_ids_array = substr($badges_ids_array, 0, strlen($badges_ids_array) - 2);
	    ?>
    
    	<?php 
	    	$orgs_names_array = "";
	    	$orgs_id_array = "";
	    	foreach ($badges as $b) {
	    	 	if($b['Badge']['id'] == "") continue;
	    	 	foreach ($organizations as $org) 
	    			if($org['Organization']['id'] == $b['Badge']['organization_id']) {
	    				$orgs_names_array .= '"'. $org['Organization']['name'] .'", ';
	    				$orgs_id_array .= '"'. $org['Organization']['id'] .'", ';
	    			}
	    	}
	    	$orgs_names_array = substr($orgs_names_array, 0, strlen($orgs_names_array) - 2);
    		$orgs_id_array = substr($orgs_id_array, 0, strlen($orgs_id_array) - 2);
    	?>
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;
        while(i <= <?php echo $badges_size; ?>)
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            var url = getCorrectURL("organizations/view/");
            var url2 = getCorrectURL("badges/view/");
            var doc = {
                userRole: orgsBadgeName[i-1],//"user",//GET ROLE OF USER
                userRoleFormat: "<a href='" + url + orgsBadgeId[i-1] +"' class='userId' target='_blank'>{0}</a>",
                name: badgesName[i-1],
                nameFormat: "<a href='"+ url2 + badgesId[i-1] +"/1' class='name' target='_blank'>{0}</a>:     " + badgeButtons(i-1)
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
    
    function getDataOrgs() {

        //First define the columns
        var cols = {
            name: {
                index: 1,
                type: "string",
                friendly: "Organization",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find Organizations, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for organizations...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
        	$orgs_size = 0;
	    	$orgs_array = "";
	    	$orgsids_array = "";
	    	foreach ($organizations as $o) :
	    		if($o['Organization']['id'] == "") continue;
	    		$orgs_size++;
	    		$orgs_array .= '"'. $o['Organization']['name'] .'", ';
	    		$orgsids_array .= '"'. $o['Organization']['id'] .'", ';
	    	endforeach;
	    	$orgs_array = substr($orgs_array, 0, strlen($orgs_array) - 2);
    		$orgsids_array = substr($orgsids_array, 0, strlen($orgsids_array) - 2);
	    ?>
    
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;
        while(i <= <?php echo $orgs_size; ?>)
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            var url = getCorrectURL("organizations/view/");
            var doc = {
                name: orgsName[i-1],
                nameFormat: "<a href='"+ url + orgsId[i-1] +"' class='name' target='_blank'>{0}</a>:     " + orgsButtons(i-1)
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

    function getDataIssues() {

        //First define the columns
        var cols = {
            name: {
                index: 1,
                type: "string",
                friendly: "Issue",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find issues, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for issue...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
        	$issues_size = 0;
	    	$issues_array = "";
	    	$issueids_array = "";
	    	foreach ($issues as $issue) :
	    		if($issue['Issue']['id'] == "") continue;
	    		$issues_size++;
	    		$issues_array .= '"'. $issue['Issue']['name'] .'", ';
	    		$issueids_array .= '"'. $issue['Issue']['id'] .'", ';
	    	endforeach;
	    	$issues_array = substr($issues_array, 0, strlen($issues_array) - 2);
    		$issueids_array = substr($issueids_array, 0, strlen($issueids_array) - 2);
	    ?>
    
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;
        while(i <= <?php echo $issues_size; ?>)
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            var url = getCorrectURL("issues/view/");
            var doc = {
                name: issuesName[i-1],
                nameFormat: "<a href='" + url + issuesId[i-1] +"/1' class='name' target='_blank'>{0}</a>:     " + issuesButtons(i-1)
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


    function getDataPowerPoints() {

        //First define the columns
        var cols = {
            name: {
                index: 1,
                type: "string",
                friendly: "Power Point",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find power points in Evoke')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for power point...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
        	$pp_size = 0;
	    	$pp_array = "";
	    	$ppids_array = "";
	    	foreach ($powerpoints as $power) :
	    		if($power['PowerPoint']['id'] == "") continue;
	    		$pp_size++;
	    		$pp_array .= '"'. $power['PowerPoint']['name'] .'", ';
	    		$ppids_array .= '"'. $power['PowerPoint']['id'] .'", ';
	    	endforeach;
	    	$pp_array = substr($pp_array, 0, strlen($pp_array) - 2);
    		$ppids_array = substr($ppids_array, 0, strlen($ppids_array) - 2);
	    ?>
    
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;
        while(i <= <?php echo $pp_size; ?>)
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            var url = getCorrectURL("#");
            var doc = {
                name: ppName[i-1],
                nameFormat: "<a href='#' class='name' target='_blank'>{0}</a>:     " + ppButtons(i-1)
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
    var usersMission = new Array(<?php echo $users_missions_array?>);    
    var usersMissionId = new Array(<?php echo $users_missionsid_array?>);

    var badgesName = new Array(<?php echo $badges_titles_array?>);
    var badgesId = new Array(<?php echo $badges_ids_array?>);
    var orgsBadgeName = new Array(<?php echo $orgs_names_array?>);
    var orgsBadgeId = new Array(<?php echo $orgs_id_array?>);

	var orgsName = new Array(<?php echo $orgs_array?>);
    var orgsId = new Array(<?php echo $orgsids_array?>);

	var issuesName = new Array(<?php echo $issues_array?>);
    var issuesId = new Array(<?php echo $issueids_array?>);    

    var ppName = new Array(<?php echo $pp_array?>);
    var ppId = new Array(<?php echo $ppids_array?>);    

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

    function badgeButtons(i) {
    	var url = getCorrectURL("badges/edit/");
    	var str = "'deleteBadge" + badgesId[i] + "'";
    	return '<a href="'+ url + badgesId[i] +'" >Edit</a> | <a href="#" onclick="document.getElementById(' + str +').click();" >Delete</a>';
    }

	function orgsButtons(i) {
    	var url = getCorrectURL("organizations/edit/");
    	str = "'orgsDelete" + orgsId[i] + "'";
    	return '<a href="'+ url + orgsId[i] +'" >Edit</a> | <a href="#" onclick="document.getElementById(' + str +').click();" >Delete</a>';
    }

	function ppButtons(i) {
    	var url = getCorrectURL("");
    	var str = "'powerpointsDelete" + ppId[i] + "'";
    	return '<a href="#" onclick="document.getElementById(' + str +').click();" >Delete</a>';
    }

    function issuesButtons(i) {
    	var url = getCorrectURL("issues/edit/");
    	var str = "'issuesDelete" + issuesId[i] + "'";
    	return '<a href="'+ url + issuesId[i] +'" >Edit</a> | <a href="#" onclick="document.getElementById(' + str +').click();" >Delete</a>';
    }

    function missionButtons(i) {
    	var url = getCorrectURL("panels/edit_mission/");
    	var str = "'deleteMission" + missionsId[i] + "'";
    	return '<a href="' + url  + missionsId[i] +'" >Edit</a> | <a href="#" onclick="document.getElementById(' + str +').click();" >Delete</a>';
    }

    function getCorrectURL(afterHome){
    	var str = document.URL;
    	
    	str = str.substr(7, str.length);
    	str = str.substr(str.indexOf("/"), str.length);
    	if(str.length>1) {
    		str = str.substr(0, str.indexOf('/', 1));
    		//alert(str);	
    		str = str + '/' + afterHome;
    		return str;
    	} else {
    		//alert(str);	
    		return afterHome;
    	}
    	//alert(str);
    }


    
</script>