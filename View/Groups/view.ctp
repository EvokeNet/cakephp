<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	$countMembers = count($groupsUsers);

	echo $this->element('header', array('user' => $user));
	$this->end(); 
	
?>

<section class="evoke background padding top-2">
	
	<div class = "evoke dashboard position">
		<?= $this->element('left_titlebar', array('title' => __("Evokation Team"))) ?>
	</div>

	<div class="row full-width">
		<div class="small-3 medium-3 large-3 columns">
			<div class = "evoke dashboard tag">
				<img src='<?= $this->webroot.'img/chip105.png' ?>' width = "100%"/>
				
				<div class = "evoke text-align"><a href = ""><img src="" class = "evoke dashboard user_pic"/></a></div>

				<div class = "evoke group agent info tag-padding">
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
		<div class="small-9 medium-9 large-9 columns">

			<?php echo $this->element('right_titlebar', array('title' => (__('Members')))); ?>

			<div class="row">
			  <div class="large-1 columns"></div>
			  <div class="large-8 large-offset-3 columns">
			  	<div class = "evoke screen-box allies" style = "padding: 40px 20px;">
			  		<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
						<?php foreach($groupsUsers as $g): ?>
							<li><a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $g['User']['id'])) ?>"><img src = "https://graph.facebook.com/<?php echo $g['User']['facebook_id']; ?>/picture?type=large"><span><?= $g['User']['name'] ?></span></a>
								<?php if($flags['_owner'] && $group['User']['id'] != $g['User']['id']) {?>	
							 		<a href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'delete', $g['User']['id'])); ?>" class="button general" style = "margin-top: 10px;"><?php echo __('Remove user');?></a>
							 	<?php } ?>
							</li>
						<?php endforeach;?>
					</ul>
				</div>
			  </div>
			</div>

			<?php if($flags['_owner']) {
				echo $this->element('right_titlebar', array('title' => (__('Requests')))); ?>

			<div class="row">
			  <div class="large-1 columns"></div>
			  <div class="large-8 large-offset-3 columns">
			  	<div class = "evoke screen-box allies" style = "padding: 40px 20px;">

					<dl class="tabs" data-tab>
					  <dd class="active"><a href="#panel2-1"><?php echo __('Pending Requests');?></a></dd>
					  <dd><a href="#panel2-2"><?php echo __('Accepted/Declined Requests');?></a></dd>
					</dl>
					<div class="tabs-content">
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
				</div>
			  </div>
			</div>
			<?php } ?>

		</div>
	</div>
</section>