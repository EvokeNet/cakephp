<div>
	<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
		<?php foreach($members as $member): ?>
			<li class = "text-center">
				<a target="_blank" href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $member['id'])) ?>">

					<!-- USER PICTURE -->
					<?php $pic = $this->Picture->getUserPictureAbsolutePath($member); ?>

					<div class="square-60px background-cover background-center img-circular margins-auto" style="background-image: url(<?= $pic ?>);">
						<img class="hidden" src="<?= $pic ?>" alt="User <?= $member['username'] ?>'s picture" /> <!-- For accessibility -->
					</div>

					<!-- USER NAME -->
					<h6><?= $member['name'] ?></h6>

				</a>

				<!-- REMOVE USER (IF NOT YOU) -->
				<?php if ($group['is_owner'] && ($groupOwner['id'] != $member['id'])) {?>	
					<a href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'delete', $member['id'])); ?>" class="button buttonRemoveMember"><?php echo __('Remove user');?></a>
				<?php } ?>
			</li>
		<?php endforeach;?>
	</ul>
</div>