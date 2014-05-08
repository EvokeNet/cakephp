<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	$countMembers = count($groupsUsers);

	echo $this->element('header', array('user' => $user));
	$this->end(); 
	
?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div id="secondModal" class="reveal-modal" data-reveal>
	  <h2>This is a second modal.</h2>
	  <p>See? It just slides into place after the other first modal. Very handy when you need subsequent dialogs, or when a modal option impacts or requires another decision.</p>
	  <a class="close-reveal-modal">&#215;</a>
	</div>

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-9 medium-9 large-9 columns padding top-2 maincolumn">

	  	<div class="row">
		  <div class="small-3 medium-3 large-3 columns padding bottom-2">

		  	<div class = "tag">
				<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%"/>
				
				<div class = "evoke text-align"><a href = ""><img src="" class = "evoke dashboard user_pic"/></a></div>

				<div class = "evoke group agent info tag-padding">
					<?php if(empty($group_img)) :?>
			  				<div class = "text-align-center"><img src="https://graph.facebook.com//picture?type=large"/></div>
			  			<?php else : ?>
			  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$group_img['Attachment']['dir'].'/'.$group_img['Attachment']['attachment'] ?>" style = "margin: 20%; width: 60%;"/>
			  			<?php endif; ?>
					<div class = "evoke text-align"><h4><?= $group['Group']['title']; ?></h4></div>
					<h5><?= __('Team Owner');?>&nbsp;&nbsp;<div><?= $group['User']['name'] ?></div></h5>
					<h5><?= __('Members');?>&nbsp;&nbsp;&nbsp;<div><?= $countMembers ?></div></h5>
					<h5><?= __('Mission');?>&nbsp;&nbsp;<div><?= $group['Mission']['title'] ?></div></h5>
				</div>

				<!-- <div class = "evoke border-bottom"></div> -->

				<div class = "evoke text-align">
					<?php if($flags['_owner'] || $flags['_member']) : 
						if(empty($myEvokation)) : ?>
							<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'createProject', $group['Group']['id'])); ?>" class = "button general"><?php echo __('START PROJECT');?></a>
						<?php else :?>
							<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'edit', $group['Group']['id'])); ?>" class = "button general"><?php echo __('GO TO PROJECT');?></a>
						<?php endif;?>
						<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'edit', $group['Group']['id'])); ?>" class = "button general">
							<?php echo __('Edit Information');?>
						</a>
					<?php endif;?>
				</div>

				<div class = "evoke dashboard agent-data border-top">
					<p><?= $group['Group']['description'] ?></p>
				</div>

				<div class = "evoke dashboard agent-data">
					<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
					<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
					<i class="fa fa-twitter-square fa-2x"></i>
				</div>

				<div class = "evoke group agent-info text-align">
				<?php if($iam_member || $group['User']['id'] == $user['User']['id']): ?>
					<h5><i class="fa fa-check"></i>&nbsp;<?= __('Member') ?></h5>
				<?php else: ?>
					<h5><i class="fa fa-times"></i>&nbsp;<?= __('Not a member') ?></h5>
				<?php endif; ?>
				</div>

				<div class = "evoke text-align">
					<?php if(!$userRequest && !$flags['_owner']):?>
					  	<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $group['User']['id'], $group['Group']['id'])); ?>" class = "button general"><?php echo __('Send request to join');?></a>
					<?php endif;?>
				</div>

			</div>

		  </div>
		  <div class="small-7 medium-7 large-7 columns">

		  	<div class = "text-align-end"><h3><?= strtoupper(__('members')) ?></h3></div>

		  	<div class = "evoke content-block" style = "padding: 20px 10px;">
		  		<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
					<?php foreach($groupsUsers as $g): ?>
						<li class = "text-align-center">
							<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $g['User']['id'])) ?>">
								<?php if($g['User']['photo_attachment'] == null) : ?>
									<img src = "https://graph.facebook.com/<?php echo $g['User']['facebook_id']; ?>/picture?type=large" style = "height: 5vw">
								<?php else : ?>
									<img src="<?= $this->webroot.'files/attachment/attachment/'.$g['User']['photo_dir'].'/'.$g['User']['photo_attachment'] ?>" style = "height: 6vw"/>
								<?php endif; ?>

								<h6 style = "color:#fff"><?= $g['User']['name'] ?></h6>
							</a>
							<?php if($flags['_owner'] && $group['User']['id'] != $g['User']['id']) {?>	
						 		<a href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'delete', $g['User']['id'])); ?>" class="button general" style = "margin-top: 10px;"><?php echo __('Remove user');?></a>
						 	<?php } ?>
						</li>
					<?php endforeach;?>
				</ul>
		  	</div>

		  	<?php if($flags['_owner']): ?>
				<div class = "text-align-end"><h3><?= strtoupper(__('Requests')) ?></h3></div>

				<dl class="default tabs" data-tab>
				  <dd class="active"><a href="#panel2-1"><?php echo __('Pending Requests');?></a></dd>
				  <dd><a href="#panel2-2"><?php echo __('Accepted/Declined Requests');?></a></dd>
				</dl>
				<div class="evoke content-block default tabs-content">
				  <div class="content active" id="panel2-1">
				    <ul>
						<?php foreach($groupsRequestsPending as $g): ?>
							<li><?php echo $g['User']['name']; ?>
								<div class="button-bar">
								  <ul class="button-group">
								    <li><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'add', $g['GroupRequest']['user_id'], $g['GroupRequest']['group_id'])); ?>" class = "button"><?php echo __('Accept');?></a></li>
								  </ul>
								  <ul class="button-group">
								    <li><a href = "<?php echo $this->Html->url(array('controller' => 'groupRequests', 'action' => 'decline', $g['GroupRequest']['user_id'], $g['GroupRequest']['group_id'])); ?>" class = "button alert"><?php echo __('Decline');?></a></li>
								  </ul>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				  </div>
				  <div class="content" id="panel2-2">
				    <ul>
				    <?php foreach($groupsRequests as $g):?>
						<li>
							<?php 
							if($g['GroupRequest']['status'] == 1) $status = __('Accepted');
							else $status = __('Declined');
							echo sprintf(__("Requester: Agent %s </br> Status: %s", $g['User']['name'], $status));
							?>
						</li>
						<?php endforeach; ?>
					</ul>
				  </div>
				</div>
			<?php endif; ?>

		  </div>
		</div>
	  </div>

	  <div class="medium-1 end columns"></div>

  </div>
</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>