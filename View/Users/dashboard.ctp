<?php echo $this->element('header', array("userid" => $userid, "username" => $username[0])); ?>

<section class="evoke margin top-2">
	<div class="row">
		<div class="medium-9 columns">
			<h1><?php echo __('Dashboard');?></h1>

			<nav class="breadcrumbs">
			  <a class="unavailable" href="#"><?php echo __('Dashboard ');?></a>
			  <a class="current" href="#"><?php echo $user['User']['name'];?></a>
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
			    		<p><?php echo substr($e['Evidence']['content'], 0, 90);?></p>
			
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

		    	<?php endforeach; 

		    		foreach($evokations as $e):?>
		    			<h4><?php echo $this->Html->link($e['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?></h4>
			    		<p><?php echo substr($e['Evokation']['abstract'], 0, 100);?></p>
			    		
			    		<div class="row">
						  <div class="large-10 columns">
						  <?php echo $this->Html->link($e['Group']['title'], array('controller' => 'groups', 'action' => 'view', $e['Group']['id'])).' | Issue | '. date('F j, Y', strtotime($e['Evokation']['created'])); ?></div>
						  <div class="large-2 columns"><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;<?php //echo count($e['Comment']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</div>
						</div>

						<hr class="sexy_line" />

		    	<?php endforeach;?>
			  </div>
			  <div class="content" id="panel2-2">
			  </div>
			  <div class="content" id="panel2-3">
			  </div>
			</div>

			<h2><?php echo __('Choose a Mission');?></h2>
			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel12-1"><?php echo __('Issues');?></a></dd>
			  <dd><a href="#panel12-2"><?php echo __('All Missions');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel12-1">

			  <!-- Lists all issues -->
		    	<?php foreach($issues as $i):?>
		    		<div>
		    		<?php echo $this->Html->link($i['Issue']['name'], array('controller' => 'users', 'action' => 'dashboardByIssue', $user['User']['id'], $i['Issue']['id']));?></div>
	    		<?php endforeach; ?>

	    		<!-- Button redirects to listing mission issues page -->
	    		</br><a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class = "button"><?php echo __('See All Issues');?></a>

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