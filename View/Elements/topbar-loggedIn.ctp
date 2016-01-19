<!-- MENU LOGGED IN -->
<ul class="<?php echo isset($ulClass) ? $ulClass : ''; ?>">

	<!-- USER PROFILE PICTURE -->
	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">


			<!-- LEVEL PROGRESS BAR -->
			<li>
				<?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>
			</li>

			<!-- LANGUAGE -->
			<?php echo $this->element('language_switcher'); ?>

			<li class="evoke divider"></li>

			<!-- USER NAME -->
			<li class="active">
				<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $loggedInUser['id'])); ?>"><?= __('Agent ').$loggedInUser['firstname'] ?></a>
			</li>

			<!-- USER PROFILE PICTURE WITH DROPDOWN MENU -->
			<li class="has-dropdown">
				<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $loggedInUser['id'])); ?>" class="button-icon">

						<?= $this->Picture->showUserCircularPicture(
							$loggedInUser,
							'square-40px',
							__("Your profile picture")
						); ?>

				</a>

				<ul class="dropdown">
					<!-- EDIT PROFILE -->
					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $loggedInUser['id'])); ?>" class="text-glow-on-hover text-color-highlight">
							<?php echo __('Edit profile'); ?>
						</a>
					</li>

					<!-- SIGN OUT -->
					<li>
						<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>" class="text-glow-on-hover text-color-highlight">
							<?php echo __('Sign out'); ?>
						</a>
					</li>
				</ul>
			</li>
		</ul>



		<!-- Left Nav Section -->
		<ul class="left">
			<li>
				<div class="column">
					<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="text-glow-on-hover text-color-highlight">
						<?php echo __('Missions'); ?>
					</a>
				</div>
			</li>

			<li>
				<div class="column">
					<a href="<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'index')); ?>" class="text-glow-on-hover text-color-highlight">
						<?php echo __('Forum'); ?>
					</a>
				</div>
			</li>

			<li>
				<div class="column">
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'leaderboard')); ?>" class="text-glow-on-hover text-color-highlight">
						<?php echo __('Leaderboard'); ?>
					</a>
				</div>
			</li>

			<li>
				<div class="column">
					<a href="<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index')); ?>" class="text-glow-on-hover text-color-highlight">
						<?php echo __('Badges'); ?>
					</a>
				</div>
			</li>

			<?php if ($loggedInUser['role'] <= ADMIN){ 
			?>
			<li>
				<div class="column">
					<a href="<?php echo $this->Html->url(array('controller' => 'panels', 'action' => 'main')); ?>" class="text-glow-on-hover text-color-highlight"><?php echo __('Admin'); ?></a>
				</div>
			</li>
			<?php } ?>
		</ul>
	</section>

	<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
	<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
	<!--send to correct address-->
</ul>

<?php echo $this->Form->end(); ?>
<!-- MENU LOGGED IN -->
