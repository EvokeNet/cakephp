<?php

	echo $this->Html->css('mycarousel');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	// echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);

	echo $this->element('header', array('user' => $users));

	$this->end(); 
?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div id="secondModal" class="reveal-modal" data-reveal>
	  <h2>This is a second modal.</h2>
	  <p>See? It just slides into place after the other first modal. Very handy when you need subsequent dialogs, or when a modal option impacts or requires another decision.</p>
	  <a class="close-reveal-modal">&#215;</a>
	</div>

	<div class="evoke default row full-width-alternate profile">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $users));?>
	  </div>

	  <div class="small-9 medium-9 large-9 columns maincolumn">

	  <div class = "tint">
	  	<div class="row margin-left-0 margin-right-0 padding top-1">
		  <div class="small-4 medium-4 large-4 columns padding bottom-2">

		  	<h3><?= strtoupper(__('Agent')) ?></h3>

		  	<div class = "tag">
		  		<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%"/>

		  		<div class="row">
					  <div class="small-4 medium-4 large-4 columns pic">
					  	<a href = "#">
					  		<?php if($user['User']['photo_attachment'] == null) : ?>
			  					<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"/>
			  				<?php else : ?>
			  					<img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>"/>
			  				<?php endif; ?>
					  	</a>
					  </div>
					  <div class="small-8 medium-8 large-8 columns info">
						
							<h6><?php echo strtoupper(__("Evoke Agent"));?></h6>
							<h4><?php echo $user['User']['name']; ?></h4>
							<h5><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<span><?= $level ?></span></h5>
							<div class="evoke progress small-9 large-9 round">
							  <span class="meter" style="width: <?= $percentage ?>%"></span>
							</div>

							<h5><?php echo __('Points');?>&nbsp;&nbsp;<span><?= $sumPoints ?></span></h5>
						
					  </div>
				</div>

				<div class = "text-align-end">
					<?php if((!$is_friend) && ($user['User']['id'] != $users['User']['id'])):?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'add', $users['User']['id'], $user['User']['id'])); ?>" class = "info button general"><?php echo __('Follow this agent');?></a>
					<?php else: 
						if($user['User']['id'] != $users['User']['id']){ ?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'userFriends', 'action' => 'delete', $is_friend['UserFriend']['id'])); ?>" class = "info button general"><?php echo __('Unfollow this agent');?></a>
					<?php } endif; ?>
				</div>

		  	</div>

		  </div>
		  <div class="small-4 medium-4 large-4 columns">

		  	<div class="row">
			  <div class="large-6 columns"><h3><?= strtoupper(__('Badges')) ?></h3></div>
			  <div class="large-6 columns text-align-end"><a href = "<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index')); ?>" class = "info button general"><?php echo __('See All');?></a></div>
			</div>

		  	<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">

				<?php foreach($badges as $badge): 
					if(isset($badge['Badge']['img_dir'])) : ?>
						<li><img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'></li>
					<?php else: ?>
						<li><img src = '<?= $this->webroot.'img/badge4.png' ?>'></li>
					<?php endif ?>
				<?php endforeach;?>

			</ul>
		  </div>
		  <div class="small-4 medium-4 large-4 columns">

		  	<div class="row">
			  <div class="large-6 columns"><h3><?= strtoupper(__('Allies')) ?></h3></div>
			  <div class="large-6 columns text-align-end"><a href = "#" class = "info button general" data-reveal-id="myModalAllies"><?php echo __('See All');?></a></div>
			</div>

		  	<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
				<?php 
					$k = 0;
					foreach($allies as $ally):
						$k++;
						if($k >8) break;
						$name = explode(' ', $ally['User']['name']); ?>
						<li>
							<a class="th" href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['User']['id'])) ?>">
								<?php if($ally['User']['photo_attachment'] == null) : ?>
				  					<img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large"/>
				  				<?php else : ?>
				  					<img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/thumb_'.$ally['User']['photo_attachment'] ?>"/>
				  				<?php endif; ?>
								
								<span><?= $name[0] ?></span>
							</a>
						</li>
			  	<?php endforeach;?>
			</ul>

			<div id="myModalAllies" class="reveal-modal small evoke lightbox" data-reveal>
			  <h2><?= __('Allies') ?></h2>

			  	<ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-1">
			  	<?php foreach($allies as $ally):?>
					<li>
						<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['User']['id'])) ?>">
							<?php if($ally['User']['photo_attachment'] == null) : ?>
			  					<img src="https://graph.facebook.com/<?php echo $ally['User']['facebook_id']; ?>/picture?type=large" style = "width: 25%; margin-right: 40px;"/>
			  				<?php else : ?>
			  					<img src="<?= $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/thumb_'.$ally['User']['photo_attachment'] ?>" style = "width: 25%; margin-right: 40px;"/>
			  				<?php endif; ?>
							
							<span><?= $ally['User']['name'] ?></span>
						</a>
					</li>
				<?php endforeach;?>
				</ul>
			  <a class="close-reveal-modal">&#215;</a>
			</div>

		  </div>
		</div>
		</div>

		<div class="row full-width-alternate margin-left-0 margin-right-0">
		  <div class="small-6 medium-6 large-6 columns padding top-2 group">
		  	<h3><?= strtoupper(__("Evokations Groups")) ?></h3>

		  	<?php foreach($myEvokations as $e): ?>

		  		<a href = "<?= $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id'])) ?>">
	    			<div class="row padding bottom-2">
					  <div class="small-3 medium-3 large-3 columns">
					  	<?php if($e['Group']['photo_dir'] == null) :?>
			  				<img src="https://graph.facebook.com//picture?type=large"/>
				  		<?php else : ?>
							<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['Group']['photo_dir'].'/thumb_'.$e['Group']['photo_attachment'] ?>" />
						<?php endif; ?>
					  </div>
					  <div class="small-9 medium-9 large-9 columns">
					  	<h4><?= $e['Group']['title'] ?></h4>
					  </div>
					</div>
				</a>

	    	<?php endforeach; ?>

		  </div>
		  <div class="small-6 medium-6 large-6 columns padding top-2">

		  	<h3> <?= strtoupper(__('Evidence/Project Stream')) ?> </h3>

		  	<dl class="default tabs" data-tab>
			  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('My Evidences')) ?></a></dd>
			  <dd><a href="#panel2-2"><?= strtoupper(__('My Projects')) ?></a></dd>
			</dl>
			<div class="evoke content-block default tabs-content">
			  <div class="content active" id="panel2-1">
			    <?php 
		    		//Lists all projects and evidences
		    		foreach($myevidences as $e): 
	    				//echo $this->element('evidence_blue_box', array('e' => $e)); 
	    				//echo $this->element('evidence_box', array('e' => $e)); 
	    				echo $this->element('evidence', array('e' => $e)); 
		    		endforeach; 
				?>
			  </div>
			  <div class="content" id="panel2-2">
			    <?php 
		    		foreach($myEvokations as $e):
		    			echo $this->element('evokation', array('e' => $e, 'mine' => true));
		    		endforeach;
		    	?>
			  </div>
			</div>
		  </div>
		</div>

	  </div>

	  <div class="medium-1 end columns"></div>

	</div>

</section>

<?php
	echo $this->Html->script('reveal_modal', array('inline' => false));
	echo $this->Html->script('mycarousel', array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('reveal_modal', array('inline' => false));
?>