<?php echo $this->element('header', array("userid" => $userid, "username" => $username[0])); ?>

<section class="evoke margin top-2">
	<div class="row dashboard">
		<div class="medium-9 columns">
			<h1><?php echo __('Dashboard');?></h1>

			<nav class="breadcrumbs dashboard_breadcrumbs">
			  <a class="unavailable" href="#"><?php echo __('Dashboard ');?></a>
			  <?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?>
			  <a class="current" href="#"><?php if($missionissue) echo __('Issue: ').$missionissue[0]['Issue']['name']; else echo __('Issue: ').$issue['Issue']['name'];?></a>
			</nav>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Projects and Evidences I Follow');?></a></dd>
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
	    				<?php foreach($missionissues as $mi): 
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
		    	<h2><?php if(isset($missionissue[0])) echo __('Missions under Issue: ').$missionissue[0]['Issue']['name']; else echo sprintf(__('No missions under issue %s'), $issue['Issue']['name']); ?></h2>
		    	
		    	<?php foreach($missionissue as $mi): ?>
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