<?php
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Profile', 'imgSrc' => ($this->webroot.'img/header-profile.jpg'), 'margin' => false));
	$this->end();
?>


<div class="evoke row background-color-standard full-width" data-equalizer>
	<!-- LEFT SIDEBAR -->
	<div class="medium-2 columns gradient-on-right" data-equalizer-watch>
		<!-- PROFILE -->
		<div class="row padding top-2 bottom-1 left-2 right-2">
			
				<?php
				$pic = $this->webroot.'webroot/img/user_avatar.jpg';
				if($user['User']['photo_attachment'] == null) {
					if($user['User']['facebook_id'] != null) {
						$pic = "https://graph.facebook.com/". $user['User']['facebook_id'] ."/picture?type=large";
					}
				}
				else {
					$pic = $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'];
				}
				?>

				<div class="centering-block"><img src="<?=$pic?>" class="img-circular" alt="<?= __('Your profile picture') ?>" /></div>

				<h4 class="text-color-highlight text-center"><?= $user['User']['name'] ?></h4>
				<div><p><?= $user['User']['biography'] ?>lorem ipsum</p></div>
		</div>

		<!-- SOCIAL NETWORKS -->
		<div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor">
				Social networks
		</div>

		<!-- LEVEL -->
		<div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor">
				Level
		</div>

		<!-- POTENTIAL ALLIES -->
		<div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor">
				<h4><?= __('Potential allies') ?></h4>
		</div>
	</div>

	<!-- CENTER -->
	<div class="medium-8 columns padding top-2 bottom-2 left-4 right-4" data-equalizer-watch>
		<div class="row">
			<!-- PSYCHOMETRIC ANALYSIS -->
			<div class="medium-6 columns">
				<h3><?= __('Psychometric Analysis') ?></h3>
				<p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
				<p><?= __('You have the heart of a Local Leader!') ?></p>
				<p><?= __('Your Entrepreneurship and Local Insight are key to you. Embrace your qualities and use them for the better.') ?></p>
			</div>

			<!-- RADAR GRAPH FOR MATCHING RESULTS -->
			<div class="medium-6 columns centering-block">
				<div class="text-center vertical-align-middle centered-block">
					<?php echo $this->element('matching_graph', array('height' => '350', 'width' => '400')); ?>
				</div>
			</div>
		</div>

		<!-- ALLIES -->
		<div class="row border-top-panel">
			<div class="small-12 columns">
				<h3><?= __('About') ?></h3>
				<?= $user['User']['biography'] ?>
			</div>
		</div>

		<!-- ALLIES -->
		<div class="row border-top-divisor">
			<div class="small-12 columns margin top-2">
				<?php if (count($similar_users) > 0): ?>
				<div>
					<h3 class="left margin right-2"><?= __('Allies') ?></h3>
					<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>"><?php echo __('ALL USERS'); ?></a>
				</div>
				<?php else: ?>
				<div data-alert="" class="alert-box radius">
					<?= __('You have no allies! Get started looking at people similar to you!') ?>
				</div>
				<?php endif; ?>

				<!-- ALLIES GRID -->
				<?php
					$counter = 0;
					foreach($similar_users as $similar_user):
						$pic = $this->webroot.'webroot/img/user_avatar.jpg';
						if($similar_user['User']['photo_attachment'] == null) {
							if($similar_user['User']['facebook_id'] != null) {
								$pic = "https://graph.facebook.com/". $similar_user['User']['facebook_id'] ."/picture?type=large";
							}
						}
						else {
							$pic = $this->webroot.'files/attachment/attachment/'.$similar_user['User']['photo_dir'].'/'.$similar_user['User']['photo_attachment'];
						}
				?>
				<div class="large-2 medium-4 small-6 columns">
					<!-- PICTURE -->
					<a href="#" data-reveal-id="modalProfile<?= $counter ?>">
						<div class="profile-picture small radius margins-auto" data-interchange="['<?= $pic ?>',(default)]">
						</div>
						<p class="text-center text-glow-on-hover"><?= $similar_user['User']['name'] ?></p>
					</a>

					<!-- MODAL USER BIOGRAPHY -->		
					<?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'similar_user' => $similar_user, 'pic' => $pic, 'add_button' => false)); ?>
				</div>

				<?php
						$counter++;
					endforeach;
				?>
			</div>
		</div>

		<!-- LEADERBOARD -->
		<div class="row border-top-divisor">
			<div class="large-6 columns padding top-2 border-right-divisor">
				<h3><?= __('Leaderboard') ?></h3>
			</div>

			<div class="large-6 columns padding top-2">
				<h3><?= __('Badges earned') ?></h3>
			</div>
		</div>
	</div>

	<!-- RIGHT SIDEBAR -->
	<div class="medium-2 columns gradient-on-left padding all-2" data-equalizer-watch>...</div>
</div>

<?php
	/* Script */
	$this->start('script');
?>
	<script type="text/javascript">
		//Checkbox glows when selected
		$("div.profile-picture")
		.on("mouseover", function(){
			$(this).addClass('img-glow-small');
			$(this).siblings('p').addClass('text-glow');
		})
		.on("mouseout", function(){
			$(this).removeClass('img-glow-small');
			$(this).siblings('p').removeClass('text-glow');
		});
	</script>
	<?php $this->end(); ?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>

<div class="full-width full-height">
	<img src="<?= $this->webroot.'img/mockup-1-evoke-profile-.jpg' ?>"  class="full-width" />
</div>