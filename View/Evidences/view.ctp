<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->

<?php echo $this->element('Evidences/evidence_view', array('show_breadcrumbs'=>true)); ?>