<?php
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

	<section class="top-bar-section">
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

<section class="evoke margin top-2">
	<div class="row dashboard">
		<div class="medium-9 columns">
			<h1><?php echo __('Dashboard');?></h1>

			<nav class="breadcrumbs dashboard_breadcrumbs">
			  <a class="unavailable" href="#"><?php echo __('Dashboard ');?></a>
			  <?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?>
			  <a class="current" href="#"><?php if($missionIssue) echo __('Issue: ').$missionIssue[0]['Issue']['name']; else echo __('Issue: ').$issue['Issue']['name'];?></a>
			</nav>

			<?php if(!$is_friend AND ($users['User']['id'] != $user['User']['id'])):?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Follow this user');?></a>
			<?php else: ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Unfollow this user');?></a>
			<?php endif; ?>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Projects I Follow');?></a></dd>
			  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
		    	<?php 
			    	//Lists all projects and evidences
		    		foreach($evidence as $e):?>
			    		<h4><?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?></h4>
			    		<p><?php echo substr($e['Evidence']['content'], 0, 100);?></p>
			
						<!-- Prints the issue related to each mission -->
	    				<?php foreach($missionIssues as $mi): 
		    				if($e['Mission']['id'] == $mi['Mission']['id']):?>
		    				<div class="row">
							  <div class="large-10 columns">
							  <?php echo $this->Html->link($e['User']['name'], array('controller' => 'users', 'action' => 'dashboard', $e['User']['id']));
							  echo ' | '.$mi['Issue']['name'].' | '.date('F j, Y', strtotime($e['Evidence']['created'])); ?></div>
							  <div class="large-2 columns"><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;<?php echo count($e['Comment']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</div>
							</div> 
		    				<?php break; endif;
	    				endforeach;?>

		    		<hr class="sexy_line" />
		    	<?php endforeach; ?>
			  </div>
			  <div class="content" id="panel2-2">
			  </div>
			  <div class="content" id="panel2-3">
			  </div>
			</div>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel12-1"><?php echo __('Issues');?></a></dd>
			  <dd><a href="#panel12-2"><?php echo __('All Missions');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel12-1">

			  <!-- Lists all issues -->
		    	<h2><?php if(isset($missionIssue[0])) echo __('Missions under Issue: ').$missionIssue[0]['Issue']['name']; else echo sprintf(__('No missions under issue %s'), $issue['Issue']['name']); ?></h2>
		    	
		    	<?php foreach($missionIssue as $mi): ?>
		    		<h3><?php echo $this->Html->link($mi['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $mi['Mission']['id'], 1));?></h3>
		    		<p><?php echo $mi['Mission']['description']; ?></p>
		    	<?php endforeach; ?>

	    		<!-- Button redirects to listing mission issues page -->
				</br><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?>" class = "button"><?php echo __('Go back to Issues');?></a>
				<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class = "button"><?php echo __('See All Missions');?></a>

			  </div>

			  <div class="content" id="panel12-2">

			  <!-- Lists maximum 5 missions -->
			    <?php foreach($missions as $m):?>
			    	<div class = "dashboard-missions">
		    			<?php echo $this->Html->link($m['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1));?>
		    			<p><?php echo $m['Mission']['description']; ?></p>
		    		</div>
	    		<?php endforeach; ?>

	    		<!-- Button redirects to listing mission page -->
	    		</br><a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class = "button"><?php echo __('See All Missions');?></a>

			  </div>
			</div>

		</div>
	</div>
</section>