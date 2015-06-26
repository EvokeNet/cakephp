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

<div class="evidence row full-width padding top-4 full-height">


	<div class="column small-12 medium-4 medium-up position-fixed padding top-0 left-0 right-5 full-height">
		<?php
		if (isset($quest)): ?>
			<!-- QUEST DESCRIPTION -->
			<div class="evidence row background-color-standard padding all-2 margins-auto full-height-vh">
				<h4 class="text-color-darker-gray"><?= __('Quest: ').$quest['Quest']['title'] ?></h4>
				<?= $quest['Quest']['description'] ?>

				<!-- BADGES -->
				<h5 class="text-color-darker-gray text-center"><?= __('REWARDS') ?></h5>
				<p class="text-center"><?= __('Submitting an '.$element_title.' for this quest is worth 3 badges:') ?></p>
				<p class="text-center">
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge1.png' ?>" alt="Quests" />
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge2.png' ?>" alt="Quests" />
					<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge3.png' ?>" alt="Quests" />
				</p>
			</div><?php
		endif;
		?>
	</div>


	<div class="column small-12 medium-8 padding top-3 right-4">
		<!-- TITLE -->
		<h1 class="text-glow text-center">
			<?= __('Edit your '.$element_title) ?>
		</h1>

		<!-- DELETE EVIDENCE LINK -->
		<div class="row padding top-1 bottom-1 text-center font-size-small">
			<a id="buttonDeleteEvidence" href="<?php echo $this->Html->url(array('controller'=> 'evidences', 'action' => 'delete', $evidence['Evidence']['id'])); ?>" alt="<?= __('Delete '.$element_title) ?>" class="button thin">
				<?php echo __('Delete '.$element_title);?>
			</a>
		</div>

		<!-- FORM -->
		<?php
		echo $this->element('Evidences/evidence_form', array('evidence' => $evidence['Evidence']));
		?>
	</div>
</div>
