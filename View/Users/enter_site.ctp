<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Explore Evoke', 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>

<div class="row standard-width text-center margin bottom-2">
	<ul class="large-block-grid-3 medium-block-grid-1" data-equalizer>
		<!-- OPTION 1 - PROFILE -->
		<li>
			<div class="table background-color-light-dark padding all-2" data-equalizer-watch>
				<div class="table-cell vertical-align-middle padding right-1">
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $user_id)); ?>">
						<img class="img-circular border-width-02 border-style-solid border-color-highlight img-glow-on-hover-small"
						src="<?= $this->webroot.'img/thumb-badges.jpg' ?>" alt="<?= __('Create your superhero identity') ?>" />
					</a>
				</div>
				<div class="table-cell vertical-align-middle text-center">
					<h4 class="text-color-highlight uppercase"><?= __('Option 1') ?></h4>
					<p><?= __('Create your superhero identity and build your network') ?></p>
					<a class="button thin" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $user_id)); ?>"><?= __('GO') ?></a>
				</div>
			</div>
		</li>

		<!-- OPTION 2 - MISSIONS -->
		<li>
			<div class="table background-color-light-dark padding all-1" data-equalizer-watch>
				<div class="table-cell vertical-align-middle padding right-1">
					<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>">
						<img class="img-circular border-width-02 border-style-solid border-color-highlight img-glow-on-hover-small"
						src="<?= $this->webroot.'img/thumb-engage.jpg' ?>" alt="<?= __('Engage in a mission') ?>" />
					</a>
				</div>
				<div class="table-cell vertical-align-middle text-center">
					<h4 class="text-color-highlight uppercase"><?= __('Option 2') ?></h4>
					<p><?= __('Engage in a mission and build skills') ?></p>
					<a class="button thin" href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>"><?= __('GO') ?></a>
				</div>
			</div>
		</li>

		<!-- OPTION 3 - EVOKATION -->
		<li>
			<div class="table background-color-light-dark padding all-1" data-equalizer-watch>
				<div class="table-cell vertical-align-middle padding right-1">
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'evokation')); ?>">
						<img class="img-circular border-width-02 border-style-solid border-color-highlight img-glow-on-hover-small"
						src="<?= $this->webroot.'img/thumb-quests.jpg' ?>" alt="<?= __('Create your evokation') ?>" />
					</a>
				</div>
				<div class="table-cell vertical-align-middle text-center">
					<h4 class="text-color-highlight uppercase"><?= __('Option 3') ?></h4>
					<p><?= __('Create your evokation') ?></p>
					<a class="button thin" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'evokation')); ?>"><?= __('GO') ?></a>
				</div>
			</div>
		</li>
	</ul>
</div>


<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>