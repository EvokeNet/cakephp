<script id="evidence-type-video-template" type="text/x-handlebars-template">
	<?php echo $this->Form->input('main-content', array('label' => __('Video'), 'type' => 'textarea', 'class' => $content_class, 'id' => 'evidenceVideo')); ?>

	<!-- VIDEO UPLOAD -->
	<div class="pass full-width text-center">
		<?php
			echo $this->Form->input('file', array(
				'accept' => 'video/mp4, video/mov',
				'type'   => 'file',
				'label'  => false,
				'class'  => 'hidden upload-file-input',
				'div'    => false,
				'name' => '{{input_file_name}}',
				'id' => 'fileinput-{{id}}'
			));
		?>

		<a class="upload-file-button" id="evidence-img-button" data-file-input-id="fileinput-{{id}}">
			<div id="fileinput-{{id}}-uploadbutton" class="button thin full-width">
				<p class="margin top-2"><i class="fa fa-image fa-4x"></i></p>
				<p><?php echo __("Upload your evidence's video"); ?></p>
			</div>

			<img id="" />
			<div id="fileinput-{{id}}-frame" class="flex-video-new">
				<iframe id="fileinput-{{id}}-filecontent" width="420" height="315" frameborder="0" allowfullscreen></iframe>
			</div>
		</a>
	</div>
</script>