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
	<div class="column small-12 medium-4 medium-up padding top-0 left-0 right-5">
		<?php
		if (isset($quest)): ?>
			<!-- QUEST DESCRIPTION -->
			<div class="evidence row background-color-standard padding all-2 margins-auto">
				<h4 class="text-color-darker-gray"><?= __('Quest: ').$quest['Quest']['title'] ?></h4>
				<?= $quest['Quest']['description'] ?>

				<?php
				/* BRAINSTORM */
				if (isset($brainstorm_ideas)) {
					if (isset($brainstorm_ideas) && !empty($brainstorm_ideas)) {
					?>
						<h2 class="text-center text-color-highlight"><?= __('Top 3 ideas') ?></h2>

						<?php
						$count = 1;
						foreach ($brainstorm_ideas as $idea) {
							?>
							<div class="margin top-05 bottom-05">
								#<?= $count++ ?>: <?= $idea[0]['brainstorm_idea__content'] ?>
							</div>
							<?php
						}
						?>
					<?php
					}
				}
				
				?>
				
			</div><?php
		endif;
		?>
	</div>


	<div class="column small-12 medium-8 padding top-3 right-4">
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