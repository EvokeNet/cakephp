
<div class="row standard-width">
  	<div class="small-5 medium-5 large-5 columns">
  		<!-- GROUP PICTURE -->
  		<?php $pic = $this->Picture->getGroupPictureAbsolutePath($group['Group']); ?>

		<div class="square-60px background-cover background-center img-circular" style="background-image: url(<?= $pic ?>);">
			<img class="hidden" src="<?= $pic ?>" alt="Group <?= $group['Group']['title'] ?>'s picture" /> <!-- For accessibility -->
		</div>
	
		<!-- GROUP INFO -->
		<div class="text-center"><h4><?= $group['Group']['title']; ?></h4></div>
		<h5><?= __('Team Owner');?>&nbsp;&nbsp;<div><?= $group['User']['name'] ?></div></h5>
		<h5><?= __('Members');?>&nbsp;&nbsp;&nbsp;<div><?= $countMembers ?></div></h5>
		<h5><?= __('Mission');?>&nbsp;&nbsp;<div><?= $group['Phase']['Mission']['title'] ?></div></h5>

		<div>
			<p><?= $group['Group']['description'] ?></p>
		</div>

		<!-- GROUP SOCIAL NETWORKS -->
		<div>
			<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
			<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
			<i class="fa fa-twitter-square fa-2x"></i>
		</div>

		<!-- GROUP MEMBERSHIP -->
		<div>
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
	
	<div class="small-7 medium-7 large-7 columns">

	  	<div class="text-center">
	  		<h3><?= strtoupper(__('Members')) ?></h3>
	  	</div>

	  	<div class = "evoke content-block" style = "padding: 20px 10px;">
	  		<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
				<?php foreach($groupsUsers as $g): ?>
					<li class = "text-align-center">
						<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $g['User']['id'])) ?>">

							<!-- USER PICTURE -->
					  		<?php $pic = $this->Picture->getUserPictureAbsolutePath($g['User']); ?>

							<div class="square-60px background-cover background-center img-circular" style="background-image: url(<?= $pic ?>);">
								<img class="hidden" src="<?= $pic ?>" alt="User <?= $g['User']['username'] ?>'s picture" /> <!-- For accessibility -->
							</div>

							<!-- USER NAME -->
							<h6><?= $g['User']['name'] ?></h6>

						</a>

						<?php if($flags['_owner'] && $group['User']['id'] != $g['User']['id']) {?>	
					 		<a href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'delete', $g['User']['id'])); ?>" class="button"><?php echo __('Remove user');?></a>
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