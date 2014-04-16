<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('jcarousel');
	//echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?></h1>
		</li>
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
	</ul>

	<section class="evoke dashboard top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>"><img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke top-bar icon"/></a></li>
			
			<li class="name">
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>" class = "evoke top-bar-name"><?= sprintf(__('Hi %s'), $users['User']['name']) ?></a>
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
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background padding top-5">

	<?php echo $this->Session->flash(); ?>

	<div class="row full-width">
		<div class="small-8 medium-8 large-9 columns">

			<?php if(!$is_friend AND ($users['User']['id'] != $user['User']['id'])):?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Follow this agent');?></a>
			<?php elseif($is_friend AND ($users['User']['id'] != $user['User']['id'])): ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Unfollow this agent');?></a>
			<?php endif; ?>

			<?= $this->element('left_titlebar', array('title' => __('Choose a mission'))) ?>

			<div class = "evoke dashboard position">
	            <div class="jcarousel-wrapper">

	            	<div class="row">
					  <div class="small-9 small-centered columns">
					  	<div class="jcarousel">
		                    <ul>
		                        <?php foreach($missions as $m):?>
		                        	<li class = "evoke dashboard position">
		                        		<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1));?>">
			                        		<img src='<?= $this->webroot.'img/evoke_folder.png' ?>' width = "80%;"/>
			                        		<span class = "evoke dashboard folders"><?php echo $m['Mission']['title'];?></span>
			                        		<?php foreach ($imgs as $img) : ?>
			                        			<?php 
			                        				if($m['Mission']['id'] == $img['Attachment']['foreign_key']):
			                        					$path = ' '.$this->webroot.'files/attachment/attachment/'.$img['Attachment']['dir'].'/thumb_'.$img['Attachment']['attachment'] . '';

			                        					//echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission_img[0]['Attachment']['dir'].'/thumb_'.$mission_img[0]['Attachment']['attachment'] . '"/>';?>
			                        					<img src = "<?= $path ?>" class = "evoke dashboard folders-img"/>
			                        			
			                        		<?php endif; endforeach; ?>
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
			    			echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
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
			    			echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
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
						<?php 
							$first = ' class="active"';
							$index = 1;
							foreach ($power_points as $pp) {
								echo '<dd'. $first.'><a href="#Leader-'. $index .'" style = "margin-top:30px; margin-left:30px">'. $pp['PowerPoint']['name'] .'</a></dd>';
								$index++;
								$first = '';
							}
						?>
					</dl>
					<div class="tabs-content">
						<?php 
							$first = ' active';
							$index = 1;
							foreach ($power_points as $pp) {
								echo '<div class="content'. $first .'" id="Leader-'. $index .'">';
									echo '<ul>';
									$zeros = array();
									$pos = 1;
									foreach ($allusers as $usr) {
										if(isset($powerpoints_users[$pp['PowerPoint']['id']][$usr['User']['id']])) {
											echo '<li>';
											echo '<h1>'. $pos .'</h1>';
											echo '<img src = '. $this->webroot.'img/test_users/leslie.jpg' . ' class = "evoke dashboard users-icon">';
											echo '<span>'. $usr['User']['name'] . '</span>';
											echo '<span>|'. $pp['PowerPoint']['name'] .' Points: '.$powerpoints_users[$pp['PowerPoint']['id']][$usr['User']['id']].' pts</span>';
											echo '</li>';
											$pos++;	
										} else {
											$zeros[] = $usr;
										}
										
									}

									foreach ($zeros as $zero) {
										echo '<li>';
										echo '<h1>'. $pos .'</h1>';
										echo '<img src = '. $this->webroot.'img/test_users/leslie.jpg' . ' class = "evoke dashboard users-icon">';
										echo '<span>'. $zero['User']['name'] . '</span>';
										echo '<span>|'. $pp['PowerPoint']['name'] .' Points: 0 pts</span>';
										echo '</li>';
										$pos++;	
									}								
									echo '</ul>';
								echo '</div>';
								$index++;
								$first = '';
							}
						?>
					</div>
					<!-- <div class ="button general red" style = "margin-top:30px; margin-left:30px"><?= __('This Week') ?></div>
					<ul>
						<li>
							<h1>1</h1>
							<img src = '<?= $this->webroot.'img/test_users/leslie.jpg' ?>' class = "evoke dashboard users-icon">
							<span>Leslie Knope</span>
							<span>Level 10 | Points 110</span>
						</li>
						<li>
							<h1>2</h1>
							<img src = "https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke dashboard users-icon">
							<span><?= $users['User']['name'] ?></span>
							<span>Level 10 | Points 100</span>
						</li>
						<li>
							<h1>3</h1>
							<img src = '<?= $this->webroot.'img/test_users/ron.jpg' ?>' class = "evoke dashboard users-icon">
							<span>Ron Swanson</span>
							<span>Level 9 | Points 90</span>
						</li>
					</ul> -->
				</div>

			</div>

		</div>

		<div class="small-4 medium-4 large-3 columns">

			<div class = "evoke dashboard tag">
				<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%" style = "position: absolute; top: 0;"/>

				<div class="row" style = "margin-top:10%">
					  <div class="small-4 medium-4 large-4 columns"><a href = "https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large"><img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke dashboard user_pic"/></a></div>
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
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height"/></div>
					</div>

					<div class = "evoke screen-box allies" style = "padding: 40px 20px">
						<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
							<?php foreach($allies as $ally): ?>
								<li><img src = "https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"><span><?= $ally['User']['name'] ?></span></li>
						  <!-- <li><img src = '<?= $this->webroot.'img/test_users/leslie.jpg' ?>'><span>Leslie Knope</span></li>
						  <li><img src = '<?= $this->webroot.'img/test_users/ron.jpg' ?>'><span>Ron Swanson</span></li>
						  <li><img src = '<?= $this->webroot.'img/test_users/tom.jpg' ?>'><span>Tom Haverford</span></li>
						  <li><img src = '<?= $this->webroot.'img/test_users/chris.jpg' ?>'><span>Chris Traeger</span></li>
						  <li><img src = '<?= $this->webroot.'img/test_users/andy.jpg' ?>'><span>Andy Dwyer</span></li>
						  <li><img src = '<?= $this->webroot.'img/test_users/ben.jpg' ?>'><span>Ben Wyatt</span></li>
						  <li><img src = '<?= $this->webroot.'img/test_users/april.jpg' ?>'><span>April Ludgate</span></li> -->
							<?php endforeach;?>
						</ul>
					</div>

				</div>

				<div class = "evoke dashboard position">
					<div class = "evoke text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('Feed');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height-two"/></div>
					</div>
					<div class = "evoke screen-box dashboard feed">
						<ul>
							<li>Ron Swanson added a new profile picture</li>
							<li>Ann Perkins created a new discussion</li>
							<li>April Ludgate started a project</li>
							<li>Ben Wyatt changed his profile picture</li>
							<li>Andy Dwyer created a new Evokation Team</li>
							<li>Leslie Knope finished a project</li>
							<li>Chris Traeger commented on your disccusion</li>
							<li>Andy Dwyer created a new discussion</li>
							<li>Ann Perkins started a project</li>
							<li>Chris Traeger changed his profile picture</li>
							<li>April Ludgate created a new Evokation Team</li>
							<li>Ron Swanson finished a project</li>
						</ul>
					</div>
				</div>

				<div class = "evoke dashboard position">
					<div class = "evoke text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('Badges');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height-two"/></div>
					</div>
					<div class = "evoke screen-box badges" style = "padding: 20px 10px 10px 20px;">
						<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
						  <li><img src = '<?= $this->webroot.'img/badge1.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge2.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge3.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge4.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge1.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge2.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge3.png' ?>'></li>
						</ul>

						<!-- <img src = '<?= $this->webroot.'img/badge1.png' ?>' class = "evoke dashboard badges-icon">
						<img src = '<?= $this->webroot.'img/badge2.png' ?>' class = "evoke dashboard badges-icon">
						<img src = '<?= $this->webroot.'img/badge3.png' ?>' class = "evoke dashboard badges-icon">
						<img src = '<?= $this->webroot.'img/badge4.png' ?>' class = "evoke dashboard badges-icon"> -->
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

	<img src = '<?= $this->webroot.'img/parabolic.png' ?>' class = "evoke parabolic"/>

</section>

<?php

	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('/components/jcarousel/dist/jquery.jcarousel', array('inline' => false));
	//echo $this->Html->script('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->script('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->script('/components/jcarousel/examples/responsive/jcarousel.responsive', array('inline' => false));


?>

<script>

	$('.jcarousel').jcarousel('scroll', '3');

</script>
