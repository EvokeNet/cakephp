<div>
	<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
		<?php foreach($members as $member): ?>
			<li class = "text-center">
				<a target="_blank" href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $member['id'])) ?>">

					<!-- USER PICTURE -->
					<?= $this->Picture->showUserCircularPicture(
						$member,
						'square-60px',
						__("%s's profile picture",$member['name'])
					); ?>

					<!-- USER NAME -->
					<h6><?= $member['name'] ?></h6>

				</a>

				<!-- REMOVE USER (IF NOT YOU) -->
				<?php if ($group['is_owner'] && ($groupOwner['id'] != $member['id'])) {?>	
					<a href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'delete', $member['id'])); ?>" class="button small buttonRemoveMember"><?php echo __('Remove user');?></a>
				<?php } ?>
			</li>
		<?php endforeach;?>
	</ul>
</div>