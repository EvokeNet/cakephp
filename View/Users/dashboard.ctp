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
				<a href="#"><?= __('Settings') ?></a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
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
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Follow this agent');?></a>
			<?php elseif($is_friend AND ($users['User']['id'] != $user['User']['id'])): ?>
				<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $users['User']['id'], $user['User']['id'])); ?>" class = "button"><?php echo __('Unfollow this agent');?></a>
			<?php endif; ?>

			<img src = '/evoke/webroot/img/horizontal_bar.png' class = "evoke horizontal_bar">
			<div class = "evoke titles"><h4><?php echo __('CHOOSE A MISSION');?></h4></div>

			<div class="wrapper">
	            <div class="jcarousel-wrapper">

	            	<div class="row">
					  <div class="small-9 large-centered columns">
					  	<div class="jcarousel">
		                    <ul>
		                        <?php foreach($missions as $m):?>
		                        	<li>
		                        		<img src="/evoke/webroot/img/evoke_folder.png" alt="Image 1"/>
		                        		<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1));?>"><?php echo $m['Mission']['title'];?></a>
		                        	</li>
					    		<?php endforeach; ?>
		                    </ul>
		                </div>
					  </div>
					</div>
	                
        			<div class="row">
					  	<div class="small-11 large-centered columns">
					  		<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
        					<a href="#" class="jcarousel-control-next">&rsaquo;</a>
					  		<img src="/evoke/webroot/img/shelve150.png" alt="Image 1">
						</div>
					</div>
	                <!-- <p class="jcarousel-pagination"></p> -->
	            </div>
	            
	        </div>

	        <!-- <div id="scrollbar1"><div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
	            <div class="viewport">
	                 <div class="overview">
	                    <h3>Magnis dis parturient montes</h3>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae velit at velit pretium sodales. Maecenas egestas imperdiet mauris, vel elementum turpis iaculis eu. Duis egestas augue quis ante ornare eu tincidunt magna interdum. Vestibulum posuere risus non ipsum sollicitudin quis viverra ante feugiat. Pellentesque non faucibus lorem. Nunc tincidunt diam nec risus ornare quis porttitor enim pretium. Ut adipiscing tempor massa, a ullamcorper massa bibendum at. Suspendisse potenti. In vestibulum enim orci, nec consequat turpis. Suspendisse sit amet tellus a quam volutpat porta. Mauris ornare augue ut diam tincidunt elementum. Vivamus commodo dapibus est, a gravida lorem pharetra eu. Maecenas ultrices cursus tellus sed congue. Cras nec nulla erat.</p>

	                    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eget mauris libero. Nulla sit amet felis in sem posuere laoreet ut quis elit. Aenean mauris massa, pretium non bibendum eget, elementum sed nibh. Nulla ac felis et purus adipiscing rutrum. Pellentesque a bibendum sapien. Vivamus erat quam, gravida sed ultricies ac, scelerisque sed velit. Integer mollis urna sit amet ligula aliquam ac sodales arcu euismod. Fusce fermentum augue in nulla cursus non fermentum lorem semper. Quisque eu auctor lacus. Donec justo justo, mollis vel tempor vitae, consequat eget velit.</p>

	                    <p>Vivamus sed tellus quis orci dignissim scelerisque nec vitae est. Duis et elit ipsum. Aliquam pharetra auctor felis tempus tempor. Vivamus turpis dui, sollicitudin eget rhoncus in, luctus vel felis. Curabitur ultricies dictum justo at luctus. Nullam et quam et massa eleifend sollicitudin. Nulla mauris purus, sagittis id egestas eu, pellentesque et mi. Donec bibendum cursus nisi eget consequat. Nunc sit amet commodo metus. Integer consectetur lacus ac libero adipiscing ut tristique est viverra. Maecenas quam nibh, molestie nec pretium interdum, porta vitae magna. Maecenas at ligula eget neque imperdiet faucibus malesuada sed ipsum. Nulla auctor ligula sed nisl adipiscing vulputate. Curabitur ut ligula sed velit pharetra fringilla. Cras eu luctus est. Aliquam ac urna dui, eu rhoncus nibh. Nam id leo nisi, vel viverra nunc. Duis egestas pellentesque lectus, a placerat dolor egestas in. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec vitae ipsum non est iaculis suscipit.</p>

	                    <h3>Adipiscing risus </h3>
	                    <p>Quisque vel felis ligula. Cras viverra sapien auctor ante porta a tincidunt quam pulvinar. Nunc facilisis, enim id volutpat sodales, leo ipsum accumsan diam, eu adipiscing risus nisi eu quam. Ut in tortor vitae elit condimentum posuere vel et erat. Duis at fringilla dolor. Vivamus sem tellus, porttitor non imperdiet et, rutrum id nisl. Nunc semper facilisis porta. Curabitur ornare metus nec sapien molestie in mattis lorem ullamcorper. Ut congue, purus ac suscipit suscipit, magna diam sodales metus, tincidunt imperdiet diam odio non diam. Ut mollis lobortis vulputate. Nam tortor tortor, dictum sit amet porttitor sit amet, faucibus eu sem. Curabitur aliquam nisl sed est semper a fringilla velit porta. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum in sapien id nulla volutpat sodales ac bibendum magna. Cras sollicitudin, massa at sodales sodales, lacus tortor vestibulum massa, eu consequat dui nulla et ipsum.</p>

	                    <p>Aliquam accumsan aliquam urna, id vulputate ante posuere eu. Nullam pretium convallis tincidunt. Duis vitae odio arcu, ut fringilla enim. Nam ante eros, vestibulum sit amet rhoncus et, vehicula quis tellus. Curabitur sed iaculis odio. Praesent vitae ligula id tortor ornare luctus. Integer placerat urna non ligula sollicitudin vestibulum. Nunc vestibulum auctor massa, at varius nibh scelerisque eget. Aliquam convallis, nunc non laoreet mollis, neque est mattis nisl, nec accumsan velit nunc ut arcu. Donec quis est mauris, eu auctor nulla. Fusce leo diam, tempus a varius sit amet, auctor ac metus. Nam turpis nulla, fermentum in rhoncus et, auctor id sem. Aliquam id libero eu neque elementum lobortis nec et odio.</p>
	                </div>
	            </div>
	        </div> -->

			<img src = '/evoke/webroot/img/horizontal_bar.png' class = "evoke horizontal_bar">
			<dl class="tabs evoke titles" data-tab>
			  <dd><h4><?php echo __('EVOKE PANEL');?></h4></dd>
			  <dd class="active"><a href="#panel2-1"><?php echo __('All Projects and Evidences');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('Projects I Follow');?></a></dd>
			  <dd><a href="#panel2-3"><?php echo __('My Projects');?></a></dd>
			</dl>

			<!-- <img src = '/evoke/webroot/img/horizontal_bar.png' alt = "" style = "margin-bottom: -75px; margin-left: -15px;"> -->
			<div class="evoke tabs-content screen-box panel">
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

		    		<div class="row evoke evidence-list">
					  <div class="evoke large-2 columns"><h6><?php echo $this->Html->link($e['Group']['title'], array('controller' => 'groups', 'action' => 'view', $e['Group']['id'])); ?></h6></div>

					  <div class="evoke large-8 columns">
					  	<h2><?php echo $this->Html->link($e['Evokation']['title'], array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?></h2>
					  	<p><?php echo substr($e['Evokation']['abstract'], 0, 100);?></p>
				  		</div>
					  
					  <div class="evoke large-2 columns">

					  <ul>
					  <li><i class="fa fa-comment-o fa-horizontal fa-lg"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o fa-lg"></i>&nbsp;</li>
					  <li><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general"><?php echo __('Follow');?></a></li>
	    				</ul>

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

			<img src = '/evoke/webroot/img/horizontal_bar.png' class = "evoke horizontal_bar">
			<div class = "evoke titles"><h4><?php echo __('LEADERCLOUD');?></h4></div>
			<div class="evoke tabs-content screen-box leadercloud">

			</div>

		</div>
		<div class="medium-3 columns">
			
			<div class = "evoke dashboard text-align"><img src = '/evoke/webroot/img/agentag120.png' alt = ""/></div>
			
			<!-- <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ"/> -->
			<!-- <img src = '../img/agent_tag.png' alt = "" class = "tag"/>
			
			<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQkcXs-qFPpoDX2Yh7A6IMRtoNvLRa-Fj_MKaIBal92xgo--7DDyQ" class = "agent-picture" />
			<h5>Agent</h5> -->

			<!-- <div style = "position:relative">
				<div class = "evoke dashboard text-align"><h4 class = "evoke titles"><?php echo __('ALLIES');?> See all</h4></div>
				<div class = "evoke dashboard text-align vertical_bar"><img src = '/evoke/webroot/img/hb.png'/></div>
				<div class = "evoke screen-box allies"></div>
				<div class = "evoke dashboard text-align"><img src = '/evoke/webroot/img/hb.png' style = "bottom:0; position: absolute;
max-height: 100%;"/></div>
				<div class = "evoke dashboard text-align"><h4 class = "evoke titles"><?php echo __('FEED');?> See all</h4></div>
			</div>
			 -->
			
			<div>
			<div style = "position:relative">
				<div class = "evoke dashboard text-align"><h4 class = "evoke titles"><?php echo __('ALLIES');?> See all</h4></div>
				<div class = "evoke dashboard text-align vertical_bar"><img src = '/evoke/webroot/img/hb.png' class= "top-height"/></div>
				<div class = "evoke screen-box allies"></div>

			</div>
			
			<div style = "position:relative">
				<div class = "evoke dashboard text-align"><h4 class = "evoke titles"><?php echo __('FEED');?> See all</h4></div>
				<div class = "evoke dashboard text-align vertical_bar"><img src = '/evoke/webroot/img/hb.png' class= "top-height-two"/></div>
				<div class = "evoke screen-box allies"></div>
			</div>

			<div style = "position:relative">
				<div class = "evoke dashboard text-align"><h4 class = "evoke titles"><?php echo __('BADGES');?> See all</h4></div>
				<div class = "evoke dashboard text-align vertical_bar"><img src = '/evoke/webroot/img/hb.png' class= "top-height-two"/></div>
				<div class = "evoke screen-box allies"></div>
			</div>

			<div style = "position:relative">
				<img src = '/evoke/webroot/img/hb.png'/>
			</div>
			</div>

			
			

			<!-- <div style = "position:relative">
				<div class = "evoke dashboard text-align"><h4 class = "evoke titles"><?php echo __('BADGES');?> See all</h4></div>
				<div><img src = '/evoke/webroot/img/bar.png'/></div>
				<div class = "evoke screen-box allies"></div>
			</div> -->
		
			<!-- <img src = '/evoke/webroot/img/bar.png' alt = "" style = "position: absolute; left: 45%;"/>
			<div class = "evoke titles"><h4><?php echo __('FEED');?></h4></div><div class = "evoke screen-box feed"></div>
			<img src = '/evoke/webroot/img/bar.png' alt = "" style = "margin-top: -100px; position: absolute; left: 45%;"/>
			<div class = "evoke titles"><h4><?php echo __('BADGES');?></h4></div></h4><div class = "evoke screen-box badges"></div>
			<div><img src = '/evoke/webroot/img/bar.png' alt = "" style = "position: relative; left: 45%; margin: -70px 0px -20px 0px;"/></div>
			<div><img src = '/evoke/webroot/img/parabolic.png' alt = "" style = "position: absolute; left: 35%; margin: -335px 0px 0px 0px;"/></div>
			 -->
		</div>
	</div>
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