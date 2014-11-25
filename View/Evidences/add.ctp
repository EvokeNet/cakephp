<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->



<div class="row standard-width padding all-1">
	<!-- TITLE -->
	<h1 class="text-glow">
		<?= __('Create your evidence') ?>
	</h1>

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