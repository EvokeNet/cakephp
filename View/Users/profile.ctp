<?php
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Profile'), 'imgSrc' => ($this->webroot.'img/header-profile.jpg'), 'margin' => false));
	$this->end();
?>

<div class="evoke row background-color-standard full-width" data-equalizer data-equalizer-mq="large-up">
	<!-- LEFT SIDEBAR -->
	<div class="small-12 medium-5 large-3 columns gradient-on-right profile-sidebar" data-equalizer-watch>
		<!-- PROFILE -->
		<div class="row padding top-2 bottom-1 left-2 right-2">

			<!-- PICTURE -->
			<?= $this->Picture->showUserCircularPicture(
				$user['User'],
				'square-150px',
				__("Your profile picture")
			); ?>

			<!-- NAME -->
			<h4 class="text-color-highlight text-center margin top-1"><?= $user['User']['name'] ?></h4>

			<!-- ALLIANCE -->
			<div class="padding top-1 text-center">
				<!-- ADD AS AN ALLY -->
				<?php if(empty($is_friend) && ($user['User']['id'] != $users['User']['id'])): ?>
					<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $user['User']['id'], $loggedInUser['id'], false)); ?>">
						<i class="fa fa-plus"></i>
						<?= __('Add as ally') ?>
					</a>

				<!-- ALREADY AN ALLY -->
				<?php elseif(!empty($is_friend) && ($user['User']['id'] != $users['User']['id'])): ?>
					<a class="button small disabled">
						<i class="fa fa-check"></i>
						<?= __('Your ally') ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- BIOGRAPHY -->
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
			<?php echo $this->element('social_networks_bar', array('social_networks_user' => $user['User'])) ?>
		</div>

		<!-- LEVEL -->
		<div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor">
			<?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>
		</div>

		<!-- POTENTIAL ALLIES -->
		<?php
		//Show only in my profile
		if ($user['User']['id'] == $users['User']['id']): ?>
			<div class="row hide-for-small-only padding top-1 bottom-1 left-2 right-2 border-top-divisor">
				<h4><?= __('Potential allies') ?></h4>

				<ul class="full-width small-block-grid-1">
				  <?php
					$counter = 0;
					foreach($similar_users as $similar_user): ?>

						<li>
							<!-- PANEL -->
							<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $similar_user['User']['id'], false)); ?>">

								<div class="table full-width profile-content padding top-1">
									<!-- USER PICTURE -->
						          	<div class="table-cell vertical-align-middle square-40px">
									<?= $this->Picture->showUserCircularPicture(
										$similar_user['User'],
										'square-40px',
										__("%s's profile picture",$similar_user['User']['name'])
									); ?>
									</div>

									<!-- USER INFO -->
									<div class="table-cell vertical-align-middle padding left-1">
										<p class="user-name margins-0">
											<?= $similar_user['User']['name'] ?>
										</p>

										<small>Level <?= $similar_user['User']['level'] ?></small>
									</div>
								</div>
							</a>

							<!-- VIEW AGENT DETAILS MODAL -->
							<?php echo $this->element('user_biography', array('modal' => true, 'counter' => 'PotentialAllies'.$counter, 'user' => $similar_user, 'add_button' => true)); ?>
						</li>

					<?php
						$counter++;
					endforeach;
					?>
				</ul>


				<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view_all')); ?>"><?php echo __('SEE ALL USERS'); ?></a>
			</div>

			<?php
		endif;
		?>
	</div>

	<!-- CENTER -->
	<div class="small-12 medium-7 large-9 columns padding top-2 bottom-2 left-2 right-2" data-equalizer-watch>
		<div class="row standard-width">
			<div class="columns">
				<div class = "row">
					<div class="columns text-center">
						<h3><?= __('You are: %s agent!', $superhero['SuperheroIdentity']['name']) ?></h3>
						<p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
					</div>
				</div>
				<div class="medium-6 columns">
					<?php 
						$icons = array(1 => 'fa-puzzle-piece', 2 => 'fa-users', 3 => 'fa-cogs', 4 => 'fa-comments'); 
						$id = $first_quality['SocialInnovatorQuality']['id'];
						$icon = $icons[$id];
					?>
					<div class='row'>
						<div class="medium-12 columns text-center">
							<i class="fa <?= $icon ?> fa-5x"></i>
						</div>
					</div>	

					<div class='row'>
						<div class="medium-12 columns">

							<p><h4><?= $first_quality['SocialInnovatorQuality']['name'] ?></h4></p>
						</div>
					</div>
					
					<div class='row'>
						<div class="medium-12 columns">
							<p><?= $first_quality['SocialInnovatorQuality']['description'] ?></p>
						</div>
					</div>

				</div>
				<div class="large-6 medium-6 columns">
					<?php 
						$id = $second_quality['SocialInnovatorQuality']['id'];
						$icon = $icons[$id];
					?>
					
					<div class='row'>
						<div class="medium-12 columns text-center">
							<i class="fa <?= $icon ?> fa-5x"></i>
						</div>
					</div>	

					<div class='row'>
						<div class="medium-12 columns">

							<p><h4><?= $second_quality['SocialInnovatorQuality']['name'] ?></h4></p>
						</div>
					</div>
					
					<div class='row'>
						<div class="medium-12 columns">
							<p><?= $second_quality['SocialInnovatorQuality']['description'] ?></p>
						</div>
					</div>
						
				</div>
				<br>
				<br>
				<p><?= __('Continue to explore who you are, who you could be, on your profile page. Or start your mission. Or begin to think about your world chanding idea!') ?></p>
				<div class="text-center">
					<a class="button" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'enter_site')); ?>"><?php echo __('Explore evoke!'); ?></a>
				</div>
			
			</div>
		</div>
		<br>
		<br>
		<!-- BIOGRAPHY -->
		<div class="row border-top-divisor">
			<div class="small-12 columns margin top-2 bottom-2">
				<h3><?= __('About') ?></h3>
				<?php
				//Has biography
				if (!empty($user['User']['biography'])):
					echo $user['User']['biography'];

				//Doesn't have biography and it's not me
				elseif ($user['User']['id'] != $users['User']['id']): ?>
					<div data-alert="" class="alert-box radius">
						<?= __('This user has not added a biography yet.') ?>
					</div>
					<?php

				//Doesn't have biography and it's me
				else: ?>
					<div data-alert="" class="alert-box radius">
						<?= __('You have not added a biography yet!') ?>
					</div>
					<div class="text-center">
						<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>"><?php echo __('Complete your profile!'); ?></a>
					</div>
					<?php
				endif;
				?>
			</div>
		</div>

		<!-- ALLIES -->
		<div class="row border-top-divisor">
			<div class="small-12 columns margin top-2">

				<div class="row margins-0">
					<h3 class="left margin right-2"><?= __("Allies I follow") ?></h3>

					<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view_all')); ?>"><?php echo __('SEE ALL USERS'); ?></a>
				</div>


				<!-- ALLIES GRID -->
				<?php
				//Has allies
				if (count($friends) > 0): ?>
					<ul class="large-block-grid-6 medium-block-grid-3 small-block-grid-2 no-marker">

					<?php
						$counter = 0;
						foreach($friends as $ally):
							 ?>
							<li class="text-center">
								<!-- PICTURE -->

								<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['Friend']['id'], false)); ?>">

									<?= $this->Picture->showUserCircularPicture(
										$ally['Friend'],
										'square-60px',
										__("%s's profile picture",$ally['Friend']['name'])
									); ?>

									<p class="text-center text-glow-on-hover"><?= $ally['Friend']['name'] ?></p>
								</a>

								<!-- MODAL USER BIOGRAPHY -->
								<?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'user' => $ally, 'add_button' => false)); ?>
							</li>
						<?php
							$counter++;
						endforeach;
					?>

					</ul> <?php

				//Doesn't have allies and it's not me
				elseif ($user['User']['id'] != $users['User']['id']): ?>
					<div data-alert="" class="alert-box radius">
						<?= __('This user has no allies yet.') ?>
					</div><?php

				//Doesn't have allies and it's me
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
</div>

<?php
	//JAVASCRIPT VARIABLES
	$this->start('evoke_javascript_variables');

		echo "evokeData.webroot = 'TESTE';";
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/profile.js', array('inline' => false));
?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>
