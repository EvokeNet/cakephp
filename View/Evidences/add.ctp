<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->



<div class="row standard-width padding all-1">
	<!-- TITLE -->
	<h1 class="text-glow text-center">
		<?= __('Create your evidence') ?>
	</h1>


	<?php
	if (isset($quest)): ?>
		<!-- QUEST DESCRIPTION -->
		<div class="row small-width background-color-standard padding all-2 margin top-2 margins-auto">
			<h4><?= __('Quest: ').$quest['Quest']['title'] ?></h4>
			<?= $quest['Quest']['description'] ?>
		</div><?php
	endif;
	?>

	<!-- FORM -->
	<?php
		echo $this->element('Evidences/evidence_form');
	?>
</div>


<?php
	//FOOTER
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>