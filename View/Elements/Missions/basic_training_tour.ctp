<!-- Joyride step list start -->
<ol class="joyride-list" data-joyride>
	<li data-text="Begin Tour">
		<p><?php echo __('Before you start, take a quick tour of what you can do!') ?></p>
	</li>
	<li data-tab="tabQuests" data-id="menu-icon-tabQuests" data-text="Next" data-options="prev_button: false">
		<p><?php echo __('Complete Quests') ?></p>
	</li>
	<li data-text="Next">
		<p><?php echo __('Here you will get quests to fufill.') ?></p>
	</li>
	<li data-id="menu-icon-tabEvidences" data-text="Next" data-prev-text="Prev">
		<p><?php echo __('Review the evidence others have gathered.') ?></p>
	</li>
	<li data-text="Next">
		<p><?php echo __('Here you can see and comment on the evidence gathered by your fellow agents.') ?></p>
	</li>
	<li data-id="menu-icon-tabDossier" data-button="Next" data-prev-text="Prev">
		<p><?php echo __('Keep track of what you\'ve accomplished!') ?></p>
	</li>
	<li data-text="Next">
		<p><?php echo __('This is where you can review the evidence you have submitted for a mission.') ?></p>
	</li>
	<li data-button="End" data-prev-text="Prev">
		<p>
			<?php echo __('
				Now you\'re ready to be an Evoke Net Agent!
				Feel free to explore this mission more to familiarize yourself with how things work,
				or you can continue onto your first mission!
			') ?>
		</p>
	</li>
</ol>
<!-- Joyride step list end -->

<?php $this->HTML->script('requirejs/app/Elements/Missions/basic_training_tour.js',
													array('inline' => false)) ?>
