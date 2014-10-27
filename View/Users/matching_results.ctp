<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Agent key strengths', 'imgSrc' => ($this->webroot.'img/header-profile.jpg')));
	$this->end();
?>

<div class="standard-width">
	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'enter_site')); ?>">
		<img src="<?= $this->webroot.'img/mockup-4-matching-results.jpg' ?>" class="full-width" />
	</a>
</div>

<div class="row standard-width">
	<div class="row">
		<div class="medium-6 columns">
			<h3><?= __('You are an entrepreneurial agent!') ?></h3>
		</div>
		<div class="medium-6 columns">
			GRAPH HERE
		</div>
	</div>
	<div class="row">
		<h3><?= __('These are agents with a profile similar to yours') ?></h3>

		<div class="row">
			<div class="large-2 medium-4 small-6 columns background-color-standard">
				<p class="font-highlight text-color-highlight"><?= __('David Brooks') ?></p>
				<p>Musician. Interested in solving problems related to nature and environmental risks.</p>
				<button class="submit small"><?php echo __('View Agent'); ?></button>
			</div>

			<div class="large-2 medium-4 small-6 columns">
				<p class="font-highlight text-color-highlight"><?= __('David Brooks') ?></p>
				<p>Musician. Interested in solving problems related to nature and environmental risks.</p>
				<button class="submit small"><?php echo __('View Agent'); ?></button>
			</div>

			<div class="large-2 medium-4 small-6 columns">
				<p class="font-highlight text-color-highlight"><?= __('David Brooks') ?></p>
				<p>Musician. Interested in solving problems related to nature and environmental risks.</p>
				<button class="submit small"><?php echo __('View Agent'); ?></button>
			</div>

			<div class="large-2 medium-4 small-6 columns">
				<p class="font-highlight text-color-highlight"><?= __('David Brooks') ?></p>
				<p>Musician. Interested in solving problems related to nature and environmental risks.</p>
				<button class="submit small"><?php echo __('View Agent'); ?></button>
			</div>

			<div class="large-2 medium-4 small-6 columns">
				<p class="font-highlight text-color-highlight"><?= __('David Brooks') ?></p>
				<p>Musician. Interested in solving problems related to nature and environmental risks.</p>
				<button class="submit small"><?php echo __('View Agent'); ?></button>
			</div>

			<div class="large-2 medium-4 small-6 columns">
				<p class="font-highlight text-color-highlight"><?= __('David Brooks') ?></p>
				<p>Musician. Interested in solving problems related to nature and environmental risks.</p>
				<button class="submit small"><?php echo __('View Agent'); ?></button>
			</div>

		</div>
	</div>
</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>