<?php

	echo $this->Html->css('jcarousel');
	echo $this->Html->css('sticky_note');
	echo $this->Html->css('ribbon');

	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $user['User']['name']; ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#"><?= __('Settings') ?></a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background padding top-2">
	<div class = "evoke missions data">
  		<h1><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h1>
	</div>
	<div class="row full-width">
		  <div class="large-6 columns">
		  	<div class = "evoke evokation-pink-border full-width">
			  	<?php foreach($evokations as $e):?>
					<div class="row full-width evoke mission evokation adjust-row">
			  			
			  			<div class="medium-2 columns">

			  				<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" width="110px"/>
						  		
						  	<div class = "evoke text-align">
					  			<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
									<h6><?= $e['Group']['title']?></h6>
								</a>
							</div>
							
						</div>

						<div class="medium-7 columns">
							<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>"><h1>
							<?= $e['Evokation']['title']?></h1></a>
						</div>
						<div class="medium-3 columns">
							
							<div class = "evoke text-align">
								<div class = "evoke evidence-icons"><i class="fa fa-comment-o fa-horizontal fa-lg"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</div>
								<a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general"><?php echo __('Follow');?></a>
		    				</div>

						</div>
					</div>
				<?php endforeach;?>
			</div>
		  </div>
		  <div class="large-6 columns">
		  	
		  	<div class = "evoke evokation-green-border full-width">
			  	<?php foreach($evokations as $e):?>
					<div class="row full-width evoke mission evokation bg-red adjust-row">
			  			
			  			<div class="medium-2 columns">

			  				<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" width="110px"/>
						  		
						  	<div class = "evoke text-align">
						  		<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
									<h6><?= $e['Group']['title']?></h6>
								</a>
							</div>
							
						</div>

						<div class="medium-7 columns">
							<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
								<h1><?= $e['Evokation']['title']?></h1>
							</a>
						</div>
						<div class="medium-3 columns">
							
							<div class = "evoke text-align">
								<div class = "evoke evidence-icons social">
									<i class="fa fa-facebook-square fa-lg"></i>&nbsp;
									<i class="fa fa-google-plus-square fa-lg"></i>&nbsp;
									<i class="fa fa-twitter-square fa-lg"></i>
								</div>
								<a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general green"><?php echo __('View this project');?></a>
		    				</div>

						</div>
					</div>
				<?php endforeach;?>
			</div>

		  </div>
	</div>

	<div class = "evoke position">
		<img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke horizontal_bar left">
		<div class = "evoke titles"><h4><?php echo strtoupper(__('Mission Activities'));?></h4></div>
	</div>

	<div class="jcarousel-wrapper carousel-width">

    	<div class="row full-width">
		  <div class="small-11 large-centered columns">
		  	<div class="jcarousel sticky">
                <ul>
                    <?php foreach ($quests as $q): ?>

						<li>
							<div class = "missionblock" style = "text-align: center;">
								<a href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
								<span><?php echo $q['Quest']['title'];?></span>
								</a>
							</div>
						</li>

						<div id="<?= $q['Quest']['id'] ?>" class="reveal-modal small" data-reveal>
						  <?= $this->element('quest', array('q' => $q, 'questionnaires' => $questionnaires, 'answers' => $answers))?>
						  <a class="close-reveal-modal">&#215;</a>
						</div>

					<?php endforeach; ?>
                </ul>
            </div>
		  </div>
		</div>
        
		<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
		<a href="#" class="jcarousel-control-next">&rsaquo;</a>

    </div>

    <div class="row full-width">
	  <div class="large-8 columns">
	  	<div class = "evoke position">
			<img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke horizontal_bar left">
			<dl class="tabs evoke titles" data-tab>
				  <dd><h4><?php echo strtoupper(__('Discussions'));?></h4></dd>
				  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('Most Voted'))?></a></dd>
				  <dd><a href="#panel2-2"><?= strtoupper(__('Most Recent'))?></a></dd>
			</dl>

			<div class="evoke tabs-content screen-box dashboard panel">
			  <div class="content active" id="panel2-1">
				<?php
					foreach($evokations as $e):?>

			    		<div class="row evoke evidence">
							<div class="medium-2 columns">
						  		<div class = "evoke dashboard text-align">
						  			<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" width="110px"/>
						  			

						  			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
									<h6><?= $e['Group']['title']?></h6>
									</a>

					  			</div>
				  			</div>
							<div class="medium-8 columns">

								<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
								<h1><?= $e['Evokation']['title']?></h1>
								</a>

							</div>

							<div class="medium-2 columns">
								<div>
									<ul>
								  		<li><i class="fa fa-comment-o fa-horizontal fa-lg"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</li>
								  		<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general"><?php echo __('Follow');?></a></div></li>
				    				</ul>
								</div>
							</div>	
						</div>

			    	<?php endforeach;?>
			  </div>
			  <div class="content" id="panel2-2">
			  </div>
			</div>
		</div>
	  </div>
	  <div class="large-4 columns">
	  		

		<div class = "evoke position" style = "margin: 0px 1%;">
			<img src = '<?= $this->webroot.'img/espiral.png' ?>' style = " width: 100%;">
			<div class = "evoke todo-list">
				<div class = "evoke todo-list content">
					<h1><?= strtoupper(__('To-Do List')) ?></h1>
					<ul>
	                    <?php foreach ($quests as $q): ?>

							<li><?php echo $q['Quest']['title'];?></li>

						<?php endforeach; ?>
	                </ul>
                </div>
			</div>
			<!-- <img src = '/evoke/webroot/img/holdtwo.png' style = "position: absolute; top: 40%; right: -25px; width: 30%;"> -->
		</div>

	  </div>
	</div>

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