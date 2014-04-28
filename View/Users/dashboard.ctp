<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('jcarousel');
	//echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?></h1>
		</li>
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li>
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>">
					<?php if($users['User']['photo_attachment'] == null) : ?>
			  			<img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke top-bar icon"/>
			  		<?php else : ?>
			  			<img src="<?= $this->webroot.'files/attachment/attachment/'.$users['User']['photo_dir'].'/'.$users['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
			  		<?php endif; ?>
				</a>
			</li>
			
			<li class="name">
				<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>" class = "evoke top-bar-name"><?= sprintf(__('Hi %s'), $users['User']['name']) ?></a></h3>
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
					<li><h1><?php echo $this->Html->link(__('Edit information'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
		</ul>

		<h3 class = "evoke dashboard title"><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background">

	<?= $this->element('menu', array('user' => $users)) ?>

	<?php echo $this->Session->flash(); ?>

	<?= $this->element('left_titlebar', array('title' => __('Choose a mission'))) ?>
	
	<div class="row full-width">
		<div class="small-7 medium-7 large-8 columns">

			<?php if(!$is_friend AND ($users['User']['id'] != $user['User']['id'])):?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Follow this agent');?></a>
			<?php elseif($is_friend AND ($users['User']['id'] != $user['User']['id'])): ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Unfollow this agent');?></a>
			<?php endif; ?>

			<div class = "evoke dashboard position">
	            <div class="jcarousel-wrapper">

	            	<div class="row">
					  <div class="small-9 small-centered columns">
					  	<div class="jcarousel">
		                    <ul>
		                        <?php foreach($missions as $m): ?>
		                        	<li class = "evoke dashboard position">
		                        		<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1)) ?>">
			                        		<img src='<?= $this->webroot.'img/evoke_folder.png' ?>' width = "80%;"/>
			                        		<span class = "evoke dashboard folders"><?php echo $m['Mission']['title'];?></span>
			                        		<?php 
			                        			if(!empty($m['Attachment'])) :
			                        				$img = end($m['Attachment']);
			                        				// echo '<span>' . $img['attachment'] . '</span>';
		                        					$path = ' '.$this->webroot.'files/attachment/attachment/'. $img['dir'].'/thumb_' . $img['attachment'].'';
		                        					?>
		                        					<img src = "<?= $path ?>" class = "evoke dashboard folders-img"/>
			                        			
			                        		<?php endif; ?>
		                        		</a>
		                        	</li>
					    		<?php endforeach; ?>
		                    </ul>
		                </div>
					  </div>
					</div>
	                
        			<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
					<a href="#" class="jcarousel-control-next">&rsaquo;</a>
			  		<img src='<?= $this->webroot.'img/shelve150.png' ?>' class = "evoke dashboard shelve"/>

	            </div>
	        </div>

			<div class = "evoke dashboard position">
				<dl class="tabs evoke titles" data-tab>
				  <dd><h4><?php echo strtoupper(__('Projects and Evidences'));?></h4></dd>
				  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
				  <dd><a href="#panel2-2"><?php echo __('Projects I Follow');?></a></dd>
				  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd>
				</dl>

				<img src = '<?= $this->webroot.'img/horizontal_bar.png' ?>' class = "screen_bar">
				<div class="evoke tabs-content screen-box dashboard panel margin">
				  <div class="content active" id="panel2-1">
			    	<?php 
			    		//Lists all projects and evidences
			    		foreach($evidence as $e): 
			    				//echo $this->element('evidence_blue_box', array('e' => $e)); 
			    				echo $this->element('evidence_box', array('e' => $e)); 
			    		endforeach; 


			    		foreach($evokations as $e):
			    			$showFollowButton = true;
			    			foreach($myEvokations as $my)
			    				if(array_search($my['Evokation']['id'], $e['Evokation'])) {
			    					$showFollowButton = false;
			    					break;
			    				}
			    			if($showFollowButton) 
			    				echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
			    			else
			    				echo $this->element('evokation_box', array('e' => $e, 'mine' => true));
						endforeach;
					?>
				  </div>
				  <div class="content" id="panel2-2">
		    		<?php 
		    			foreach($evokations as $e):
			    			foreach($evokationsFollowing as $following)
			    				if($e['Evokation']['id'] == $following['Evokation']['id']) {
			    					echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));		
			    				}
			    		endforeach;
			    	?>
				  </div>
				  <div class="content" id="panel2-3">
				  	<?php 
			    		foreach($myEvokations as $e):
			    			echo $this->element('evokation_box', array('e' => $e, 'mine' => true));
			    		endforeach;
			    	?>
				  </div>
				</div>
			</div>

			<div class = "evoke dashboard position">
				<?= $this->element('left_titlebar', array('title' => __('Leaderboard'))) ?>
				<!-- <img src = '/evoke/webroot/img/horizontal_bar.png' class = "evoke dashboard horizontal_bar">
				<div class = "evoke titles"><h4><?php echo __('LEADERCLOUD');?></h4></div> -->

				<img src = '<?= $this->webroot.'img/horizontal_bar.png' ?>' class = "screen_bar">

				<div class="evoke screen-box dashboard leadercloud margin">
					<dl class="tabs" data-tab>
						<dd class="active"><a href="#LeaderXP" style = "margin-top:30px; margin-left:30px"><?= __('Levels') ?></a></dd>
						<?php 
							$index = 1;
							foreach ($power_points as $pp) {
								echo '<dd><a href="#Leader-'. $index .'" style = "margin-top:30px; margin-left:30px">'. $pp['PowerPoint']['name'] .'</a></dd>';
								$index++;
							}
						?>
					</dl>
					<div class="tabs-content">
						<div class="content active" id="LeaderXP">
							<ul>
							<?php 
								$pos = 1;
								// debug($points_users);
								foreach ($points_users as $p => $point) {
									foreach ($point as $usr) {
										echo '<li>';
										echo '<h1>'. $pos .'</h1>';
										if($usr['photo_attachment'] == null) : ?>
			  								<img src="https://graph.facebook.com/<?php echo $usr['facebook_id']; ?>/picture?type=large" class = "evoke dashboard users-icon"/>
			  							<?php else : ?>
			  								<img src="<?= $this->webroot.'files/attachment/attachment/'.$usr['photo_dir'].'/thumb_'.$usr['photo_attachment'] ?>" class = "evoke dashboard users-icon"/>
			  							<?php endif;

										echo '<span>'. $usr['name'] . '</span>';
										echo '<span>Level '. $usr['level'] .' | Points '. $p .'</span>';
										echo '</li>';
										$pos++;
									}
								}
							?>
							</ul>
						</div>
						<?php 
							$index = 1;
							foreach ($power_points as $pp) {
								echo '<div class="content" id="Leader-'. $index .'">';
									echo '<ul>';
									$zeros = array();
									$pos = 1;
									foreach ($powerpoints_users[$pp['PowerPoint']['id']] as $pps => $ppusr) {
										foreach ($ppusr as $usr) {
											echo '<li>';
											echo '<h1>'. $pos .'</h1>';
											if($usr['photo_attachment'] == null) : ?>
				  								<img src="https://graph.facebook.com/<?php echo $usr['facebook_id']; ?>/picture?type=large" class = "evoke dashboard users-icon"/>
				  							<?php else : ?>
				  								<img src="<?= $this->webroot.'files/attachment/attachment/'.$usr['photo_dir'].'/thumb_'.$usr['photo_attachment'] ?>" class = "evoke dashboard users-icon"/>
				  							<?php endif;

											echo '<span>'. $usr['name'] . '</span>';
											echo '<span>'. $pp['PowerPoint']['name'].' Points '. $pps .'</span>';
											echo '</li>';
											$pos++;
										}
									}								
									echo '</ul>';
								echo '</div>';
								$index++;
							}
						?>
					</div>
				</div>

			</div>

		</div>

		<div class="small-5 medium-5 large-4 columns">

			<div class = "evoke dashboard tag">
				<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%" style = "position: absolute; top: 0;"/>

				<div class="row" style = "margin-top:10%">
					  <div class="small-4 medium-4 large-4 columns evoke text-align">
					  	<a href = "#">
					  		<?php if($user['User']['photo_attachment'] == null) : ?>
			  					<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" class = "evoke dashboard user_pic"/>
			  				<?php else : ?>
			  					<img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>" class = "evoke dashboard user_pic"/>
			  				<?php endif; ?>
					  	</a>
					  </div>
					  <div class="small-8 medium-8 large-8 columns">
					  	<div class = "evoke dashboard agent info">
					  		<h6><?php echo strtoupper(__("Evoke Agent"));?></h6>
					  		<h4><?php echo $user['User']['name']; ?></h4>
					  		<h5><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<div><? echo $myLevel; ?></div></h5>
							<div class="evoke dashboard progress small-9 large-9 round">
							  <span class="meter" style="width: <?= $percentage ?>%"></span>
							</div>

							<h5><?php echo __('Points');?>&nbsp;&nbsp;<div><?= $sumMyPoints ?></div></h5>
					  	</div>
					  </div>
				</div>

			</div>
			
			<div class = "evoke dashboard position margin">

				<div class = "evoke dashboard position">
					<div class = "evoke text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('Allies');?></h4>
							<a href = "" class = "evoke button general" style = "margin-right: 20px;" data-reveal-id="myModalAllies"><?php echo __('See All');?></a>
						</div>

						<div id="myModalAllies" class="reveal-modal small evoke lightbox" data-reveal>
						  <h2><?= __('Allies') ?></h2>

						  	<ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-1">
						  	<?php foreach($allies as $ally):?>
								<li>
									<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $ally['User']['id'])) ?>">
										<?php if($ally['User']['photo_attachment'] == null) : ?>
						  					<img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large" style = "width: 25%; margin-right: 40px;"/>
						  				<?php else : ?>
						  					<img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/thumb_'.$ally['User']['photo_attachment'] ?>" style = "width: 25%; margin-right: 40px;"/>
						  				<?php endif; ?>
										
										<span><?= $ally['User']['name'] ?></span>
									</a>
								</li>
							<?php endforeach;?>
							</ul>
						  <a class="close-reveal-modal">&#215;</a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height"/></div>
					</div>

					<div class = "evoke screen-box allies">
						
							<?php if(!$allies): ?>

								<img src = '<?= $this->webroot.'img/placeholders-allies.png' ?>' style = "width: 100%; max-height: 100%;">
							
							<?php else: $count = 0;?>

								<div style = "padding:20px 20px 0px">
								<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
								<?php foreach($allies as $ally): $count++; ?>
									<li>
										<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $ally['User']['id'])) ?>">
											<?php if($ally['User']['photo_attachment'] == null) : ?>
							  					<img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"/>
							  				<?php else : ?>
							  					<img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/thumb_'.$ally['User']['photo_attachment'] ?>"/>
							  				<?php endif; ?>
											
											<span><?= $ally['User']['name'] ?></span>
										</a>
									</li>
							  	<?php 
							  	

							  	if($count == 8)
							  		break;

							  	endforeach;?>
							  	</ul>
							  	</div>
							<?php endif; ?>	

					</div>

				</div>

				<div class = "evoke dashboard position">
					<div class = "evoke text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('Feed');?></h4>
							<a href = "" class = "evoke button general" style = "margin-right: 20px;"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height-two"/></div>
					</div>
					<div class = "evoke screen-box dashboard feed">

						<?php if(!$notifies): ?>

							<img src = '<?= $this->webroot.'img/placeholders-feed.png' ?>' style = "width: 100%; max-height: 100%;">
							<!-- <h1><?= strtoupper(__('You have no allies at the moment')) ?></h1> -->

						<?php else: ?>

						<ul>
							<?php foreach($notifies as $n): 

							if($n['Notification']['origin'] == 'evidence'):?>						
								<li><a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s posted an evidence'), $n['User']['name']) ?></li></a>
							<?php endif; ?>

							<?php if($n['Notification']['origin'] == 'BasicTraining'):?>						
								<li><?= sprintf(__('Agent %s finished the Basic Training'), $n['User']['name']) ?></li>
							<?php endif; ?>

							<?php if($n['Notification']['origin'] == 'like'):?>						
								<li><a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s liked an evidence'), $n['User']['name']) ?></a></li>
							<?php endif; ?>

							<?php if($n['Notification']['origin'] == 'commentEvidence'):?>						
								<li><a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s commented an evidence'), $n['User']['name']) ?></a></li>
							<?php endif; ?>

							<?php if($n['Notification']['origin'] == 'phaseCompleted'):?>						
								<!-- <li><?= sprintf(__('Agent %s completed a phase'), $n['User']['name']) ?></li> -->
							<?php endif; ?>
							
							<?php endforeach; ?>
						</ul>

						<?php endif; ?>

					</div>
				</div>

				<div class = "evoke dashboard position">
					<div class = "evoke text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('Badges');?></h4>
							<a href = "<?= $this->Html->url(array('controller' => 'badges', 'action' => 'index')) ?>" class = "evoke button general" style = "margin-right: 20px;"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height-two"/></div>
					</div>
					<div class = "evoke screen-box badges">

						<?php if(!$badges): ?>

							<img src = '<?= $this->webroot.'img/placeholders-badges.png' ?>' style = "width: 100%; max-height: 100%;">
							<!-- <h1><?= strtoupper(__('You have no allies at the moment')) ?></h1> -->

						<?php else: ?>

						<div style = "padding: 20px 10px 10px 20px;">
							<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
								<?php 

								foreach($badges as $badge): 
									if(isset($badge['Badge']['img_dir'])) : ?>
										<li><img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'></li>
									<?php else: ?>
										<li><img src = '<?= $this->webroot.'img/badge4.png' ?>'></li>
									<?php endif ?>
								<?php endforeach;?>
							</ul>
						</div>

						<?php endif; ?>

					</div>
				</div>

				<div class = "evoke dashboard position" style = "margin-top: -60px;">
					<div class = "evoke dashboard bottom-bar">
						<img src = '<?= $this->webroot.'img/vertical_bar.png' ?>'/>
					</div>
				</div>

			</div>

		</div>

	</div>

	<?php if ($users['User']['basic_training'] == 0 && isset($basic_training)): ?>
	<!-- <div id="formModal" class="reveal-modal evoke lightbox text-align" data-reveal style = "top: 370px;!important">
	  <img src = '<?= $this->webroot.'img/alchemy.png' ?>' style = "margin-top: -460px;"/>
	  <h2><?= sprintf(__("Agent %s, it's time to start your Basic Training"), $name[0]) ?></h2>
	  <p class="lead"><?= __('This training will show you the steps inside a missions so you can start being an agent of change') ?></p>
	  <a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1)); ?>" class = "button general"><?php echo __("Let's get started!");?></a>
	  <a class="close-reveal-modal">&#215;</a>
	</div> -->
	<?php endif; ?>

	<img src = '<?= $this->webroot.'img/parabolic.png' ?>' class = "evoke parabolic"/>

</section>

<?php
	echo $this->Html->script('reveal_modal', array('inline' => false));
	// echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('/components/jcarousel/dist/jquery.jcarousel', array('inline' => false));
	//echo $this->Html->script('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->script('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->script('/components/jcarousel/examples/responsive/jcarousel.responsive', array('inline' => false));



?>

<script>

	// $('#formModal').foundation('reveal', 'open');

</script>
