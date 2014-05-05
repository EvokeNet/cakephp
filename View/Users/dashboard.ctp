<?php

	echo $this->Html->css('mycarousel');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	// echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);

	echo $this->element('header', array('user' => $users, 'sumMyPoints' => $sumMyPoints));

	$this->end(); 
?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns">
	  	<?php echo $this->element('menu', array('user' => $users));?>
	  </div>

	  <div class="small-6 medium-6 large-6 columns padding top-2 maincolumn">
	  	<h3> <?= strtoupper(__('Choose a mission')) ?> </h3>
	  	  <div id="pattern" class="pattern">
  			<div class="c">
			<div class="c-list-container">
				<ul class="c-list">
					<div class = "evoke dashboard missions">
						<!-- if needed, show the basic training mission before all others -->
						<?php if (isset($basic_training)): ?>
	                		<?php if(!is_null($basic_training['Mission']['cover_dir'])) :?>
								<li>
									<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1))?>">

										<img src="<?= $this->webroot.'files/attachment/attachment/'.$basic_training['Mission']['cover_dir'].'/'.$basic_training['Mission']['cover_attachment'] ?>" style = "max-height: 130px; height: 130px;">
										<h1><?= $basic_training['Mission']['title'] ?> </h1>
										<!-- <div class="summary">
											<h2>This is the first title</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget lacus erat, sit amet tempor nibh. Aliquam erat volutpat. Nulla et porta tortor. </p>
										</div> -->
									</a>
								</li>
									
			                <?php else :?>
								<li>
									<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1))?>">
										<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>' style = "max-height: 130px; height: 130px;">
										<h1><?= $basic_training['Mission']['title'] ?> </h1>
										<!-- <div class="summary">
											<h2>This is the first title</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget lacus erat, sit amet tempor nibh. Aliquam erat volutpat. Nulla et porta tortor. </p>
										</div> -->
									</a>
								</li>

				            <?php endif ?>

	                		
	                	<?php endif;?>

						<?php foreach($missions as $mission): ?>
							
								<?php if(!is_null($mission['Mission']['cover_dir'])) :?>
									<li>
										<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], 1))?>">

											<img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>" style = "max-height: 130px; height: 130px;">
											<h1><?= $mission['Mission']['title'] ?> </h1>
											<!-- <div class="summary">
												<h2>This is the first title</h2>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget lacus erat, sit amet tempor nibh. Aliquam erat volutpat. Nulla et porta tortor. </p>
											</div> -->
										</a>
									</li>
									
				                <?php else :?>

									<li>
										<a href="<?= $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], 1))?>">
											<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>' style = "max-height: 130px; height: 130px;">
											<h1><?= $mission['Mission']['title'] ?> </h1>

											<!-- <div class="summary">
												<h2>This is the first title</h2>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget lacus erat, sit amet tempor nibh. Aliquam erat volutpat. Nulla et porta tortor. </p>
											</div> -->
										</a>
									</li>

				                <?php endif ?>
							
						<?php endforeach; ?>
					</div>
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
	    				echo $this->element('evokation', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
	    			else
	    				echo $this->element('evokation', array('e' => $e, 'mine' => true));
				endforeach;
			?>

		  </div>
		  <div class="content" id="panel2-2">
		    <?php 
		    	foreach($evokations as $e):
	    			foreach($evokationsFollowing as $following)
	    				if($e['Evokation']['id'] == $following['Evokation']['id']) {
	    					echo $this->element('evokation', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));		
	    				}
	    		endforeach;
	    	?>
		  </div>
		  <div class="content" id="panel2-3">
		    <?php 
	    		foreach($myEvokations as $e):
	    			echo $this->element('evokation', array('e' => $e, 'mine' => true));
	    		endforeach;
	    	?>
		  </div>
		</div>

	  </div>

	  <div class="small-3 medium-3 large-3 columns padding top-2 evoke no-left-padding no-right-padding">
	  	
	  	<h3> <?= strtoupper(__('Feed')) ?> </h3>
	  	<div class = "evoke content-block padding">
	  		
	  		<?php if(!$notifies): ?>

				<img src = '<?= $this->webroot.'img/placeholders-feed.png' ?>' style = "width: 100%; max-height: 100%;">
				<!-- <h1><?= strtoupper(__('You have no allies at the moment')) ?></h1> -->

			<?php else: ?>

			<ul>
				<?php foreach($notifies as $n): 

				if($n['Notification']['origin'] == 'evidence'):?>						
					<li>

						<?php if($n['User']['photo_attachment'] == null) : ?>
							<img src="https://graph.facebook.com/<?php echo $n['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
			  			<?php else : ?>
			  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
			  			<?php endif; ?>

					<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s posted an evidence'), $n['User']['name']) ?></a>

					</li>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'BasicTraining'):?>
					<li>

					<?php if($n['User']['photo_attachment'] == null) : ?>
						<img src="https://graph.facebook.com/<?php echo $n['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
		  			<?php else : ?>
		  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
		  			<?php endif; ?>

					<a href = "#"><?= sprintf(__('Agent %s finished the Basic Training'), $n['User']['name']) ?></a>
					</li>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'userUpdate'):?>						
					<li>
					<?php if($n['User']['photo_attachment'] == null) : ?>
						<img src="https://graph.facebook.com/<?php echo $n['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
		  			<?php else : ?>
		  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
		  			<?php endif; ?>	
					<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $n['User']['id'])) ?>"><?= sprintf(__('Agent %s updated its profile'), $n['User']['name']) ?></a></li>
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
					<li>
					<?php if($n['User']['photo_attachment'] == null) : ?>
						<img src="https://graph.facebook.com/<?php echo $n['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
		  			<?php else : ?>
		  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
		  			<?php endif; ?>
					<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= $message ?></a></li>
				<?php endif; ?>

				<?php if($n['Notification']['origin'] == 'commentEvidence'):?>						
					<li>
					<?php if($n['User']['photo_attachment'] == null) : ?>
						<img src="https://graph.facebook.com/<?php echo $n['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
		  			<?php else : ?>
		  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$n['User']['photo_dir'].'/'.$n['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
		  			<?php endif; ?>
					<a href = "<?= $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $n['Notification']['origin_id'])) ?>"><?= sprintf(__('Agent %s commented an evidence'), $n['User']['name']) ?></a></li>
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
	  	</div>

	  </div>

	  <div class="medium-1 end columns"></div>

	</div>

	<?php if ($show_basic_training): ?>
	<div id="formModal" class="reveal-modal evoke lightbox text-align" data-reveal style = "top: 370px;!important">
	  <img src = '<?= $this->webroot.'img/alchemy.png' ?>' style = "margin-top: -460px;"/>
	  <h2><?= sprintf(__("Agent %s, it's time to start your Basic Training"), $name[0]) ?></h2>
	  <p class="lead"><?= __('This training will show you the steps inside a missions so you can start being an agent of change') ?></p>
	  <a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $basic_training['Mission']['id'], 1)); ?>" class = "button general"><?php echo __("Let's get started!");?></a>
	  <a class="close-reveal-modal">&#215;</a>
	</div>
	<?php endif; ?>

</section>

<?php
	echo $this->Html->script('reveal_modal', array('inline' => false));
	echo $this->Html->script('mycarousel', array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
?>