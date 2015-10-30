<!-- Joyride step list start -->
<ol class="joyride-list" data-joyride>
	<li data-text="Begin Tour">
		<p><?= __('Hello '.$user['name'].'! Welcome to your Basic Training to become an active agent') ?></p>
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
			<h4><?= __('Good luck!') ?></h4>
			<p><?= __("Now, go out there and become an agent of change!") ?></p>
		</p>
	</li>
</ol>
<!-- Joyride step list end -->

<?php $this->HTML->script('requirejs/app/Elements/Missions/basic_training_tour.js',
													array('inline' => false)) ?>
