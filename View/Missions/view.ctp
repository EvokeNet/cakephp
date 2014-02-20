<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo __('Agent ').$username[0]; ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $userid)); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $userid)); ?></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke margin top-2">
	<div class="row">
	  <div class="small-11 small-centered columns">

	  	<h1><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h1>
		<h2><?php echo __('Mission Brief'); ?></h2>
		<h4><?php echo h($mission['Mission']['description']); ?></h4>

		<h2><?php echo __('Quests: '); echo h($mission['Mission']['title']); ?></h2>

		<?php foreach ($mission['Quest'] as $quest): ?>

			<div class = "missionblock"><a href="" data-reveal-id="<?= $quest['id'] ?>" data-reveal><?php echo $quest['title'];?></a></div>

			<div id="<?= $quest['id'] ?>" class="reveal-modal small" data-reveal>
			  <h2><?php echo $quest['title'];?></h2>
			  <p class="lead"><?php echo $quest['description'];?></p>
			  <!-- <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
			  <a class="close-reveal-modal">&#215;</a>
			</div>

		<?php endforeach; ?>

		<div class="row">
		  <div class="medium-9 columns">
		  	<h2><?php echo __('Discussions: ').$mission['Mission']['title']; ?></h2>

			<dl class="tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('Most Voted');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Most Recent');?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">
			    <button><?php echo $this->Html->link(__('Add Discussion'), array('controller' => 'evidences', 'action' => 'add')); ?></button>
			  </div>
			  <div class="content" id="panel2-2">
			    	<?php
			    		foreach($evidences as $e):?>
				    		<h4><?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?></h4>
				    		<p><?php echo substr($e['Evidence']['content'], 0, 200);?></p>
				
							<!-- Prints the issue related to each mission -->
		    				<?php foreach($missionIssues as $mi): 
			    				if($e['Mission']['id'] == $mi['Mission']['id']):?>
			    				<div class="row">
								  <div class="large-8 columns">
								  <?php echo $this->Html->link($e['User']['name'], array('controller' => 'users', 'action' => 'dashboard', $e['User']['id']));
								  echo ' | '.$mi['Issue']['name'].' | '.date('F j, Y', strtotime($e['Evidence']['created'])); ?></div>
								  <div class="large-4 columns"><?php echo count($e['Comment']);?></div>
								</div> 
			    				<?php break; endif;
		    				endforeach;?>
		    		
		    		<hr class="sexy_line" />
		    	<?php endforeach; ?>
				<button><?php echo $this->Html->link(__('Add Discussion'), array('controller' => 'evidences', 'action' => 'add')); ?></button>
			  </div>
			</div>
		  </div>
		  <div class="medium-3 columns">
		  	<h2><?php echo __('To-do list');?></h2>
		  	<ul>
				<li><i class="fa fa-square-o"></i>&nbsp;&nbsp;Acitivty 1</li>
		  		<li><i class="fa fa-square-o"></i>&nbsp;&nbsp;Activity 2</li>
		  		<li><i class="fa fa-square-o"></i>&nbsp;&nbsp;Activity 3</li>
		  	</ul>
		  	<button><?php echo $this->Html->link(__('Go to Imagine ->'), array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id']));?></button>
		  </div>
		</div>

	  </div>
	</div>
</section>
