<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('jcarousel');
	//echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>"><img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke top-bar icon"/></a></li>
			<li class="name">
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>"><h1><?= sprintf(__('Hi %s'), $users['User']['name']) ?></h1></a>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
			<li>
				<?php
					/*
					echo $this->Form->create('', array('controller' => 'app', 'action'=>'changeLang'));
					echo $this->Form->hidden('language', array('value'=>'pt'));
					echo $this->Form->end('Port');
					*/
				?>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background padding top-2">
	
	<div class="row full-width">
	  	<div class="large-5 columns">
		  	<div class = "evoke dashboard position">
				<?= $this->element('left_titlebar', array('title' => __(sprintf(__("Agent's %s Dashboard"), $user['User']['name'])))) ?>
			</div>
		</div>
	  	<div class="large-7 columns padding-right">
		  	<div class = "evoke dashboard position">
		  		<div class = "evoke titles-right">
		  			<div class = "evoke titles titles-ajust">
				  		<dl class="tabs" data-tab>
						  <dd><h4><?php echo strtoupper(__('Projects and Evidences'));?></h4></dd>
						  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
						  <dd><a href="#panel2-2"><?php echo __('Projects I Follow');?></a></dd>
						  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd>
						</dl>
					</div>
					<!-- <img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke dashboard horizontal_bar absolute-right"> -->
					<img src = '<?= $this->webroot.'img/smallbar.png' ?>' class = "evoke tabs-small-bar-size">
				</div>
			</div>
		</div>
	</div>

	<div class="row full-width">
		<div class="medium-3 columns">
			<div class = "evoke dashboard tag">
				<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%"/>

				<div class="row">
					  <div class="small-4 columns"><a href = "https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large"><img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke dashboard user_pic"/></a></div>
					  <div class="small-8 columns evoke dashboard tag-padding">
						<div class = "evoke dashboard agent info">
							<h6><?php echo strtoupper(__("Evoke Agent"));?></h6>
							<h4><?php echo $user['User']['name']; ?></h4>
							<h5><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<div><?php echo 10;?></div></h5>
							<div class="evoke dashboard progress small-9 large-9 round">
							  <span class="meter" style="width: 50%"></span>
							</div>

							<h5><?php echo __('Points');?>&nbsp;&nbsp;<div><?php echo 12345678;?></div></h5>
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
					<?php if(!$is_friend AND ($users['User']['id'] != $user['User']['id'])):?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button general"><?php echo __('Follow this agent');?></a>
					<?php elseif($is_friend AND ($users['User']['id'] != $user['User']['id'])): ?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button general"><?php echo __('Unfollow this agent');?></a>
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

					<div class = "evoke screen-box allies"></div>

				</div>

				<div class = "evoke dashboard position">
					<div class = "evoke text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('Badges');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height-two"/></div>
					</div>
					<div class = "evoke screen-box allies"></div>
				</div>

				<div class = "evoke text-align position">
					<img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class = "badges_bar"/>
				</div>

			</div>

		</div>
		<div class="medium-9 columns padding-right">

			<div class="evoke tabs-content screen-box dashboard panel margin">
				  <div class="content active" id="panel2-1">
			    	<?php 
			    	//Lists all projects and evidences
			    		foreach($evidence as $e): 
			    				echo $this->element('evidence_box', array('e' => $e)); 
			    		endforeach; 

			    		foreach($evokations as $e):
			    			echo $this->element('evokation_box', array('e' => $e));
						endforeach;
					?>
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

				<div class = "evoke dashboard position">
					<?php echo $this->element('right_titlebar', array('title' => (__('Leadercloud')))); ?>

					<div class = "evoke screen-box allies margin"></div>
				</div>

				<div class = "evoke dashboard position">
				
					<?php echo $this->element('right_titlebar', array('title' => (__('Feed')))); ?>

					<div class = "evoke screen-box allies margin"></div>
				</div>
		</div>
	</div>

	<img src = '<?= $this->webroot.'img/parabolic_left.png' ?>' class = "evoke parabolic_left"/>

</section>
