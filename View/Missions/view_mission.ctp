<?php 
	//VIEW-MISSION COMMON TEMPLATE
	$this->extend('/Common/view-mission');

	//ELEMENTS
	$this->assign('tabDossierContent', __('This section is not available in preview.'));

	//Evidences
	$this->start('tabEvidencesContent');
	echo "<div id='tabEvidencesContent'></div>";
	//echo $this->element('evidence_list', array('evidences' => $evidences));
	$this->end();
?>

<?php $this->start('script'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#menu-icon-tabEvidences").click(function(){	
			$('#tabEvidencesContent').load('/missions/renderEvidenceList', function(){
				alert('lalala');
			});//, assetData);
			// $.ajax({
			// 	url:'/missions/renderEvidenceList',
			// 	type:"POST",
			// 	data:assetData,
			// 	success: function(data) {
			// 		$('#assetManagerContent').html(data);
			// 	}
			// });
		});
	});
</script>
<?php $this->end(); ?>
