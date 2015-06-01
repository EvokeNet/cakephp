<!-- GROUP -->
<div>
	<div class="row full-width profile-content padding top-1 bottom-1 left-2 right-2 border-top-divisor border-bottom-divisor background-color-dark-opacity-05 background-color-light-dark-on-hover">
		<div class="small-8 columns table-row"> <?php

			//LINK TO OPEN GROUP PAGE IN MISSION OVERLAY
			if (isset($link_to_group_page) && ($link_to_group_page)): ?>
				<a class="open-mission-overlay" href="<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $group['id']));?>"> <?php
			endif; ?>

					<!-- PICTURE -->
					<div class="table-cell vertical-align-middle square-60px">
						<?php $pic = $this->Picture->getGroupPictureAbsolutePath($group); ?>

						<div class="square-60px background-cover background-center img-circular" style="background-image: url(<?= $pic ?>);">
							<img class="hidden" src="<?= $pic ?>" alt="Group <?= $group['title'] ?>'s picture" /> <!-- For accessibility -->
						</div>
						
					</div>

					<!-- GROUP INFO -->
					<div class="table-cell vertical-align-middle full-width padding left-1">
						<?php if (isset($show_title) && ($show_title)): ?>
							<h5><?= $group['title']?></h5>
						<?php endif; ?>


						<p><?= $group['description']?></p>
					</div> <?php
		
			if (isset($link_to_group_page) && ($link_to_group_page)): ?>
				</a> <?php
			endif; ?>
	
		</div>

		<!-- SOCIAL NETWORK and RELATION TO THE LOGGED IN USER -->
		<div class="small-4 columns text-center">
			<div class="margin bottom-1 top"><?php
				if (isset($group['facebook']) && !empty($group['facebook'])): ?>
					<a href="<?= $group['facebook'] ?>" target="_blank" class="button-icon">
						<span class="fa-stack grow-on-hover">
							<i class="fa fa-square fa-stack-2x facebook-icon background"></i>
							<i class="fa fa-facebook fa-stack-1x fa-inverse text-color-dark"></i>
						</span>
					</a><?php
				endif;
				if (isset($group['twitter']) && !empty($group['twitter'])): ?>
					<a href="<?= $group['twitter'] ?>" target="_blank" class="button-icon">
						<span class="fa-stack grow-on-hover">
							<i class="fa fa-square fa-stack-2x twitter-icon background"></i>
							<i class="fa fa-twitter fa-stack-1x fa-inverse text-color-dark"></i>
						</span>
					</a><?php
				endif; ?>
			</div>
			<?php
				//OWNER
				if($group['is_owner']): ?>
					<span class="text-color-highlight">
						<i class="fa fa-check text-color-highlight"></i> <?= __('Leader') ?>
					</span>
					<?php

				//MEMBER
				elseif ($group['is_member']): ?>
					<span class="text-color-highlight">
						<i class="fa fa-check text-color-highlight"></i> <?= __('Member') ?>
					</span><?php

				//REQUEST PENDING
				elseif (isset($group['GroupRequest']) && (count($group['GroupRequest']) > 0)): ?>
					<span>
						<i class="fa fa-exclamation-triangle"></i> <?= __('Request pending') ?>
					</span>
					<?php

				//SEND REQUEST BUTTON
				else: ?>
					<a href="#" data-reveal-id="Group<?= $group['id']?>" data-reveal class="button small"><?= __('Send request to join')?></a>
					<?php
				endif; ?>
		</div>
	</div>
</div>

<!-- REQUEST TO JOIN -->
<div id="Group<?= $group['id']?>" class="reveal-modal text-center" data-reveal>
	<h1 class="text-color-highlight">
		<?= __('Join group') ?>
	</h1>

	<br />
	<p><?= __("A message will be sent to the group's owner and you will receive a notification when your request is approved or declined.")?></p>
	<br />

	<a class="button join-group" data-group-id="<?= $group['id']?>" href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'send', $group['id'])); ?>">
		<?php echo __('Send request to join');?>
	</a>

	<a class="close-reveal-modal">&#215;</a>
</div>