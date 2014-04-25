<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('jcarousel');
	//echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $users, 'sumMyPoints' => $sumMyPoints));
	$this->end(); 
	
?>

<section class="evoke background">
	
	<?= $this->element('menu', array('user' => $user)) ?>

	<div class = "evoke dashboard position">
		<?= $this->element('left_titlebar', array('title' => __(sprintf(__("Agent's %s Dashboard"), $user['User']['name'])))) ?>
	</div>

	<!-- <div class = "evoke position">
		<div class = "evoke titles-left">
			<img src = '<?= $this->webroot.'img/small_bar.png' ?>'>
			<div class = "evoke titles" style = "margin-left: -150px;"><h4><?php echo strtoupper(__(sprintf(__("Agent's %s Dashboard"), $user['User']['name'])));?></h4></div>
			
		</div>
	</div> -->

	<div class = "evoke dashboard position">
  		<div class = "evoke titles-right">
  			<div class = "evoke titles titles-ajust">
		  		<dl class="tabs" data-tab>
				  <dd><h4><?php echo strtoupper(__("Agent's Projects and Evidences"));?></h4></dd>
				  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
				  <!-- <dd><a href="#panel2-2"><?php echo __('Projects I Follow');?></a></dd>
				  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd> -->
				</dl>
			</div>
			<!-- <img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke dashboard horizontal_bar absolute-right"> -->
			<!-- <img src = '<?= $this->webroot.'img/smallbar.png' ?>' class = "evoke tabs-small-bar-size"> -->
			<img src = '<?= $this->webroot.'img/smallbar.png' ?>' class = "evoke small-bar-size" style = "margin-top: -2%;">
		</div>
	</div>

	<div class="row full-width">
		<div class="small-3 medium-3 large-3 columns">
			<div class = "evoke dashboard tag">
				<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%"/>

				<div class="row">
					  <div class="small-4 medium-4 large-4 columns">
					  	<a href = "#">
					  		<?php if($user['User']['photo_attachment'] == null) : ?>
			  					<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" class = "evoke dashboard user_pic"/>
			  				<?php else : ?>
			  					<img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>" class = "evoke dashboard user_pic"/>
			  				<?php endif; ?>
					  	</a>
					  </div>
					  <div class="small-8 medium-8 large-8 columns evoke dashboard tag-padding">
						<div class = "evoke dashboard agent info">
							<h6><?php echo strtoupper(__("Evoke Agent"));?></h6>
							<h4><?php echo $user['User']['name']; ?></h4>
							<h5><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<div><?= $level ?></div></h5>
							<div class="evoke dashboard progress small-9 large-9 round">
							  <span class="meter" style="width: <?= $percentageOtherUser ?>%"></span>
							</div>

							<h5><?php echo __('Points');?>&nbsp;&nbsp;<div><?= $sumPoints ?></div></h5>
						</div>
					  </div>
				</div>

				<div class = "evoke dashboard agent-data border-top">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac ipsum pulvinar, lobortis purus sed, sodales orci. Suspendisse viverra elementum diam non auctor. Etiam convallis tellus ac egestas euismod. Pellentesque et leo sed odio sodales lacinia sed vestibulum sem.</p>
				</div>

				<div class = "evoke dashboard agent-data">
					<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
					<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
					<i class="fa fa-twitter-square fa-2x"></i>
				</div>

				<div class = "evoke text-align">
					<?php if(!$is_friend):?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button general"><?php echo __('Follow this agent');?></a>
					<?php else: ?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $is_friend['UserFriend']['id'])); ?>" class = "button general"><?php echo __('Unfollow this agent');?></a>
					<?php endif; ?>
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
						  	<?php endforeach;?>
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
					<div class = "evoke screen-box badges" style = "padding: 20px 10px 10px 40px;">
						<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
						  <li><img src = '<?= $this->webroot.'img/badge1.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge2.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge3.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge4.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge1.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge2.png' ?>'></li>
						  <li><img src = '<?= $this->webroot.'img/badge3.png' ?>'></li>
						</ul>
					</div>
				</div>

				<div class = "evoke dashboard position" style = "margin-top: -60px;">
					<div class = "evoke dashboard bottom-bar">
						<img src = '<?= $this->webroot.'img/vertical_bar.png' ?>'/>
					</div>
				</div>

			</div>

		</div>
		<div class="small-9 medium-9 large-9 columns padding-right">

			<div class="evoke tabs-content screen-box dashboard panel">
				  <div class="content active" id="panel2-1">
			    	<?php 
			    	//Lists all projects and evidences
			    		foreach($myevidences as $e): 
			    				echo $this->element('evidence_box', array('e' => $e)); 
			    		endforeach; 

			    		foreach($myEvokations as $e):
			    			echo $this->element('evokation_box', array('e' => $e, 'evokationFollowing' => $evokationsFollowing));
						endforeach;
					?>
				  </div>				  
				</div>

				<div class = "evoke dashboard position">

					<?php echo $this->element('right_titlebar', array('title' => (__('Leadercloud')))); ?>

					<div class = "evoke screen-box allies dashboard leadercloud margin">
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
								foreach ($points_users as $p => $point) {
									foreach ($point as $usr) {
										echo '<li>';
										echo '<h1>'. $pos .'</h1>';
										if($usr['User']['photo_attachment'] == null) : ?>
			  								<img src="https://graph.facebook.com/<?php echo $usr['User']['facebook_id']; ?>/picture?type=large" class = "evoke dashboard users-icon"/>
			  							<?php else : ?>
			  								<img src="<?= $this->webroot.'files/attachment/attachment/'.$usr['User']['photo_dir'].'/thumb_'.$usr['User']['photo_attachment'] ?>" class = "evoke dashboard users-icon"/>
			  							<?php endif;

										echo '<span>'. $usr['User']['name'] . '</span>';
										echo '<span>Level '. $usr['User']['level'] .' | Points '. $p .'</span>';
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

				<div class = "evoke dashboard position">
				
					<?php echo $this->element('right_titlebar', array('title' => (__('Feed')))); ?>

					<div class = "evoke screen-box dashboard feed margin">
						<ul>
							<!-- <li>Ron Swanson added a new profile picture</li>
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
							<li>Ron Swanson finished a project</li> -->
						</ul>
					</div>
				</div>
		</div>
	</div>

	<img src = '<?= $this->webroot.'img/parabolic_left.png' ?>' class = "evoke parabolic_left"/>

</section>
