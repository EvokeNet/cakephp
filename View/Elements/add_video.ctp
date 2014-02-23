<h3>Add video</h3>

<?php

	echo $this->Form->create();
		echo $this->Form->input('title', array(
			'label' => '',
			'type' => 'text',
			'placeholder' => 'Insert video title here'
		));
		echo $this->Form->input('embed', array(
			'label' => '',
			'type' => 'textarea',
			'placeholder' => 'Insert video <embed> code here'
		));
		echo $this->Html->tag(
			'span',
			'or',
			array('class' => 'text-center')
		);
		echo $this->Form->input('video', array(
			'label' => '',
			'type' => 'file',
			'class' => 'hidden',
			'id' => 'video_upload'
		));
		echo $this->Html->link(
			'Pick a file',
			'#',
			array('class' => 'button secondary black file btn', 'id' => 'f_video_upload')
		);
		echo $this->Html->tag(
			'div',
			'Select a file from your computer',
			array('class' => 'file path gray f_file_path')
		);
	echo $this->Form->end(array(
		'class' => 'button expand',
		'label' => 'Submit'
	));

?>

<?php echo $this->Html->script('/components/jquery/jquery.min'); ?>

<script type="text/javascript">

	$("#f_video_upload, .f_file_path").click(function() {
		$("#video_upload").click();
	});

	$("#video_upload").change(function() {
		if($(this).val !== '') {
			var filename = $(this).val().split('\\');
			if(filename[2]) {
				$(".f_file_path").html(filename[2]);
			} else {
				$(".f_file_path").html($(this).val());
			}
		}
	});

	$(document).on('closed', '[data-reveal]', function () {
		var modal = $(this);
		modal.children('form').trigger("reset");
		$(".f_file_path").html("Select a file from your computer");
	});

</script>