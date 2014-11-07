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
	<div class="medium-2 columns gradient-on-right profile-sidebar" data-equalizer-watch>
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

			<div class="centering-block large-12 medium-6 small-6 margins-auto">

				<div>
					<img src="<?=$pic?>" class="profile-picture-150px img-circular" alt="<?= __('Your profile picture') ?>" />
				</div>

			</div>

			<h4 class="text-color-highlight text-center margin top-1"><?= $user['User']['name'] ?></h4>
			<div>
				<p class="text-center">
					<?= (isset($user['User']['mini_biography']) && (($user['User']['mini_biography']) != ""))
						? $user['User']['mini_biography']
						: $this->Text->getExcerpt($user['User']['biography'], 30, '...') ?>
				</p>
			</div>
		</div>

		<!-- SOCIAL NETWORKS -->
		<div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor text-center">
			<?php echo $this->element('social_networks_bar'); ?>
		</div>

		<!-- LEVEL -->
		<div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor">
			<?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>
		</div>

		<!-- POTENTIAL ALLIES -->
		<div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor">
			<h4><?= __('Potential allies') ?></h4>
		    <ul class="full-width small-block-grid-1">
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
		      <li>
		        <!-- PANEL -->
		        <a href="#" data-reveal-id="modalProfilePotentialAllies<?= $counter ?>">
		          <div class="profile-content padding top-1">
		          	<!-- USER PICTURE -->
		          	<div class="left padding right-1 full-height">
		          		<img class="profile-picture-40px img-circular smallest margin bottom-0" src='<?= $pic ?>' alt="<?= $similar_user['User']['name'] ?>'s profile picture" />
		          	</div>

		            <!-- USER INFO -->
		            <div class="vertical-align-middle" style="margin-left: 57px;">
		              <p class="user-name margins-0">
		                <?= $similar_user['User']['name'] ?>
		              </p>

		              <small>Level <?= $similar_user['User']['level'] ?></small>
		            </div>
		          </div>
		        </a>

		        <!-- VIEW AGENT DETAILS MODAL -->
		        <?php echo $this->element('user_biography', array('modal' => true, 'counter' => 'PotentialAllies'.$counter, 'user' => $similar_user, 'pic' => $pic, 'add_button' => true)); ?>
		      </li>
		      <?php
		          $counter++;
		        endforeach;
		      ?>
		    </ul>
		</div>
	</div>

	<!-- CENTER -->
	<div class="medium-8 columns padding top-2 bottom-2 left-4 right-4" data-equalizer-watch>
		<div class="row">
			<!-- PSYCHOMETRIC ANALYSIS -->
			<div class="large-6 medium-12 columns">
				<h3><?= __('Psychometric Analysis') ?></h3>
				<p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
				<p><?= __('You have the heart of a Local Leader!') ?></p>
				<p><?= __('Your Entrepreneurship and Local Insight are key to you. Embrace your qualities and use them for the better.') ?></p>
			</div>

			<!-- RADAR GRAPH FOR MATCHING RESULTS -->
			<div class="large-6 medium-12 columns centering-block">
				<div class="text-center vertical-align-middle centered-block">
					<?php echo $this->element('matching_graph', array('height' => '350', 'width' => '400')); ?>
				</div>
			</div>
		</div>

		<!-- ALLIES -->
		<div class="row border-top-divisor">
			<div class="small-12 columns margin top-2">
				<h3><?= __('About') ?></h3>
				<?= $user['User']['biography'] ?>
			</div>
		</div>

		<!-- ALLIES -->
		<div class="row border-top-divisor">
			<div class="small-12 columns margin top-2">

				<div class="row margins-0">
					<h3 class="left margin right-2"><?= __('Allies') ?></h3>
					<!-- <a class="button small disabled" disabled href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>"><?php echo __('ALL USERS'); ?></a> -->
				</div>


				<!-- ALLIES GRID -->
				<?php
				if (count($followers) > 0):
					$counter = 0;
					
					foreach($followers as $ally):
						$pic = $this->webroot.'webroot/img/user_avatar.jpg';
						if($ally['User']['photo_attachment'] == null) {
							if($ally['User']['facebook_id'] != null) {
								$pic = "https://graph.facebook.com/". $ally['User']['facebook_id'] ."/picture?type=large";
							}
						}
						else {
							$pic = $this->webroot.'files/attachment/attachment/'.$ally['User']['photo_dir'].'/'.$ally['User']['photo_attachment'];
						}
					?>
					<div class="large-2 medium-4 small-6 columns paddings-0 text-center">
						<!-- PICTURE -->
						<a href="#" data-reveal-id="modalProfile<?= $counter ?>">
							<img class="profile-picture small radius img-glow-on-hover-small" src='<?= $pic ?>' alt="<?= $ally['User']['name'] ?>'s profile picture" />
							<p class="text-center text-glow-on-hover"><?= $ally['User']['name'] ?></p>
						</a>

						<!-- MODAL USER BIOGRAPHY -->
						<?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'user' => $ally, 'pic' => $pic, 'add_button' => false)); ?>
					</div>

					<?php
						$counter++;
					endforeach;
				else: ?>
					<div data-alert="" class="alert-box radius">
						<?= __('You have no allies! Get started looking at people similar to you!') ?>
					</div><?php
				endif; ?>
			</div>
		</div>

		<!-- LEADERBOARD -->
		<div class="row border-top-divisor">
			<div class="large-6 columns padding top-2 right-2 border-right-divisor">
				<h3><?= __('Leaderboard') ?></h3>
				<?php echo $this->element('leaderboard'); ?>
			</div>

			<div class="large-6 columns padding top-2">
				<h3><?= __('Badges earned') ?>&nbsp;&nbsp;(<?= count($badges) ?>)</h3>
				<?php echo $this->element('badges'); ?>
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