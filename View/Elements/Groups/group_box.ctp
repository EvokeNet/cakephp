<div>
	<div class="row full-width profile-content padding top-1 bottom-1 left-2 right-2 border-bottom-divisor background-color-light-dark-on-hover">
		<div class="small-9 columns table-row">
			<!-- PICTURE -->
			<div class="table-cell vertical-align-middle square-60px">
				<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['id']));?>">
					<?php $pic = $this->Picture->getGroupPictureAbsolutePath($e); ?>

					<div class="square-60px background-cover background-center img-circular" style="background-image: url(<?= $pic ?>);">
						<img class="hidden" src="<?= $pic ?>" alt="Group <?= $e['title'] ?>'s picture" /> <!-- For accessibility -->
					</div>
				</a>
			</div>

			<!-- GROUP INFO -->
			<div class="table-cell vertical-align-middle full-width padding left-1">
				<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['id']));?>">
					<h5><?= $e['title']?></h5>
					<p><?= $e['description']?></p>
				</a>
			</div>
		</div>

		<!-- SOCIAL NETWORK and RELATION TO THE LOGGED IN USER -->
		<div class="small-3 columns text-center">
			<div class="margin bottom-1 top">
				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x facebook-icon background"></i>
					<i class="fa fa-facebook fa-stack-1x fa-inverse text-color-dark"></i>
				</span>

				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x twitter-icon background"></i>
					<i class="fa fa-twitter fa-stack-1x fa-inverse text-color-dark"></i>
				</span>

				<span class="fa-stack fa-lg grow-on-hover">
					<i class="fa fa-square fa-stack-2x google-icon background"></i>
					<i class="fa fa-google-plus fa-stack-1x fa-inverse text-color-dark"></i>
				</span>
			</div>
			<?php
				if (!$e['is_member']): ?>
					<a href="#" data-reveal-id="<?= $e['id']?>" data-reveal class = "button thin"><?= __('Send request to join')?></a>
					<?php

				elseif($e['is_owner']): ?>
					<span class="text-color-highlight">
						<i class="fa fa-check text-color-highlight"></i> <?= __('Owner') ?>
					</span>
					<?php

				else: ?>
					<span class="text-color-highlight">
						<i class="fa fa-check text-color-highlight"></i> <?= __('Member') ?>
					</span>
					<?php
				endif; ?>
		</div>
	</div>
</div>

<div id="<?= $e['id']?>" class="reveal-modal" data-reveal style = "background-color: #bc5660; border: 5px solid #000">
  <h2><?= __("Message below will be sent to owner's group")?></h2>
  <p class="lead"></p>
  <p></p>

  <!-- <table style = "background-color: #283954; padding:20px; border-spacing: 0px;"> -->
	<div class = "screen-box" style = "padding:20px 30px">

	  <h1 style = "font-size:2.0em; color:#fff; font-weight:bold; font-family: 'AlegreyaRegular';"><?php echo sprintf(__('Hi %s', $user['User']['name']));?></h1>
	  <h2 style = "font-size:1.5em; color:#fff; font-weight:bold; font-family: 'AlegreyaRegular';"><?php echo sprintf(__('You have one invite request for your group %s'), $e['title']);?></h2>

	  <div style = "background-color:#fff; min-height: 200px; padding: 20px; border-radius: 10px; border: 2px solid #000; ">
		<div style = "position:relative; float:left"><img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" style = "max-height:150px"/></div>
		<div style = "margin-left: 160px;">
		  <ul style = "list-style:none; font-family: 'AlegreyaRegular'; margin-left:50px">
			<li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['name'];?></li>
			<li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['email'];?></li>
			<li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['birthdate'];?></li>
			<li style = "font-family: 'AlegreyaRegular"><?php echo $user['User']['biography'];?></li>
		  </ul>
		</div>
	  </div>

	  <button class = "evoke button general green" style = "margin-top:30px"><?php echo __('Accept User');?></a></button>

	  <button class = "evoke button general red" style = "margin-top:30px"><?php echo __('Decline User');?></button>
	</div>

	<a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $user['User']['id'], $e['id'])); ?>" class = "button general green"><?php echo __('Send request to join');?></a>

  <a class="close-reveal-modal">&#215;</a>
</div>