<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->

<div class="<?= (!$ajax) ? 'row standard-width' : '' ?>">
	<?php
		echo $this->element('Evidences/evidence_form', array('evidence' => $me['Evidence']));
	?>
</div>


<?php
	//FOOTER
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>