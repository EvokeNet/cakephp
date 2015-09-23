<!-- 
	THIS IS THE FILE FOR THE 'PURE' EVOKATION PART,
	THAT IS, AN EVOKATION PART THAT WAS NOT PRESENTED
	IN THE PREVIOUS PHASE (ACT)
-->

<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->

<?php
$element_title = 'evidence';
if (isset($evokation_part) && ($evokation_part)) {
	$element_title = 'evokation part';
}
?>

<div class="evidence row full-width padding top-4 min-full-height">


	<div class="column small-12 medium-4 medium-up position-fixed padding top-0 left-0 right-5 min-full-height">
		<?php
		if (isset($quest)): ?>
			<!-- QUEST DESCRIPTION -->
			<div class="evidence row background-color-standard padding all-2 margins-auto min-full-height">
				<h4 class="text-color-darker-gray"><?= __('Quest: ').$quest['Quest']['title'] ?></h4>
				<?= $quest['Quest']['description'] ?>

				<!-- BADGES -->
				<h5 class="text-color-darker-gray text-center"><?= __('REWARDS') ?></h5>
				<p class="text-center"><?= __('Submitting an %s for this quest is worth 3 badges:', $element_title) ?></p>
				<p class="text-center">
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge1.png' ?>" alt="Quests" />
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge2.png' ?>" alt="Quests" />
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge3.png' ?>" alt="Quests" />
				</p>
			</div><?php
		endif;
		?>
	</div>


	<div class="column small-12 medium-8 padding top-3 right-4 min-full-height">
		<!-- TITLE -->
		<h1 class="text-glow text-center">
			<?= __('Create your '.$element_title) ?>
		</h1>

		<!-- FORM -->
		<?php
		if (!isset($loggedIn) || (!$loggedIn)) {
			echo $this->element('Evidences/evidence_form', array('sample_form' => true));
		}
		else {
			echo $this->element('Evidences/evidence_form');
		}
			
		?>
	</div>
</div>


<?php
	//FOOTER
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>