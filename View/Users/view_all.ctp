<?php
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Evoke users'), 'imgSrc' => ($this->webroot.'img/header-profile.jpg'), 'margin' => false));
	$this->end();
?>

<div class="evoke row background-color-standard standard-width padding all-2">
	<!-- USER GRID -->
	<?php
	if (count($all_users) > 0): ?>
		<ul class="large-block-grid-5 medium-block-grid-3 small-block-grid-2 no-marker" data-equalizer>

		<?php
			$counter = 0;
			foreach($all_users as $user):
				 ?>
			<li>
				<div class="profile-content panel relative radius text-center margin right-05" data-equalizer-watch>
					<div class="margin bottom-3">
						<!-- USER PICTURE -->
						<?= $this->Picture->showUserCircularPicture(
							$user['User'],
							'square-60px',
							__("%s's profile picture",$user['User']['name'])
						); ?>

						<!-- USER SHORT BIOGRAPHY -->
						<h4 class="text-color-highlight"><?= $user['User']['name'] ?></h4>

						<?php
						//Has mini_biography
						if (!empty($user['User']['mini_biography'])): ?>
							<p><?= $user['User']['mini_biography'] ?></p>
						<?php
						//Has biography
						elseif (!empty($user['User']['biography'])): ?>
							<p><?= $this->Text->getExcerpt($user['User']['biography'], 30, '...') ?></p>
						<?php
						//Doesn't have anything
						else: ?>
							<div data-alert="" class="alert-box radius">
								<?= __('This user has not added a biography yet.') ?>
							</div> <?php
						endif;
						?>
					</div>

					<div class="full-width absolute bottom-0 left-0">
						<!-- ADD AS AN ALLY -->
						<?php if(!in_array($user['User']['id'], $friends_ids) && ($user['User']['id'] != $loggedInUser['id'])): ?>
							<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $user['User']['id'], $loggedInUser['id'], false)); ?>" target="_blank" onclick="location.reload()">
								<i class="fa fa-plus"></i>
								<?= __('Add as ally') ?>
							</a>

						
						<!-- ALREADY AN ALLY -->
						<?php elseif(in_array($user['User']['id'], $friends_ids) && ($user['User']['id'] != $loggedInUser['id'])): ?>
							<a class="button small disabled">
								<i class="fa fa-check"></i>
								<?= __('Your ally') ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</li>
			<?php
				$counter++;
			endforeach;
		?>

		</ul>
	<?php
	else: ?>
		<div data-alert="" class="alert-box radius">
			<?= __('There are no other users in Evoke!') ?>
		</div><?php
	endif; ?>
</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>
