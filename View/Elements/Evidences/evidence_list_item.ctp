<?php
	//USER PICTURE
	$pic = $this->UserPicture->getPictureAbsolutePath($e['User']);
?>


<!-- EVIDENCE -->
<div class="table full-width profile-content padding top-1 bottom-1 left-2 right-2 border-bottom-divisor background-color-standard-opacity-07 background-color-light-dark-on-hover">
	<!-- USER PICTURE -->
	<div class="table-cell vertical-align-middle square-60px">
		<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $e['User']['id'])); ?>">
			<div class="square-60px background-cover background-center img-circular" style="background-image: url(<?= $pic ?>);">
				<img class="hidden" src="<?= $pic ?>" alt="<?= $e['User']['name'] ?>'s profile picture" /> <!-- For accessibility -->
			</div>
		</a>
	</div>

	<!-- EVIDENCE INFO -->
	<div class="table-cell vertical-align-middle padding left-1">
		<a href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id'])); ?>">
			<!-- EVIDENCE TITLE -->
			<h5 class="text-color-highlight">
				<?= $e['Evidence']['title'] ?>
			</h5>

			<!-- USER NAME -->
			<p class="user-name margins-0 font-size-small">
				<?= __('By ').$e['User']['name'] ?>
			</p>
		</a>
	</div>
</div>