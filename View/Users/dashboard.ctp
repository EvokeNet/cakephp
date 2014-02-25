<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $users['User']['name']; ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background padding top-2">
	<div class="row full-width">
		<div class="medium-9 columns">

			<?php if(!$is_friend AND ($users['User']['id'] != $user['User']['id'])):?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Follow this user');?></a>
			<?php elseif($is_friend AND ($users['User']['id'] != $user['User']['id'])): ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Unfollow this user');?></a>
			<?php endif; ?>

			<img src = '/evoke/webroot/img/horizontal_bar.png' class = "evoke dashboard horizontal_bar">
			<div class = "evoke titles"><h4><?php echo __('CHOOSE A MISSION');?></h4></div>

			<div class = "evoke dashboard position">
	            <div class="jcarousel-wrapper">

	            	<div class="row">
					  <div class="small-9 large-centered columns">
					  	<div class="jcarousel">
		                    <ul>
		                        <?php foreach($missions as $m):?>
		                        	<li class = "evoke dashboard position">
		                        		<!-- <div class = "folderss"><div><a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1));?>"><?php echo $m['Mission']['title'];?></a></div></div> -->
		                        		<img src="/evoke/webroot/img/evoke_folder.png" width = "70%;"/>
		                        		<div class = "evoke dashboard folders"><a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1));?>"><?php echo $m['Mission']['title'];?></a></div>
		                        	</li>
					    		<?php endforeach; ?>
		                    </ul>
		                </div>
					  </div>
					</div>
	                
        			<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
					<a href="#" class="jcarousel-control-next">&rsaquo;</a>
			  		<img src="/evoke/webroot/img/shelve150.png" style = "width:100%; margin-top:-100px">

	            </div>
	        </div>

			<div class = "evoke dashboard position">
				<dl class="tabs evoke titles" data-tab>
				  <dd><h4><?php echo __('EVOKE PANEL');?></h4></dd>
				  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
				  <dd><a href="#panel2-2"><?php echo __('Projects I Follow');?></a></dd>
				  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd>
				</dl>

				<!-- <img src = '/evoke/webroot/img/horizontal_bar.png' alt = "" style = "margin-bottom: -75px; margin-left: -15px;"> -->
				<img src = '/evoke/webroot/img/horizontal_bar.png' class = "screen_bar">
				<div class="evoke tabs-content screen-box dashboard panel">
				  <div class="content active" id="panel2-1">
			    	<?php 
			    		//Lists all projects and evidences
			    		foreach($evidence as $e): ?>

			    		<div class="row evoke dashboard evidence">
							<div class="medium-2 columns">
						  		<div class = "evoke dashboard text-align">
						  			<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" width="110px"/>
						  			<h6><?php echo $this->Html->link($e['User']['name'], array('controller' => 'users', 'action' => 'dashboard', $e['User']['id']));?></h6>
						  		</div>
				  			</div>

							<div class="medium-8 columns">
								<h2><?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?></h2>
							</div>

							<div class="medium-2 columns">
								<div>
									<?php foreach($missionIssues as $mi): 
									if($e['Mission']['id'] == $mi['Mission']['id']):?>

									<ul>
										<li><i class="fa fa-comment-o fa-horizontal fa-2x"></i>&nbsp;<?php echo count($e['Comment']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-2x"></i>&nbsp;</li>
										<li><?php echo $mi['Issue']['name']; ?></li>
										<li><?php echo date('F j, Y', strtotime($e['Evidence']['created'])); ?></li>
									</ul>
									
								<?php break; endif; endforeach;?>
								</div>
							</div>	
						</div>

			    	<?php endforeach; 

			    		foreach($evokations as $e):?>

			    		<div class="row evoke evidence">
							<div class="medium-2 columns">
						  		<div style = "text-align:center"><img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" width="110px"/><h6><?php echo $this->Html->link($e['Group']['title'], array('controller' => 'groups', 'action' => 'view', $e['Group']['id'])); ?></h6></div>
				  			</div>

							<div class="medium-8 columns">
								<h2><?php echo $this->Html->link($e['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?></h2>
							</div>

							<div class="medium-2 columns">
								<div>
									<ul>
								  		<li><i class="fa fa-comment-o fa-horizontal fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-2x"></i>&nbsp;</li>
								  		<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general"><?php echo __('Follow');?></a></div></li>
				    				</ul>
								</div>
							</div>	
						</div>

			    	<?php endforeach;?>
				  </div>
				  <div class="content" id="panel2-2">
		    		<?php 
			    		foreach($evokationsFollowing as $e):?>
			    			<h4><?php echo $this->Html->link($e['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?></h4>
				    		<p><?php echo substr($e['Evokation']['abstract'], 0, 100);?></p>
				    		
				    		<div class="row">
							  <div class="large-10 columns">
							  <?php echo ' | Issue | '. date('F j, Y', strtotime($e['Evokation']['created'])); ?></div>
							  <div class="large-2 columns"><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;<?php //echo count($e['Comment']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</div>
							</div>

			    	<?php endforeach;?>
				  </div>
				  <div class="content" id="panel2-3">
				  	<?php 
			    		foreach($myEvokations as $e):?>
			    			<h4><?php echo $this->Html->link($e['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?></h4>
				    		<p><?php echo substr($e['Evokation']['abstract'], 0, 100);?></p>
				    		
				    		<div class="row">
							  <div class="large-10 columns">
							  <?php echo $this->Html->link($e['Group']['title'], array('controller' => 'groups', 'action' => 'view', $e['Group']['id'])).' | Issue | '. date('F j, Y', strtotime($e['Evokation']['created'])); ?></div>
							  <div class="large-2 columns"><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;<?php //echo count($e['Comment']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</div>
							</div>

			    	<?php endforeach;?>
				  </div>
				</div>
			</div>

			<div class = "evoke dashboard position">
				<img src = '/evoke/webroot/img/horizontal_bar.png' class = "evoke dashboard horizontal_bar">
				<div class = "evoke titles"><h4><?php echo __('LEADERCLOUD');?></h4></div>

				<img src = '/evoke/webroot/img/horizontal_bar.png' class = "screen_bar">
				<div class="evoke tabs-content screen-box dashboard leadercloud"></div>
			</div>

		</div>

		<div class="medium-3 columns">
			
		<!-- <div class = "evoke agent_tag">
			<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" style = "width: 100%;"/>
		</div> -->

			<div class = "evoke dashboard text-align position"><img src = '/evoke/webroot/img/agentag120.png' class = "evoke dashboard agent_tag"/>
				<div class = "evoke dashboard agent position">
					<div class="row">
					  <!-- <div class="small-5 columns"><img src='/evoke/webroot/img/IMG_20140116_065202.jpg' style = "max-height: 200px;"/></div> -->
					  <div class="small-5 columns"><img src='/evoke/webroot/img/Leslie_Knope.png' style = "max-height: 200px;"/></div>
					  <div class="small-7 columns">
					  <div class = "evoke dashboard agent info">
					  	<h5><?php echo $user['User']['name']; ?></h5>
					  	<h6><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<div style = "color: #1f8cb2; display: inline; font-size: 1.8em; font-family: 'AlegreyaRegular';"><?php echo 10;?></div>
					  		<div class="evoke dashboard progress small-9 large-9 round">
							  <span class="meter" style="width: 50%"></span>
							</div>
						</h6>

					  	<h6><?php echo __('Points');?>&nbsp;&nbsp;<div style = "color: #1f8cb2; display: inline; font-size: 1.8em; font-family: 'AlegreyaRegular';"><?php echo 12345678;?></div></h6>
					  	</div>
					  </div>
					</div>
					
				</div>
			</div>
			
			<div class = "evoke dashboard position margin">
				<div class = "evoke dashboard position">
					<div class = "evoke dashboard text-align">
							<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('ALLIES');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
							</div>
					</div>
					<div class = "evoke dashboard text-align vertical_bar"><img src = '/evoke/webroot/img/hb.png' class= "top-height"/></div>
					<div class = "evoke screen-box allies"></div>

				</div>
				
				<div class = "evoke dashboard position">
					<div class = "evoke dashboard text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('FEED');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>
					</div>
					<div class = "evoke dashboard text-align vertical_bar"><img src = '/evoke/webroot/img/hb.png' class= "top-height-two"/></div>
					<div class = "evoke screen-box allies"></div>
				</div>

				<div class = "evoke dashboard position">
					<div class = "evoke dashboard text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('BADGES');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>
					</div>
					<div class = "evoke dashboard text-align vertical_bar"><img src = '/evoke/webroot/img/hb.png' class= "top-height-two"/></div>
					<div class = "evoke screen-box allies"></div>
				</div>

				<div class = "evoke dashboard text-align position">
					<img src = '/evoke/webroot/img/hb.png' class = "badges_bar"/>
				</div>

			</div>
		</div>

	</div>

	<img src = '/evoke/webroot/img/parabolic.png' class = "evoke parabolic"/>

</section>

<?php

	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('/components/jcarousel/dist/jquery.jcarousel', array('inline' => false));
	//echo $this->Html->script('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->script('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->script('/components/jcarousel/examples/responsive/jcarousel.responsive', array('inline' => false));

	echo $this->Html->script('/components/tinyscrollbar/lib/jquery.tinyscrollbar', array('inline' => false));

?>

<script>

	$('.jcarousel').jcarousel('scroll', '3');

	$(document).ready(function(){
	    $("#scrollbar1").tinyscrollbar();
	});
</script>
