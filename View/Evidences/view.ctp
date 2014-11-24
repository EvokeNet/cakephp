<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->

<?php echo $this->element('Evidences/view-evidence', array('show_breadcrumbs'=>true)); ?>


<?php
	//FOOTER
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evidences/view-evidence.js', array('inline' => false));
?>