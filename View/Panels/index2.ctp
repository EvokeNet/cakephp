<?php
	echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new',
			'circle'
		)
	);
?>

<!-- TOPBAR MENU -->
<div id="missions-menu" class="sticky fixed">
	<?php echo $this->element('topbar', array('sticky' => '', 'fixed' => '')); ?>
</div>

<?php 
	$this->end(); 
	echo $this->Html->css('lightbox_ribbon');
?>

<section>
	<div class="row full-width margin top-5">

	  <div class="small-1 columns no-padding">
	  	<div class = "evoke menu-bg sidebar menucolumn" style = "height: 1500px; background-color:#1f232a">
	  	<dl class="panels tabs vertical" data-tab>
				<dd class="<?php echo $organizations_tab; ?>" style = "text-align:center"><a href="#organizations"><i class="fa fa-bank fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Organizations')) ?></a></dd>

				<dd class="<?php echo $missions_tab; ?>" style = "text-align:center"><a href="#missions"><i class="fa fa-folder-open-o fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Missions')) ?></a></dd>
				
				<?php if($flags['_admin']) : ?>
					<dd class="<?php echo $issues_tab; ?>" style = "text-align:center"><a href="#issues"><i class="fa fa-list-ul fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Issues')) ?></a></dd>

					<dd class="<?php echo $levels_tab; ?>" style = "text-align:center"><a href="#levels"><i class="fa fa-trophy fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Levels')) ?></a></dd>
				<?php endif; ?>	
				
				<dd class="<?php echo $badges_tab; ?>" style = "text-align:center"><a href="#badges"><i class="fa fa-shield fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Badges')) ?></a></dd>
				
				<dd class="<?php echo $users_tab; ?>" style = "text-align:center"><a href="#users"><i class="fa fa-users fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Users')) ?></a></dd>
				
				<?php if($flags['_admin']) : ?>
					<dd class="<?php echo $pending_tab; ?>" style = "text-align:center"><a href="#pending"><i class="fa fa-inbox fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Evokations')) ?></a></dd>
					
					<dd class="<?php echo $media_tab; ?>" style = "text-align:center"><a href="#media"><i class="fa fa-exclamation-circle fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Notifications & Media')) ?></a></dd>
					
					<dd class="<?php echo $settings_tab; ?>" style = "text-align:center"><a href="#settings"><i class="fa fa-cogs fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('General Settings')) ?></a></dd>
				<?php endif; ?>	
				
				<dd id="test" class="<?php echo $statistics_tab; ?>" style = "text-align:center"><a href="#statistics"><i class="fa fa-bar-chart-o fa-lg" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Statistics')) ?></a></dd>
			</dl>
			</div>
	  </div>

	  <div class="small-11 columns no-padding">
	  	
	  	<div class="panels tabs-content vertical padding top-2">
				<div class="content <?php echo $organizations_tab; ?>" id="organizations">
					
					<?php foreach ($organizations as $organization) { ?>
							<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'organizations', 'action' => 'delete', $organization['Organization']['id']), array( 'class' => 'button tiny alert', 'id' => 'orgsDelete'.$organization['Organization']['id'], 'style' => 'display:none' )); ?>
					<?php }	?>

					<a href ="#" class="button general" data-reveal-id="myModalOrganization" data-reveal><?php echo __('New Organization');?></a>

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
									'label' => __('Date of Establishment'),
									'style' => 'width: auto',
									'separator' => ' ',
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
									echo $this->Chosen->select(
									    'UserOrganization.users_id',
									    $possible_managers,
									    array(
									    	'data-placeholder' => __('Select the managers'), 
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
				<div class="content <?php echo $missions_tab; ?> large-12 columns" id="missions">

			  		<a href ="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'add_mission')) ?>" class="button general"><?php echo __('New Mission');?></a>

				  		<!-- creating delete post buttons to be referenced at js -->
				  		<?php foreach ($missions_issues as $mi) : ?>
				  				<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'missions', 'action' => 'delete', $mi['Mission']['id']), array( 'class' => 'button tiny alert', 'id' => 'deleteMission'.$mi['Mission']['id'], 'style' => 'display:none')); ?>
						<?php endforeach; ?>
					
					<div id="MissionsHolder" style="width:auto"></div> 
				</div>
				<div class="content <?php echo $issues_tab; ?>" id="issues">

		  			<a href = "#" class="button general" data-reveal-id="myModalIssue" data-reveal><?php echo __('New Issue');?></a>

		    		<div id="myModalIssue" class="reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('Issue', array(
	 				   		'url' => array(
	 				   			'controller' => 'panels',
	 				   			'action' => 'add_issue')
							)); ?>
						
						<?php echo __('Add an Issue'); ?>
						<?php
							echo $this->Form->input('name', array('label' => __('Name')));
							echo $this->Form->input('slug', array('label' => __('Slug')));
						?>
						
						<button class="button general" type="submit">
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
				<div class="content <?php echo $levels_tab; ?> default-content" id="levels">
					<h3 class = "margin bottom"><?= strtoupper(__('Define Levels')) ?></h3>
					<?php 
						$nextLevel = 1;
						echo $this->Form->create('Level', array(
							'url' => array(
								'controller' => 'panels',
								'action' => 'level'
							)
						));
						foreach ($levels as $level):
							echo '<div class="row collapse">';
							echo '<div class="large-1 columns left inline"><label for="levelOld'.$level['Level']['id'].'">Level '.$level['Level']['level'].'</label></div>';
							
							echo $this->Form->input('level.old.'.$level['Level']['id'], array(
								'label' => false,
								'value' => $level['Level']['points'],
								'div' => array(
        							'class' => 'large-1 columns left',
    							),
								'required' => true
							));
							echo '<div class="large-1 columns left"><span class="postfix">points</span></div>';
							echo '</div>';
							
							$nextLevel++;
						endforeach;

						echo '<div class="row collapse">';
						echo '<div class="large-1 columns left inline"><label for="levelNew'.$nextLevel.'">Level '.$nextLevel.'</label></div>';
							
						echo $this->Form->input('level.new.'.$nextLevel, array(
							'label' => false,
							'div' => array(
        						'class' => 'large-1 columns left',
    						),
							'required' => true
						));
						echo '<div class="large-1 columns left"><span class="postfix">points</span></div>';
						echo '</div>';
						
						$nextLevel++;
					?>
					<button class="button general" type="submit">
						<?php echo __('Save levels'); ?>
					</button>
					<?php echo $this->Form->end(); ?>
				</div>

				<div class="content <?php echo $badges_tab; ?>" id="badges">
					<a href ="#" class="button general" data-reveal-id="myModalBadge" data-reveal><?php echo __('New Badge');?></a>

					<div id="myModalBadge" class="reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('Badge', array(
 						   		'url' => array(
 						   			'controller' => 'panels',
 						   			'action' => 'add_badge'
 						   		),
 						   		'enctype' => 'multipart/form-data'
							)); 
						?>
							<fieldset>
								<legend><?php echo __('Add a Badge'); ?></legend>
							<?php
								echo $this->Form->input('name', array('label' => __('Name'), 'required' => true));
								echo $this->Form->input('name_es', array('label' => __('Spanish Name')));
								echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
								echo $this->Form->input('description_es', array('label' => __('Spanish Description')));
								echo '<div class="input file"><label for="Attachment0Attachment">Image</label><input type="file" name="data[Attachment][0][attachment]" id="Attachment0Attachment"></div>';
								
								echo $this->Form->input('organization_id', array(
									'label' => __('Organization'),
									'options' => $organizations_list
								));
							?>
							</fieldset>
						<button class="button general" type="submit">
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
				<div class="content <?php echo $users_tab; ?>" id="users">
					<?php if($flags['_admin']) :
						foreach ($all_users as $user) : ?>
							<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array( 'class' => 'button tiny alert', 'id' => 'deleteUser'.$user['User']['id'], 'style' => 'display:none')); ?>

							<button class="button small" id="EditUser-<?= $user['User']['id'] ?>" data-reveal-id="myModalEditUser-<?= $user['User']['id'] ?>" style="display:none" data-reveal></button>

							<div id="myModalEditUser-<?= $user['User']['id'] ?>" class="reveal-modal medium" data-reveal>

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
				<div class="content <?php echo $pending_tab; ?>" id="pending">
					<?php 
						$evokations = array_merge($pending_evokations, $approved_evokations);
					?>

					<?php foreach ($evokations as $e): ?>
						<button class="button small" id="ShowEvokationStatus-<?php echo $e['Evokation']['id']; ?>" data-reveal-id="evo-<?php echo $e['Evokation']['id']; ?>" style="display:none" data-reveal></button>
									<!-- Lightbox for editing evokation status -->
						<div id="evo-<?php echo $e['Evokation']['id']; ?>" class="reveal-modal tiny" data-reveal>
							<?php 
								echo $this->Form->create('Evokation', array(
							 		'url' => array(
							 			'controller' => 'panels',
							 			'action' => 'changeEvokationStatus', 
							 			$e['Evokation']['id']
							 		)
								));
							 ?>
							<fieldset>
								<legend><?php echo __('Change status') .': '. $e['Evokation']['title']; ?></legend>
								<?php
									echo $this->Form->hidden('id', array('value' => $e['Evokation']['id']));

									echo $this->Form->radio('approved', array(0 => 'Unapproved', 1 => 'Approved'), array('default' => $e['Evokation']['approved']));
								?>
							</fieldset>
								<button class="button tiny" type="submit">
									<?php echo __('Save Changes')?>
								</button>
								<?php echo $this->Form->end(); ?>
								<a class="close-reveal-modal">&#215;</a>
						</div>
					<?php endforeach ?>
					<!-- ShowEvokationStatus- -->
					<div id="EvokationsHolder"></div>
				</div>
				<div class="content <?php echo $media_tab; ?>" id="media">

					<a href ="#" class="button general" data-reveal-id="myModalNotification" data-reveal><?php echo __('New Notification');?></a>

					<div id="myModalNotification" class="reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('AdminNotification', array(
	 						'url' => array(
	 							'controller' => 'panels',
	 							'action' => 'addNotification')
						)); ?>
						<fieldset>
							<legend><?php echo __('Create a Notification'); ?></legend>
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
									'value' => $userid
								));

							?>
							</fieldset>
						<button class="button general" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
					<?php foreach ($notifications as $n) : ?>

						<!-- show him/her how the notification will be seen -->
						<button class="button small" id="ShowNot-<?php echo $n['AdminNotification']['id']; ?>" data-reveal-id="not-<?php echo $n['AdminNotification']['id']; ?>" style="display:none" data-reveal></button>
									<!-- Lightbox for editing evokation status -->

						<div id="<?= 'not-'.$n['AdminNotification']['id']?>" class="reveal-modal medium evoke lightbox phase text-align" data-reveal data-options="closeOnBackgroundClick:false">

						  <h3><?= strtoupper(__('Notification')) ?></h3>
						 	<div class = "evoke lightbox-margin">
						  	<div class="green-ribbon-wrapper">
								<div class="green-ribbon-front">
									<h2 style = "color:#fff"><?= $n['AdminNotification']['title'] ?></h2>
								</div>
								<div class="green-ribbon-edge-topleft"></div>
								<div class="green-ribbon-edge-topright"></div>
								<div class="green-ribbon-edge-bottomleft"></div>
								<div class="green-ribbon-edge-bottomright"></div>
								<div class="green-ribbon-back-left"></div>
								<div class="green-ribbon-back-right"></div>
							</div>
							</div>
						  	<p class="lead"><?= $n['AdminNotification']['description'] ?></p>
							<a class="close-reveal-modal">&#215;</a>
						  
						</div>

						<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'deleteNotification', $n['AdminNotification']['id']), array( 'class' => 'button tiny alert', 'id' => 'deleteNotification'.$n['AdminNotification']['id'], 'style' => 'display:none')); ?>

						<button class="button small" id="EditNot-<?php echo $n['AdminNotification']['id']; ?>" data-reveal-id="myModalEditNotification-<?php echo $n['AdminNotification']['id']; ?>" style="display:none" data-reveal></button>

						<div id="myModalEditNotification-<?= $n['AdminNotification']['id']?>" class="reveal-modal medium" data-reveal>

							<h3><?= __('Edit Notification') ?></h3>
							<?php echo $this->Form->create('AdminNotification', array(
	 						'url' => array(
	 							'controller' => 'panels',
	 							'action' => 'editNotification',
	 							$n['AdminNotification']['id'])
							)); ?>
								
							<?php
								echo $this->Form->input('title', array(
									'label' => __('Title'),
									'value' =>  $n['AdminNotification']['title'],
									'required' => true
								));
								echo $this->Form->input('description', array(
									'label' => __('Description'), 
									'required' => true,
									'value' => $n['AdminNotification']['description'],
									'type' => 'textarea'
								));
								echo $this->Form->hidden('user_id', array(
									'value' => $userid
								));

							?>
							<button class="button general" type="submit">
								<?php echo __('Edit') ?>
							</button>
							<?php echo $this->Form->end(); ?>

						  <a class="close-reveal-modal">&#215;</a>
						  
						</div>

					<?php endforeach; ?>
					<div id="NotificationsHolder"></div>
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
					<button class="button general" type="submit">
						<?php echo __('Save Settings')?>
					</button>
					<?php echo $this->Form->end(); ?>
				</div>
				<div class="content <?php echo $statistics_tab; ?> statistics" id="statistics">
					<div class="large-12 medium-12 small-12 columns">
						<dl class="tabs" data-tab>
							<dd class="active"><a href="#otherMetrics"><?= __('General') ?></a></dd>
							<dd><a href="#organizationMetrics"><?= __('Organizations') ?></a></dd>
							<dd><a href="#missionMetrics"><?= __('Missions') ?></a></dd>
						</dl>
						<div class="tabs-content">
							<div class="content active" id="otherMetrics">
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
								?>
								<div class="large-12 medium-12 small-12 columns">
									<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-2">
										<li>
											<div class = "yay">
											  	<div class="row full-width-alternate no-margin">
													<div class="small-6 large-centered columns text-align-center">
												  		<h1 style = "font-size: 1.5em; color: #555">
												  			<i class="fa fa-folder-open-o fa-2x"></i>&nbsp;
												  			<?= sizeof($missions_issues). ' ' . __('Mission(s)')?>
												  		</h1>
												  	</div>
												</div>
									  		</div>
									  	</li>
									  	<li>
									  		<div class = "yay">
											  	<div class="row full-width-alternate no-margin">
												  	<div class="small-6 large-centered columns text-align-center">
												  		<h1 style = "font-size: 1.5em; color: #555">
												  			<i class="fa fa-bank fa-2x"></i>&nbsp;
												  			<?=sizeof($organizations). ' ' .__('Organization(s)')?>
												  		</h1>
												  	</div>
												</div>
									  		</div>
										</li>
										<li>
									  		<div class = "yay">
											  	<div class="row full-width-alternate no-margin">
												  	<div class="small-6 large-centered columns text-align-center">
												  		<h1 style = "font-size: 1.5em; color: #555">
												  			<i class="fa fa-shield fa-2x"></i>&nbsp;
												  			<?=sizeof($badges).' '.__('Badge(s)')?>
												  		</h1>
												  	</div>
												</div>
									  		</div>
										</li>
									</ul>

									<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
									  	<li>
											<div class = "yay">
											  	<div class="row full-width-alternate no-margin">
													<div class="text-center">
														<i class="fa fa-users fa-2x"></i>
													
													<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
														<?= __('Users')?>
													</h1>
													<h1 style = "color: #555"><?=sizeof($all_users)?></h1>
													</div>
												</div>
									  		</div>
										</li>
									  	<li>
									  		<div class = "yay">
											  	<div class="row full-width-alternate no-margin text-center">
													<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
												  		<i class="fa fa-trophy"></i>&nbsp;
												  		<?= __('Level') ?>
												  	</h1>
												  	<div class="large-6 medium-6 small-6 columns">
												  		<h1 style = "font-size: 1.5em; color: #555"><?= __('Average') ?></h1>
													  	<h5 style = "font-size: 1.4em; color: #555"><?= $average_level ?></h5>
												  	</div>
												  	<div class="large-6 medium-6 small-6 columns">
													  	<h1 style = "font-size: 1.5em; color: #555"><?= __('Highest') ?></h1>
													  	<h5 style = "font-size: 1.4em; color: #555"><!--<i class="fa fa-long-arrow-up"></i>&nbsp;--><?= $userLevels['max'].' ' ?></h5>
												  	</div>
												</div>
											</div>
										</li>
										<li>
									  		<div class = "yay">
												<div class="row full-width-alternate no-margin text-center">
													<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
													  	<i class="fa fa-bolt"></i>&nbsp;
													  	<?= __('Points') ?>
													</h1>
													<div class="large-6 medium-6 small-6 columns">
														<h1 style = "font-size: 1.5em; color: #555"><?= __('Average') ?></h1>
													  	<h5 style = "font-size: 1.4em; color: #555"><?= $average_points ?></h5>
													</div>
												  	<div class="large-6 medium-6 small-6 columns">
												  		<h1 style = "font-size: 1.5em; color: #555"><?= __('Highest') ?></h1>
													  	<h5 style = "font-size: 1.4em; color: #555"><!-- <i class="fa fa-star"></i> &nbsp;--><?= $userLevels['maxP'].' ' ?></h5>
												  	</div>
												</div>
											</div>	
										</li>
										<li>
											<div class = "yay">
												<div class="row full-width-alternate no-margin text-center">
													<i class="fa fa-child fa-2x"></i>
													<i class="fa fa-child fa-2x"></i>
													<i class="fa fa-child fa-2x"></i>
													<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
												  		<?= __('Allies per user') ?>
												  	</h1>
												  	<h1 style = "font-size: 1.5em; color: #555">
												  		<?= round($allies_user) ?>
												  	</h1>
												  	<!-- <h5 style = "color: #555"><?= $allies_user ?></h5> -->
												</div>
											</div>
										</li>
										<li>
											<div class = "yay">
												<div class="row full-width-alternate no-margin text-center">
													<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
													  	<i class="fa fa-file-text-o"></i>&nbsp;
													  	<?= __('Evokation(s)') ?>
													</h1>
													<div class="large-4 medium-4 small-4 columns">
														<h1 style = "font-size: 1.5em; color: #555"><?= __('Created') ?></h1>
													  	<h5 style = "font-size: 1.4em; color: #555"><i class="fa fa-edit"></i>&nbsp;<?= sizeof($groups).' ' ?></h5>
													</div>
												  	<div class="large-4 medium-4 small-4 columns">
												  		<h1 style = "font-size: 1.5em; color: #555"><?= __('Pending') ?></h1>
													  	<h5 style = "font-size: 1.4em; color: #555"><i class="fa fa-spinner"></i>&nbsp;<?= sizeof($pending_evokations).' ' ?></h5>
												  	</div>
												  	<div class="large-4 medium-4 small-4 columns">
												  		<h1 style = "font-size: 1.5em; color: #555"><?= __('Approved') ?></h1>
													  	<h5 style = "font-size: 1.4em; color: #555"><i class="fa fa-check"></i>&nbsp;<?= sizeof($approved_evokations).' ' ?></h5>
												  	</div>
												</div>
											</div>
										</li>
										<li>
											<div class = "yay">
												<div class="row full-width-alternate no-margin text-center">
													<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
														<i class="fa fa-list-ul"></i>&nbsp;
												  		<?= __('Chosen Issues') ?>
												  	</h1>
													<div id="piechart"></div>
												</div>
											</div>
										</li>
									</ul>
									<ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-1">
										<li>
											<div class = "yay">
											  	<div class="row full-width-alternate no-margin">
													<div class="small-12 large-centered columns text-align-center">
														<i class="fa fa-globe fa-3x"></i>
												  		<h1 style = "font-size: 1.5em; color: #555; font-weight:bold;">
												  			<?= __('Users around the world')?>
												  		</h1>
												  	</div>
												  	<div id="mapchart"></div>
													<h5 style = "color: #555">
														<?= __('Users from unknown countries') . ': '.$unknown_countries ?>
													</h5>
												</div>
									  		</div>
									  	</li>
									</ul>
								</div>
							</div>
							<div class="content" id="organizationMetrics">
								<div class="large-12 medium-12 small-12 columns">
									<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-2">
										<?php foreach ($organizations as $org) : ?>
											<li>
												<fieldset>
													<h3><?=$org['Organization']['name']?></h3>
												</fieldset>
											</li>
										<?php endforeach ?>
									</ul>
								</div>									
							</div>
							<div class="content" id="missionMetrics">
								<div class="large-12 medium-12 small-12 columns">
									<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-2">
										<?php foreach ($missions_issues as $mission) : ?>
											<li>
												<fieldset>
													<h3><?=$mission['Mission']['title']?></h3>
												</fieldset>
											</li>
										<?php endforeach ?>
									</ul>
								</div>									
							</div>
						</div>
					</div>
				</div>
			</div>

	  </div>
	</div>
</section>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js" type="text/javascript"></script> -->


    
<?php 
	echo $this->Html->css('animate');
	echo $this->Html->script('jquery.watable');

?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

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
        ]);

        var options = {
        	projection: {
			      name: 'kavrayskiy-vii',
			},
	        backgroundColor: { fill:'transparent' },
	        width: '100%',

        };

        var chart = new google.visualization.GeoChart(document.getElementById('mapchart'));
        chart.draw(data, options);
    };
</script>

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


        var allRows = waTablePP.getData(false); //Gets the data you previously set.
        var checkedRows = waTablePP.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTablePP.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTablePP.option("pageSize"); //Get option



        var waTableE = $('#EvokationsHolder').WATable({
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
        var dataE = getDataEvokations();
        waTableE.setData(dataE);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTableE.getData(false); //Gets the data you previously set.
        var checkedRows = waTableE.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTableE.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTableE.option("pageSize"); //Get option





        var waTableNot = $('#NotificationsHolder').WATable({
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
        var dataNot = getDataNotifications();
        waTableNot.setData(dataNot);  //Sets the data.
        //waTable.setData(data, true); //Sets the data but prevents any previously set columns from being overwritten
        //waTable.setData(data, false, false); //Sets the data and prevents any previously checked rows from being reset

        var allRows = waTableNot.getData(false); //Gets the data you previously set.
        var checkedRows = waTableNot.getData(true); //Gets the data you previously set, but with checked rows only.
        var filteredRows = waTableNot.getData(false, true); //Gets the data you previously set, but with filtered rows only.

        var pageSize = waTableNot.option("pageSize"); //Get option
    });



    //Generates some data. This step is of course normally done by your web server.
    function getDataMissions() {

        //First define the columns
        var cols = {
            userRole: {
                index: 1, //The order this column should appear in the table
                type: "string", //The type. Possible are string, number, bool, date(in milliseconds).
                friendly: "<?= strtoupper(__('Issue')) ?>",  //Name that will be used in header. Can also be any html as shown here.
                format: "<a href='role.com' class='userId name' target='_blank'>{0}</a>",  //Used to format the data anything you want. Use {0} as placeholder for the actual data.
                //unique: true,  //This is required if you want checkable rows, or to use the rowClicked callback. Be certain the values are really unique or weird things will happen.
                sortOrder: "asc", //Data will initially be sorted by this column. Possible are "asc" or "desc"
                tooltip: "<?= __('Each mission is related to an issue')?>", //Show some additional info about column
                placeHolder: "<?= __('Search Missions by Issue')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
                //filter: "1..400" //Set initial filter.
            },
            name: {
                index: 2,
                type: "string",
                friendly: "<?= strtoupper(__('Title')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find missions, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search Missions by Title')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
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
                userRoleFormat: "<a href='"+ url2+ missionIssueId(i-1) +"' class='userId name' target='_blank'>{0}</a>",
                name: missionName(i-1),
                nameFormat: "<a href='" + url + missionId(i-1) +"/1' class='name' target='_blank'>{0}</a>" + missionButtons(i-1)
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
                	if($flags['_admin']) $f = strtoupper(__('Role'));
                	else $f = strtoupper(__('Missions'));
                ?>
                friendly: '<?= $f ?>',
                  //Name that will be used in header. Can also be any html as shown here.
                format: "<a href='role.com' class='userId name' target='_blank'>{0}</a>",  //Used to format the data anything you want. Use {0} as placeholder for the actual data.
                //unique: true,  //This is required if you want checkable rows, or to use the rowClicked callback. Be certain the values are really unique or weird things will happen.
                sortOrder: "asc", //Data will initially be sorted by this column. Possible are "asc" or "desc"
                tooltip: "<?= __('Check and modify users role')?>", //Show some additional info about column
                placeHolder: "<?= __('Search Users by Role')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
                //filter: "1..400" //Set initial filter.
            },
            name: {
                index: 2,
                type: "string",
                friendly: "<?= strtoupper(__('User')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find users')?>", //Show some additional info about column
                placeHolder: "<?= __('Search Users by Name')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
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
            var strEU = '"EditUser-' + usersId[i-1] + '"';
            var strRoleFormat = "<a href='#' onclick='document.getElementById(" + strU +").click();' class='userId name'>{0}</a>";
            var strMissionFormat = "<a href='" + url + usersMissionId[i-1] +"/1' class='name' target='_blank'>{0}</a>";//
            var urlU = getCorrectURL("users/dashboard/");

            var doc = {
                <?php
                	if($flags['_admin']) {
                		echo "userRole: usersRole[i-1], userRoleFormat: strRoleFormat,";
                	} else {
                		echo "userRole: usersMission[i-1], userRoleFormat: strMissionFormat,";//
                	}
                ?>
                name: usersName[i-1],
                nameFormat: "<a href='" + urlU + usersId[i-1] +"' class='name' target='_blank'>{0}</a><a href='#' onclick='document.getElementById(" + strEU +").click();'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;" + userButtons(i-1)
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
                friendly: "<?= strtoupper(__('Organization')) ?>",  //Name that will be used in header. Can also be any html as shown here.
                format: "<a href='role.com' class='userId name' target='_blank'>{0}</a>",  //Used to format the data anything you want. Use {0} as placeholder for the actual data.
                //unique: true,  //This is required if you want checkable rows, or to use the rowClicked callback. Be certain the values are really unique or weird things will happen.
                sortOrder: "asc", //Data will initially be sorted by this column. Possible are "asc" or "desc"
                tooltip: "<?= __('Organization owner of this badge')?>", //Show some additional info about column
                placeHolder: "<?= __('Search Badges by Organizations')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
                //filter: "1..400" //Set initial filter.
            },
            name: {
                index: 2,
                type: "string",
                friendly: "<?= strtoupper(__('Badge')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find Badges, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for Badges')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
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
                userRoleFormat: "<a href='" + url + orgsBadgeId[i-1] +"' class='userId name' target='_blank'>{0}</a>",
                name: badgesName[i-1],
                nameFormat: "<a href='"+ url2 + badgesId[i-1] +"/1' class='name' target='_blank'>{0}</a>" + badgeButtons(i-1)
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
                friendly: "<?= strtoupper(__('Organizations')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find Organizations, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for Organizations')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            },
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
                nameFormat: "<a href='"+ url + orgsId[i-1] +"' class='name' target='_blank'>{0}</a>" + orgsButtons(i-1)
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
                friendly: "<?= strtoupper(__('Issues')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('Find issues, edit or even delete them')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for Issue')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
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
                nameFormat: "<a href='" + url + issuesId[i-1] +"/1' class='name' target='_blank'>{0}</a>" + issuesButtons(i-1)
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

    function getDataEvokations() {

        //First define the columns
        var cols = {
            // mission: {
            // 	index: 1,
            //     type: "string",
            //     friendly: "Mission",
            //     format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
            //     tooltip: "<?= __('By mission')?>", //Show some additional info about column
            //     placeHolder: "<?= __('Search evokations by mission...')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            // },
            status: {
            	index: 1,
                type: "string",
                friendly: "<?= strtoupper(__('Status')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('By status')?>", //Show some additional info about column
                placeHolder: "<?= __('Search Evokations by Status')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            },
            group: {
            	index: 2,
                type: "string",
                friendly: "<?= strtoupper(__('Group Title')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('By group')?>", //Show some additional info about column
                placeHolder: "<?= __('Search Evokations by Group')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            },
            name: {
                index: 3,
                type: "string",
                friendly: "<?= strtoupper(__('Evokation Title')) ?>",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('By title')?>", //Show some additional info about column
                placeHolder: "<?= __('Search for Evokations by Title')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
        	$evo_size = 0;
	    	$evo_array = "";
	    	$status_array = "";
	    	$evoids_array = "";
	    	$evo_groups_array = "";
	    	$evo_groupids_array = "";
	    	foreach ($pending_evokations as $e) :
	    		$evo_size++;
	    		$evo_array .= '"'. $e['Evokation']['title'] .'", ';
	    		$evoids_array .= '"'. $e['Evokation']['id'] .'", ';
	    		$status_array .= '"'. $e['Evokation']['approved'] .'", ';
	    		$evo_groups_array .= '"'. $e['Group']['title'] .'", ';
	    		$evo_groupids_array .= '"'. $e['Group']['id'] .'", ';
	    	endforeach;
	    	foreach ($approved_evokations as $e) :
	    		$evo_size++;
	    		$evo_array .= '"'. $e['Evokation']['title'] .'", ';
	    		$evoids_array .= '"'. $e['Evokation']['id'] .'", ';
	    		$status_array .= '"'. $e['Evokation']['approved'] .'", ';
	    		$evo_groups_array .= '"'. $e['Group']['title'] .'", ';
	    		$evo_groupids_array .= '"'. $e['Group']['id'] .'", ';
	    	endforeach;

	    	$evo_array = substr($evo_array, 0, strlen($evo_array) - 2);
    		$evoids_array = substr($evoids_array, 0, strlen($evoids_array) - 2);
    		$status_array = substr($status_array, 0, strlen($status_array) - 2);
    		$evo_groups_array = substr($evo_groups_array, 0, strlen($evo_groups_array) - 2);
    		$evo_groupids_array = substr($evo_groupids_array, 0, strlen($evo_groupids_array) - 2);
	    ?>
    
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;
        while(i <= <?php echo $evo_size; ?>)
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            var urlG = getCorrectURL("groups/view/");
            var urlE = getCorrectURL("evokations/view/");
            var classStatus = '';

            if(eStatus[i-1] == 1) {
            	var str = "Approved";
            }else{            	
            	var str = "Pending";
            }

            var strE = '"ShowEvokationStatus-' + eId[i-1] + '"';
            
            var doc = {
            	
            	status: str,
            	statusFormat: "<a href='#' onclick='document.getElementById(" + strE +").click();' class='userId name Status " + str +"'>{0}</a>",
            	group: gName[i-1],
                groupFormat: "<a href='"+ urlG + gId[i-1] + "' class='name' target='_blank'>{0}</a>",
                name: eName[i-1],
                nameFormat: "<a href='"+ urlE + eId[i-1] + "' class='name' target='_blank'>{0}</a>"
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


    function getDataNotifications() {

        //First define the columns
        var cols = {
            admin: {
            	index: 1,
                type: "string",
                friendly: "Created by",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('By creator')?>", //Show some additional info about column
                placeHolder: "<?= __('Search by Creator')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            },
            trigger: {
            	index: 2,
                type: "string",
                friendly: "Trigger Event",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('By event')?>", //Show some additional info about column
                placeHolder: "<?= __('Search by Event')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            },
            name: {
                index: 3,
                type: "string",
                friendly: "Notification Title",
                format: "<a href='{0}' class='name' target='_blank'>{0}</a>",
                tooltip: "<?= __('By title')?>", //Show some additional info about column
                placeHolder: "<?= __('Search by Title')?>" //Overrides default placeholder and placeholder specified in data types(row 34).
            }
        };


        <?php 
        	$not_size = 0;
	    	$not_array = "";
	    	$notids_array = "";
	    	$notuser_array = "";
	    	foreach ($notifications as $n) :
	    		$not_size++;
	    		$not_array .= '"'. $n['AdminNotification']['title'] .'", ';
	    		$notids_array .= '"'. $n['AdminNotification']['id'] .'", ';
	    		$notuser_array .= '"'. $n['User']['name'] .'", ';
	    	endforeach;

	    	$not_array = substr($not_array, 0, strlen($not_array) - 2);
    		$notids_array = substr($notids_array, 0, strlen($notids_array) - 2);
    		$notuser_array = substr($notuser_array, 0, strlen($notuser_array) - 2);
    		
	    ?>
    
        /*
          Create the actual data.
          Whats worth mentioning is that you can use a 'format' property just as in the column definition,
          but on a row level. See below on how we create a weightFormat property. This will be used when rendering the weight column.
          Also, you can pre-check rows with the 'checked' property and prevent rows from being checkable with the 'checkable' property.
        */
        var rows = [];
        var i = 1;
        while(i <= <?php echo $not_size; ?>)
        {
            //We leave some fields intentionally undefined, so you can see how sorting/filtering works with these.
            //var urlG = getCorrectURL("groups/view/");
            //var urlE = getCorrectURL("evokations/view/");

            //var strE = '"ShowEvokationStatus-' + eId[i-1] + '"';
            strN = '"ShowNot-'+notId[i-1] + '"';
            var strEN = '"EditNot-'+notId[i-1] + '"';

            var doc = {
            	
            	admin: notUser[i-1],//user name
            	adminFormat: "<a href='#' class='userId name'>{0}</a>",
            	trigger: "user log in",
                triggerFormat: "<a href='#' class='name' target='_blank'>{0}</a>",
                name: notTitle[i-1],//notification title
                nameFormat: "<a href='#' onclick='document.getElementById(" + strN +").click();' class='name' >{0}</a><a href='#' onclick='document.getElementById(" + strEN +").click();'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;" + notButtons(i-1)
            };
            rows.push(doc);
            i++;

            // strEN = '"EditNot-'+notId[i-1] + '"';

            // var doc = {
            	
            // 	admin: notUser[i-1],//user name
            // 	adminFormat: "<a href='#' class='userId name'>{0}</a>",
            //     name: notTitle[i-1],//notification title
            //     nameFormat: "<a href='#' onclick='document.getElementById(" + strEN +").click();' class='name' >de</a>" + notButtons(i-1)
            // };
            // rows.push(doc);
            // i++;
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

	var notTitle = new Array(<?php echo $not_array?>);
   	var notId = new Array(<?php echo $notids_array?>);
   	var notUser = new Array(<?php echo $notuser_array?>);

    var eName = new Array(<?php echo $evo_array?>);    
   	var eId = new Array(<?php echo $evoids_array?>);
   	var eStatus = new Array(<?php echo $status_array?>);
	var gName = new Array(<?php echo $evo_groups_array?>);    
    var gId = new Array(<?php echo $evo_groupids_array?>);

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
    	//<a href="'+ url + badgesId[i] +'" >Edit</a> | 
    	return '<a href="'+ url + badgesId[i] +'" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="document.getElementById(' + str +').click();" ><i class="fa fa-times-circle"></i></a>';
    }

    function notButtons(i) {
    	var url = getCorrectURL(" ");
    	var str = "'deleteNotification" + notId[i] + "'";
    	return '<a href="#" onclick="document.getElementById(' + str +').click();" ><i class="fa fa-times-circle"></i></a>';
    }

	function orgsButtons(i) {
    	var url = getCorrectURL("organizations/edit/");
    	str = "'orgsDelete" + orgsId[i] + "'";
    	return '<a href="'+ url + orgsId[i] +'" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="document.getElementById(' + str +').click();" ><i class="fa fa-times-circle"></i></a>';
    }

    function issuesButtons(i) {
    	var url = getCorrectURL("issues/edit/");
    	var str = "'issuesDelete" + issuesId[i] + "'";
    	return '<a href="'+ url + issuesId[i] +'" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="document.getElementById(' + str +').click();" ><i class="fa fa-times-circle"></i></a>';
    }

    function missionButtons(i) {
    	var url = getCorrectURL("panels/edit_mission/");
    	var str = "'deleteMission" + missionsId[i] + "'";
    	return '<a href="' + url  + missionsId[i] +'" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="document.getElementById(' + str +').click();" ><i class="fa fa-times-circle"></i></a>';
    }

    function userButtons(i) {
    	//var url = getCorrectURL("panels/edit_user/");
    	var str = "'deleteUser" + usersId[i] + "'";
    	return '<a href="#" onclick="document.getElementById(' + str +').click();" ><i class="fa fa-times-circle"></i></a>';
    }

    function getCorrectURL(afterHome){
    	var str = document.URL;
    	
    	//str = str.substr(7, str.length);
    	str = str.substr(0, str.indexOf("panels"));
    	
    	str = str.substr(0, str.length -1);
    	// alert(str);
    	if(str.length>1) {
    		// str = str.substr(0, str.indexOf('/', 1));
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