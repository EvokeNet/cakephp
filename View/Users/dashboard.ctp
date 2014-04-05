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
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
	</ul>

	<section class="evoke dashboard top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>"><img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke top-bar icon"/></a></li>
			<li class="name">
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>" class = "evoke top-bar-name"><h1><?= sprintf(__('Hi %s'), $users['User']['name']) ?></h1></a>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background padding top-2">
	<div class="row full-width">
		<div class="medium-9 columns">

			<?php if(!$is_friend AND ($users['User']['id'] != $user['User']['id'])):?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Follow this agent');?></a>
			<?php elseif($is_friend AND ($users['User']['id'] != $user['User']['id'])): ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Unfollow this agent');?></a>
			<?php endif; ?>

			<?= $this->element('left_titlebar', array('title' => __('Choose a mission'))) ?>

			<div class = "evoke dashboard position">
	            <div class="jcarousel-wrapper">

	            	<div class="row">
					  <div class="small-9 large-centered columns">
					  	<div class="jcarousel">
		                    <ul>
		                        <?php foreach($missions as $m):?>
		                        	<li class = "evoke dashboard position">
		                        		<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1));?>">
			                        		<img src='<?= $this->webroot.'img/evoke_folder.png' ?>' width = "90%;"/>
			                        		<span class = "evoke dashboard folders"><?php echo $m['Mission']['title'];?></span>
			                        		<?php foreach ($imgs as $img) : ?>
			                        			<?php 
			                        				if($m['Mission']['id'] == $img['Attachment']['foreign_key'])
			                        					//echo '<span>TEM IMG</span>';
			                        			?>
			                        		<?php endforeach; ?>
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
				<div class="evoke tabs-content screen-box dashboard leadercloud margin"></div>
			</div>

		</div>

		<div class="medium-3 columns">

			<div class = "evoke dashboard tag">
				<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%"/>

				<div class="row">
					  <div class="small-4 columns"><a href = "https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large"><img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" class = "evoke dashboard user_pic"/></a></div>
					  <div class="small-8 columns">
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
							<h4 class = "display-inline"><?php echo __('Feed');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height-two"/></div>
					</div>
					<div class = "evoke screen-box feed"></div>
				</div>

				<div class = "evoke dashboard position">
					<div class = "evoke text-align">
						<div class = "evoke titles">
							<h4 class = "display-inline"><?php echo __('Badges');?></h4>
							<a href = "" class = "evoke button general"><?php echo __('See All');?></a>
						</div>

						<div class = "evoke dashboard vertical_bar"><img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class= "top-height-two"/></div>
					</div>
					<div class = "evoke screen-box badges"></div>
				</div>

				<div class = "evoke text-align position">
					<img src = '<?= $this->webroot.'img/vertical_bar.png' ?>' class = "badges_bar"/>
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
