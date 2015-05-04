<?php

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);

	echo $this->element('header', array('user' => $users));

	$this->end(); 
?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<!-- <div id="secondModal" class="reveal-modal" data-reveal>
	  <h2>This is a second modal.</h2>
	  <p>See? It just slides into place after the other first modal. Very handy when you need subsequent dialogs, or when a modal option impacts or requires another decision.</p>
	  <a class="close-reveal-modal">&#215;</a>
	</div> -->

	<div class="evoke default row full-width-alternate profile">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $users));?>
	  </div>

	  <div class="small-8 medium-8 large-8 columns maincolumn margin top-2">

	  	<h3 class = "margin bottom-1"><?= strtoupper(sprintf(__("Agent %s's Allies"), $user['User']['name'])) ?></h3>

  		<div class="evoke sheer-background">
			<div class="tabs-content evoke headings">
				<div class="content vertical active" id="panel1-1">

					<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
				  		<?php foreach($allies as $ally):
				  				$name = explode(' ', $ally['User']['name']); ?>
				  			<li>
					  			<div class="evoke evidence-tag allies text-align-center margin bottom-2">
					  		
						  			<div class = "content evidence-tag" style = "height: 520px;">
									  	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['User']['id']))?>">
									  		
									  		<?php if($ally['User']['photo_attachment'] == null) : ?>
												<?php if($ally['User']['facebook_id'] == null) : ?>
													<?php $pic = $this->webroot.'img/user_avatar.jpg';?>
													<!-- <div class = "ally"><img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/></div> -->
												<?php else : ?>	
													<!-- <div class = "ally"><img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"/></div> -->
													<?php $pic = "https://graph.facebook.com/" . $ally['User']['facebook_id']. "/picture?type=large"; ?>
												<?php endif; ?>
											<?php else : ?>
												<!-- <div class = "ally"><img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'] ?>"/></div> -->
												<?php $pic = $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'];?>
											<?php endif; ?>
											<div class="ally" style="background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;">
									  		</div>
									  		<h1><?= $name[0] ?>&nbsp;&nbsp;</h1>

									 	</a>

									 	<div class = "evoke border-bottom"></div>

									 	<p><?php echo substr($ally['User']['biography'], 0, 200); ?></p>

									 	<div class = "evoke border-bottom"></div>
									 	
									 	<a href = "//<?= $ally['User']['facebook']?>"><i class="fa fa-facebook-square fa-lg"></i></a>&nbsp;
										<a href = "//<?= $ally['User']['twitter']?>"><i class="fa fa-twitter-square fa-lg"></i></a>

										<div class = "margin bottom-1"></div>

									</div>

							 	</div>
				 			</li>
				  		<?php endforeach; ?>
					</ul>

				</div>
				<div class="content vertical" id="panel1-2">
				
					<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
				  		<?php foreach($followers as $ally):
				  				$name = explode(' ', $ally['User']['name']); ?>
				  			<li>
					  			<div class="evoke evidence-tag allies text-align-center margin bottom-2">
					  		
						  			<div class = "content evidence-tag" style = "height: 510px;">
									  	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['User']['id']))?>">
									  		<?php if($ally['User']['photo_attachment'] == null) : ?>
												<?php if($ally['User']['facebook_id'] == null) : ?>
													<?php $pic = $this->webroot.'img/user_avatar.jpg';?>
													<!-- <div class = "ally"><img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/></div> -->
												<?php else : ?>	
													<!-- <div class = "ally"><img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"/></div> -->
													<?php $pic = "https://graph.facebook.com/" . $ally['User']['facebook_id']. "/picture?type=large";?>
												<?php endif; ?>
											<?php else : ?>
												<!-- <div class = "ally"><img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'] ?>"/></div> -->
												<?php $pic = $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'];?>
											<?php endif; ?>
											<!-- testing same size images -->
									  		<div class="ally" style="background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;">
									  		</div>
										 	<h1><?= $name[0] ?>&nbsp;&nbsp;</h1>

									 	</a>

									 	<div class = "evoke border-bottom"></div>

									 	<p><?php echo substr($ally['User']['biography'], 0, 200); ?></p>

									 	<div class = "evoke border-bottom"></div>
									 	
									 	<a href = "//<?= $ally['User']['facebook']?>"><i class="fa fa-facebook-square fa-lg"></i></a>&nbsp;
										<a href = "//<?= $ally['User']['twitter']?>"><i class="fa fa-twitter-square fa-lg"></i></a>

										<div class = "margin bottom-1"></div>

									</div>

							 	</div>
				 			</li>
				  		<?php endforeach; ?>
					</ul>

				</div>

			</div>
		</div>

	  </div>

	  <div class="small-2 medium-2 large-2 columns padding-left margin top-2">
	  	
	  	<!-- <div class="evoke evidence-tag text-align-center margin bottom-2">
		  		
		  	<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $users['User']['id']))?>">
		  		<?php if($users['User']['photo_attachment'] == null) : ?>
					<?php if($users['User']['facebook_id'] == null) : ?>
						<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>" style = "max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
					<?php else : ?>	
						<img src="https://graph.facebook.com/<?php echo $users['User']['facebook_id']; ?>/picture?type=large" style = "max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
					<?php endif; ?>
				<?php else : ?>
					<img src="<?= $this->webroot.'files/attachment/attachment/'.$users['User']['photo_dir'].'/'.$users['User']['photo_attachment'] ?>" style = "max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
				<?php endif; ?>
		  		
			 	<h1><?= $users['User']['name']?></h1>
		 	</a>

			<dl class="accordion" data-accordion>
			  <dd>
			    <a href="#panel11"><i class="fa fa-angle-down fa-lg"></i></a>
			    <div id="panel11" class="content evidence-tag">
			      <div class = "evoke border-bottom"></div>

				 	<p><?php echo $users['User']['biography']; ?></p>

				 	<div class = "evoke border-bottom"></div>
				 	
				 	<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
					<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
					<i class="fa fa-twitter-square fa-2x"></i>

			    </div>
			  </dd>
			</dl>

	 	</div> -->

	 	<dl class="leaderboard tabs vertical margin top-6" data-tab>
			<dd class="active"><a href="#panel1-1"><?= strtoupper(__('Following'))?></a></dd>
			<dd><a href="#panel1-2"><?= strtoupper(__('Followers'))?></a></dd>
		</dl>

	  </div>

    </div>

</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>