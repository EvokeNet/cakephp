<div>
	<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-4">
		<?php foreach($groupsUsers as $g): ?>
			<li class = "text-center">
				<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $g['User']['id'])) ?>">

					<!-- USER PICTURE -->
					<?php $pic = $this->Picture->getUserPictureAbsolutePath($g['User']); ?>

					<div class="square-60px background-cover background-center img-circular margins-auto" style="background-image: url(<?= $pic ?>);">
						<img class="hidden" src="<?= $pic ?>" alt="User <?= $g['User']['username'] ?>'s picture" /> <!-- For accessibility -->
					</div>

					<!-- USER NAME -->
					<h6><?= $g['User']['name'] ?></h6>

				</a>

				<!-- REMOVE USER (IF NOT YOU) -->
				<?php if ($group['is_owner'] && ($groupOwner['id'] != $g['User']['id'])) {?>	
					<a href="<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'delete', $g['User']['id'])); ?>" class="button"><?php echo __('Remove user');?></a>
				<?php } ?>
			</li>
		<?php endforeach;?>
	</ul>
</div>