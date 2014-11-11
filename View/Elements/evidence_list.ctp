<?php 
if (isset($evidences)):
	foreach($evidences as $e):

		//USER PICTURE
		$pic = $this->webroot.'webroot/img/user_avatar.jpg';
		if($e['User']['photo_attachment'] == null) {
			if($e['User']['facebook_id'] != null) {
				$pic = "https://graph.facebook.com/". $e['User']['facebook_id'] ."/picture?type=large";
			}
		}
		else {
			$pic = $this->webroot.'files/attachment/attachment/'.$e['User']['photo_dir'].'/'.$e['User']['photo_attachment'];
		}
		?>

		<!-- EVIDENCE -->
		<div class="table full-width profile-content padding top-1 bottom-1 left-2 right-2 border-bottom-divisor background-color-standard-opacity-07 background-color-light-dark-on-hover">
			<!-- USER PICTURE -->
			<div class="table-cell vertical-align-middle square-60px">
				<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $e['User']['id'])); ?>">
					<img class="img-circular smallest margin bottom-0" src='<?= $pic ?>' alt="<?= $e['User']['name'] ?>'s profile picture" />
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
					<p class="user-name margins-0 text-small">
						<?= __('By ').$e['User']['name'] ?>
					</p>
				</a>
			</div>
		</div>
		<?php 
	endforeach; 
endif; ?>