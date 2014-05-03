<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('mycarousel');
	//echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);

	echo $this->element('header', array('user' => $users, 'sumMyPoints' => $sumMyPoints));


	$this->end(); 
?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns padding top-2">
		<?php echo $this->element('menu', array('user' => $users));?>

	  </div>

	  <div class="small-6 medium-6 large-6 columns padding top-2">
	  	<h3> <?= strtoupper(__('Choose a mission')) ?> </h3>
	  	  <div id="pattern" class="pattern">
  	<div class="c">
			<div class="c-list-container">
				<ul class="c-list">

					<?php foreach($missions as $mission): ?>
						<div class = "evoke dashboard missions">
							<?php if(!is_null($mission['Mission']['cover_dir'])) :?>
								<li>
									<a href="#">
										<img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>">
										<!-- <div class="summary">
											<h2>This is the first title</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget lacus erat, sit amet tempor nibh. Aliquam erat volutpat. Nulla et porta tortor. </p>
										</div> -->
									</a>
								</li>
								
			                <?php else :?>

								<li>
									<a href="#">
										<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
										<!-- <div class="summary">
											<h2>This is the first title</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget lacus erat, sit amet tempor nibh. Aliquam erat volutpat. Nulla et porta tortor. </p>
										</div> -->
									</a>
								</li>

			                <?php endif ?>
						</div>
					<?php endforeach; ?>
					
				</ul>
			</div>
			<nav class="c-nav">
				<a href="#" class="prev"><i class="fa fa-arrow-circle-o-left fa-2x"></i></a>
				<a href="#" class="next"><i class="fa fa-arrow-circle-o-right fa-2x"></i></a>
			</nav>
		</div>
		
	</div>

	  	<h3> <?= strtoupper(__('Evidence/Project Stream')) ?> </h3>

	  	<dl class="default tabs" data-tab>
		  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('All Evidence')) ?></a></dd>
		  <dd><a href="#panel2-2"><?= strtoupper(__('Projects I Follow')) ?></a></dd>
		  <dd><a href="#panel2-3"><?= strtoupper(__('My Projects')) ?></a></dd>
		</dl>
		<div class="evoke content-block default tabs-content">
		  <div class="content active" id="panel2-1">
		    
		    <?php 
	    		//Lists all projects and evidences
	    		foreach($evidence as $e): 
    				//echo $this->element('evidence_blue_box', array('e' => $e)); 
    				//echo $this->element('evidence_box', array('e' => $e)); 
    				echo $this->element('evidence', array('e' => $e)); 
	    		endforeach; 


	    		foreach($evokations as $e):
	    			$showFollowButton = true;
	    			foreach($myEvokations as $my)
	    				if(array_search($my['Evokation']['id'], $e['Evokation'])) {
	    					$showFollowButton = false;
	    					break;
	    				}
	    			if($showFollowButton) 
	    				echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
	    			else
	    				echo $this->element('evokation_box', array('e' => $e, 'mine' => true));
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
	    			echo $this->element('evokation_box', array('e' => $e, 'mine' => true));
	    		endforeach;
	    	?>
		  </div>
		</div>

	  </div>

	  <div class="small-3 medium-3 large-3 columns padding top-2">
	  	
	  	<h3> <?= strtoupper(__('Feed')) ?> </h3>
	  	<div class = "evoke content-block padding-10">
	  		
	  		<?php if(!$notifies): ?>

				<img src = '<?= $this->webroot.'img/placeholders-feed.png' ?>' style = "width: 100%; max-height: 100%;">
				<!-- <h1><?= strtoupper(__('You have no allies at the moment')) ?></h1> -->

			<?php else: ?>

			<ul>
				<?php foreach($notifies as $n): 

				if($n['Notification']['origin'] == 'evidence'):?>						
					<li><a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s posted an evidence'), $n['User']['name']) ?></li></a>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'BasicTraining'):?>						
					<li><?= sprintf(__('Agent %s finished the Basic Training'), $n['User']['name']) ?></li>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'userUpdate'):?>						
					<li><a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $n['User']['id'])) ?>"><?= sprintf(__('Agent %s updated its profile'), $n['User']['name']) ?></a></li>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'like'):?>						
					<!-- <li><a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s liked an evidence from '), $n['User']['name']) ?></a></li> -->
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'like'):
				
					foreach($allusers as $alluser):
						if($n['Notification']['action_user_id'] == $alluser['User']['id']){
							$action_user = $alluser;
							break;
						}
					endforeach;

					if($action_user['User']['id'] == $users['User']['id']){
						$message = sprintf(__('You liked an evidence Agent %s posted'), $n['User']['name']);
					} else{
						$message = sprintf(__('Agent %s liked an evidence from Agent %s'), $action_user['User']['name'], $n['User']['name']);
					}
					?>						
					<li><a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= $message ?></a></li>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'commentEvidence'):?>						
					<li><a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s commented an evidence'), $n['User']['name']) ?></a></li>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'phaseCompleted'):?>						
					<!-- <li><?= sprintf(__('Agent %s completed a phase'), $n['User']['name']) ?></li> -->
				<?php endif; ?>
				
				<?php endforeach; ?>
			</ul>

			<?php endif; ?>

	  	</div>

	  	<h3> <?= strtoupper(__('Discussions')) ?> </h3>
	  	<div class = "evoke content-block padding-10">
	  		YAY
	  	</div>

	  </div>

	  <div class="medium-1 end columns"></div>

	</div>

</section>

<?php

	echo $this->Html->script('mycarousel', array('inline' => false));

?>