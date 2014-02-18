<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Agent <?php echo $username[0]; ?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><a href="<?php echo $this->Html->url(array('action' => 'logout')); ?>">Sign out</a></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><a href="#">Dashboard</a></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>


<section class="evoke margin top-2">
	<div class="row">
		<div class="large-12 columns">
			<h1>Dashboard</h1>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Projects and Evidences I Follow');?></a></dd>
			  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
			    	<?php foreach($evidence as $e):?>
			    		<div class = "users_evidences">
				    		<?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>
				    		<p><?php echo substr($e['Evidence']['content'], 0, 200);?></p>
				
							<!-- Prints the issue related to each mission -->
		    				<?php foreach($missionissues as $mi): 
			    				if($e['Mission']['id'] == $mi['Mission']['id']):?>
			    				<div class="row">
								  <div class="large-8 columns"><?php echo $mi['Issue']['name']; echo ' | '.date('F j, Y', strtotime($e['Evidence']['created'])); ?></div>
								  <div class="large-4 columns"><?php echo count($e['Comment']);?></div>
								</div> 
			    				<?php break; endif;
		    				endforeach;?>

			    		</div>
			    		<hr class="sexy_line" />
			    	<?php endforeach; ?>
			  </div>
			  <div class="content" id="panel2-2">
			    <p>Second panel content goes here...</p>
			  </div>
			  <div class="content" id="panel2-3">
			    <?php foreach($evidence as $e): 
			    	if($userid == $e['Evidence']['user_id']):?>
			    		<div class = "users_evidences">
				    		<?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>
				    		<p><?php echo substr($e['Evidence']['content'], 0, 200);?></p>
				
							<!-- Prints the issue related to each mission -->
		    				<?php foreach($missionissues as $mi): 
			    				if($e['Mission']['id'] == $mi['Mission']['id']):?>
			    				<div class="row">
								  <div class="large-8 columns"><?php echo $mi['Issue']['name']; echo ' | '.date('F j, Y', strtotime($e['Evidence']['created'])); ?></div>
								  <div class="large-4 columns"><?php echo count($e['Comment']);?></div>
								</div> 
			    				<?php break; endif;
		    				endforeach;?>

			    		</div>
			    		<hr class="sexy_line" />
		    		<?php endif;
			    endforeach;
			    ?>
			  </div>
			</div>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel12-1"><?php echo __('Issues');?></a></dd>
			  <dd><a href="#panel12-2"><?php echo __('All Missions');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel12-1">

			  <!-- Lists all issues -->
		    	<?php foreach($issues as $i):?>
		    		<div><?php echo $i['Issue']['name']; ?></div>
	    		<?php endforeach; ?>

	    		<!-- Button redirects to listing mission issues page -->
	    		<div><button><?php echo $this->Html->link(__('See All Issues'), array('controller' => 'issues', 'action' => 'index'));?></button></div>

			  </div>

			  <div class="content" id="panel12-2">

			  <!-- Lists maximum 5 missions -->
			    <?php foreach($missions as $m):?>
			    	<div class = "users_missions">
		    			<?php echo $this->Html->link($m['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $m['Mission']['id']));?>
		    			<p><?php echo $m['Mission']['description']; ?></p>
		    		</div>
	    		<?php endforeach; ?>

	    		<!-- Button redirects to listing mission page -->
	    		<div><button><?php echo $this->Html->link(__('See All Missions'), array('controller' => 'missions', 'action' => 'index'));?></button></div>

			  </div>
			</div>

		</div>
	</div>
</section>

<script>
  $('#myTabs').on('toggled', function (event, tab) {
    console.log(tab);
  });

  $(document).on('before-height-change', function(){
  // do something before the height changes
});

$(document).on('after-height-change', function(){
  // do something after the height changes
});
</script>