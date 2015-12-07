<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Agent key strengths'), 'imgSrc' => ($this->webroot.'img/header-profile.jpg')));
	$this->end();
?>

<div class="row standard-width">
	<div class="row">
		<div class="medium-12 columns">
			
			<h3><?= __('You are a %s agent!', $superhero['SuperheroIdentity']['name']) ?></h3>
			<p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
			<div class="large-6 medium-6 columns">
				<?php 
					$icons = array(1 => 'fa-puzzle-piece', 2 => 'fa-users', 3 => 'fa-cogs', 4 => 'fa-comments'); 
					$id = $first_quality['SocialInnovatorQuality']['id'];
					$icon = $icons[$id];
				?>
				<div class='row'>
					<div class="large-8 medium-8 columns">

						<p><h4><?= $first_quality['SocialInnovatorQuality']['name'] ?></h4></p>
					</div>
					<div class="large-4 medium-4 columns">
						<i class="fa <?= $icon ?> fa-5x"></i>
					</div>
				</div>	
				<div class='row'>
					<div class="large-8 medium-8 columns">
						<p><?= $first_quality['SocialInnovatorQuality']['description'] ?></p>
					</div>
				</div>

			</div>
			<div class="large-6 medium-6 columns">
				<?php 
					$id = $second_quality['SocialInnovatorQuality']['id'];
					$icon = $icons[$id];
				?>
				
				<div class = 'row'>
					<div class="large-8 medium-8 columns">

						<p><h4><?= $second_quality['SocialInnovatorQuality']['name'] ?></h4></p>
					</div>
					<div class= "large-4 medium-4 columns">
						<i class="fa <?= $icon ?> fa-5x"></i>
					</div>
				</div>	
				<div class = 'row'>
					<div class="large-8 medium-8 columns">
						<p><?= $second_quality['SocialInnovatorQuality']['description'] ?></p>
					</div>
				</div>	
					
			</div>
					
			</div>
			<p><?= __('Continue to explore who you are, who you could be, on your profile page. Or start your mission. Or begin to think about your world chanding idea!') ?></p>
			<div class="text-center">
				<a class="button" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'enter_site')); ?>"><?php echo __('Explore evoke!'); ?></a>
			</div>
		</div>

		<!-- RADAR GRAPH FOR MATCHING RESULTS -->
		<!-- <div class="medium-6 columns centering-block">
			<div class="text-center vertical-align-middle centered-block">
				<h4><?= __('Assessment') ?></h4>
				<?php //echo $this->element('matching_graph', array('height' => '450', 'width' => '500')); ?>
			</div>
		</div> -->
	</div>

	<div class="row">
		<!-- SIMILAR AGENTS TITLE -->
		<div class="small-12 columns margin top-2 bottom-2">
			<?php if (count($similar_users) > 0): ?>
			<h3><?= __('These are agents with a profile similar to yours') ?></h3>
			<p> <?= __('Get started following them: add them as allies!') ?> </p>
			<?php endif; ?>
		</div>

		<!-- SIMILAR AGENTS -->
		<ul class="user-panel large-block-grid-4 medium-block-grid-3 small-block-grid-2" data-equalizer>
			<?php
				$counter = 0;
				foreach($similar_users as $similar_user):
			?>
			<li>
				<!-- PANEL -->
				<!-- <a href="#" data-reveal-id="modalProfile<?= $counter ?>"> -->
				
					<div class="profile-content panel radius text-center margin right-05" data-equalizer-watch>
						<!-- USER PICTURE -->
						<?= $this->Picture->showUserCircularPicture(
							$similar_user['User'],
							'square-150px',
							__("%s's profile picture",$similar_user['User']['name'])
						); ?>

						<!-- USER SHORT BIOGRAPHY -->
						<h4 class="text-color-highlight"><?= $similar_user['User']['name'] ?></h4>

						<?php
						//Has mini_biography
						if (!empty($similar_user['User']['mini_biography'])): ?>
							<p><?= $similar_user['User']['mini_biography'] ?></p>
						<?php
						//Has biography
						elseif (!empty($similar_user['User']['biography'])): ?>
							<p><?= $this->Text->getExcerpt($similar_user['User']['biography'], 30, '...') ?></p>
						<?php
						//Doesn't have anything
						else: ?>
							<div data-alert="" class="alert-box radius">
								<?= __('This user has not added a biography yet.') ?>
							</div> <?php
						endif;
						?>

						<!-- ADD AS AN ALLY -->
						<?php if(!in_array($similar_user['User']['id'], $friends_ids) && ($similar_user['User']['id'] != $loggedInUser['id'])): ?>
							<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $similar_user['User']['id'], $loggedInUser['id'], false)); ?>" target="_blank" onclick="location.reload()">
								<i class="fa fa-plus"></i>
								<?= __('Add as ally') ?>
							</a>
						
						<!-- ALREADY AN ALLY -->
						<?php elseif(in_array($similar_user['User']['id'], $friends_ids) && ($similar_user['User']['id'] != $loggedInUser['id'])): ?>
							<a class="button small disabled">
								<i class="fa fa-check"></i>
								<?= __('Your ally') ?>
							</a>
						<?php endif; ?>

						<!-- <button class="submit small "><?php echo __('View Agent'); ?></button> -->
					</div>
				<!-- </a> -->

				<!-- VIEW AGENT DETAILS MODAL -->
				<?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'user' => $similar_user, 'add_button' => true)); ?>
			</li>
			<?php
					$counter++;
				endforeach;
			?>
		</ul>
	</div>
</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/matching_results.js', array('inline' => false));
?>