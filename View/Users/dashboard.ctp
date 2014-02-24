<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>
<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
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

<section class="evoke dashboard padding top-2">
	<div class="row evoke-max-width">
		<div class="medium-9 columns">
			<h1><?php echo __('Dashboard');?></h1>

			<nav class="breadcrumbs">
			  <a class="unavailable" href="#"><?php echo __('Dashboard ');?></a>
			  <a class="current" href="#"><?php echo $user['User']['name'];?></a>
			</nav>

			<?php if(!$is_friend AND ($users['User']['id'] != $user['User']['id'])):?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Follow this user');?></a>
			<?php elseif($is_friend AND ($users['User']['id'] != $user['User']['id'])): ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Unfollow this user');?></a>
			<?php endif; ?>

			<dl class="tabs evoke" data-tab>
			  <dd class="active"><a href="#panel12-1"><?php echo __('Issues');?></a></dd>
			  <dd><a href="#panel12-2"><?php echo __('All Missions');?></a></dd>
			</dl>
			<div class="evoke tabs-content">
			  <div class="content active" id="panel12-1">

					<div class="wrapper">
			            <h1>Responsive Carousel</h1>
			            

			            <p>This example shows how to implement a responsive carousel. Resize the browser window to see the effect.</p>

			            <div class="jcarousel-wrapper">
			                <div class="jcarousel">
			                    <ul>
			                        <li><img src="../img/folder.png" alt="Image 1"></li>
			                        <li><img src="../img/folder.png" alt="Image 1"></li>
			                        <li><img src="../img/folder.png" alt="Image 1"></li>
			                        <li><img src="../img/folder.png" alt="Image 1"></li>
			                        <li><img src="../img/folder.png" alt="Image 1"></li>
			                        <li><img src="../img/folder.png" alt="Image 1"></li>
			                    </ul>
			                </div>

			                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
			                <a href="#" class="jcarousel-control-next">&rsaquo;</a>

			                <!-- <p class="jcarousel-pagination"></p> -->
			            </div>
			        </div>
			        
		            <!-- <div class="evoke jcarousel-wrapper">
		                <div class="jcarousel">
		                    <ul>
		                        <li><img src="../img/folder.png" alt="Image 1"></li>
		                        <li><img src="../img/folder.png" alt="Image 2"></li>
		                        <li><img src="../img/folder.png" alt="Image 3"></li>
		                        <li><img src="../img/folder.png" alt="Image 4"></li>
		                        <li><img src="../img/folder.png" alt="Image 5"></li>
		                        <li><img src="../img/folder.png" alt="Image 6"></li>
		                    </ul>
		                </div>

		                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
		                <a href="#" class="jcarousel-control-next">&rsaquo;</a>

		            </div> -->
		            <!-- <img src="../img/shelves.png" alt="Image 1"> -->

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
	    		<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class = "button"><?php echo __('See All Missions');?></a>

			  </div>
			</div>

			<dl class="tabs evoke" data-tab>
			  <dd>Evoke Panel</dd>
			  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Projects I Follow');?></a></dd>
			  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd>
			</dl>
			<div class="evoke tabs-content screen-box">
			  <div class="content active" id="panel2-1">
		    	<?php 
		    		//Lists all projects and evidences
		    		foreach($evidence as $e): ?>

		    		<div class="row evoke evidence-list">
					  <div class="evoke large-2 columns"><h6><?php echo $this->Html->link($e['User']['name'], array('controller' => 'users', 'action' => 'dashboard', $e['User']['id']));?></h6></div>
					  <div class="evoke large-8 columns"><h2><?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?></h2></div>
					  
					  <div class="evoke large-2 columns">

					  	<?php foreach($missionIssues as $mi): 
		    				if($e['Mission']['id'] == $mi['Mission']['id']):?>

		    				<ul>
			    				<li><i class="fa fa-comment-o fa-horizontal fa-lg"></i>&nbsp;<?php echo count($e['Comment']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</li>
			    				<li><?php echo $mi['Issue']['name']; ?></li>
			    				<li><?php echo date('F j, Y', strtotime($e['Evidence']['created'])); ?></li>
		    				</ul>
							
	    				<?php break; endif; endforeach;?>

					  </div>
					</div>

		    	<?php endforeach; 

		    		foreach($evokations as $e):?>
		    			<h4><?php echo $this->Html->link($e['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?></h4>
			    		<p><?php echo substr($e['Evokation']['abstract'], 0, 100);?></p>
			    		
			    		<div class="row">
						  <div class="large-10 columns">
						  <?php echo $this->Html->link($e['Group']['title'], array('controller' => 'groups', 'action' => 'view', $e['Group']['id'])).' | Issue | '. date('F j, Y', strtotime($e['Evokation']['created'])); ?></div>
						  <!-- <div class="large-2 columns"><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;<?php //echo count($e['Comment']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</div> -->
						  <a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "button"><?php echo __('Follow');?></a>
						</div>

						<!-- <hr class="sexy_line" /> -->

		    	<?php endforeach;?>
			  </div>
			  <div class="content" id="panel2-2">
	    		<?php 
		    		foreach($evokationsFollowing as $e):?>
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

						<hr class="sexy_line" />

		    	<?php endforeach;?>
			  </div>
			</div>

		</div>
		<div class="medium-3 columns">
			
			<div class = "evoke agent-tag">
				<!-- <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ"/> -->
				<!-- <img src = '../img/agent_tag.png' alt = "" class = "tag"/>
				
				<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ" class = "agent-picture" />
				<h5>Agent</h5> -->

			</div>
			<div class = "evoke agent-tag">
				<!-- <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ"/> -->
				<!-- <img src = '../img/agent_tag.png' alt = "" class = "tag"/>
				
				<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ" class = "agent-picture" />
				<h5>Agent</h5> -->

			</div>
			<div class = "evoke agent-tag">
				<!-- <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ"/> -->
				<!-- <img src = '../img/agent_tag.png' alt = "" class = "tag"/>
				
				<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ" class = "agent-picture" />
				<h5>Agent</h5> -->

			</div>	
		</div>
	</div>
</section>

<script>
$('.jcarousel').jcarousel('scroll', '3');
</script>
