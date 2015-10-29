<ol class="joyride-list" data-joyride>
	<li data-id="menu-icon-tabQuests" data-text="Next" data-options="tip_location: top; prev_button: false">
		<p>Hello and welcome to the Joyride <br>documentation page.</p>
	</li>
	<li data-id="menu-icon-tabEvidences" data-class="custom so-awesome" data-text="Next" data-prev-text="Prev">
		<h4>Stop #1</h4>
		<p>You can control all the details for you tour stop. Any valid HTML will work inside of Joyride.</p>
	</li>
	<li data-id="menu-icon-tabDossier" data-button="Next" data-prev-text="Prev" data-options="tip_location:top;tip_animation:fade">
		<h4>Stop #2</h4>
		<p>Get the details right by styling Joyride with a custom stylesheet!</p>
	</li>
	<li data-button="End" data-prev-text="Prev">
		<h4>Stop #3</h4>
		<p>It works as a modal too!</p>
	</li>
</ol>

<?php $this->HTML->script('requirejs/app/Elements/Missions/basic_training_tour.js',
													array('inline' => false)) ?>
