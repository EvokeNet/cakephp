<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->

<?php echo $this->element('Evidences/view-evidence', array('show_breadcrumbs'=>true)); ?>


<?php
	//JAVASCRIPT VARIABLES
	$this->start('evoke_javascript_variables');
		$evidence_view_url = $this->Html->url(array('controller' => 'evidences', 'action' => 'view', $evidence['Evidence']['id']));
		echo "evokeData.evidence_view_url = '$evidence_view_url';";
	$this->end();

	//FOOTER
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>