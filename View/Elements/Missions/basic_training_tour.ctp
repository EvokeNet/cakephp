<ol class="joyride-list" data-joyride>
	<li data-text="Begin Tour">
		<p>Before you start, take a quick tour of what you can do!</p>
	</li>
	<li data-tab="tabQuests" data-id="menu-icon-tabQuests" data-text="Next" data-options="prev_button: false">
		<p>Complete Quests</p>
	</li>
	<li data-text="Next">
		<p>Here you will get quests to fufill.</p>
	</li>
	<li data-id="menu-icon-tabEvidences" data-class="custom so-awesome" data-text="Next" data-prev-text="Prev">
		<p>Review the evidence others have gathered.</p>
	</li>
	<li data-text="Next">
		<p>Here you can see and comment on the evidence gathered by your fellow agents.</p>
	</li>
	<li data-id="menu-icon-tabDossier" data-button="Next" data-prev-text="Prev" data-options="">
		<p>Keep track of what you've accomplished!</p>
	</li>
	<li data-text="Next">
		<p>This is where you can review the evidence you have submitted for a mission.</p>
	</li>
	<li data-button="End" data-prev-text="Prev">
		<p>
			Now you're ready to be a full Evoke Net Agent!
			Feel free to explore this mission more to familiarize yourself with how things work,
			or you can continue onto your first mission!
		</p>
	</li>
</ol>

<?php $this->HTML->script('requirejs/app/Elements/Missions/basic_training_tour.js',
													array('inline' => false)) ?>
