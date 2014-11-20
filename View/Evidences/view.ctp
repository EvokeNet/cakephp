<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->

<?php echo $this->element('Evidences/view-evidence', array('show_breadcrumbs'=>true)); ?>

<!-- SCRIPT -->
<?php
	$this->start('script');
	//FROALA EDITOR
	echo $this->Html->script('/components/FroalaWysiwygEditor/js/froala_editor.min.js'); ?>

<script type="text/javascript">
	//--------------------------------------------//
	//FROALA EDITOR
	//--------------------------------------------//
	$(function() {
		$('#newCommentForm').editable({
			inlineMode: false,
			tabSpaces: true,
			theme: 'dark'
		});
	});
</script>
<?php $this->end(); ?>