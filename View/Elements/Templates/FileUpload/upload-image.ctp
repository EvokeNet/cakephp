<script id="evidence-type-image-template" type="text/x-handlebars-template">
	<!-- IMAGE UPLOAD -->
	<div class="pass full-width text-center">
		<?php
			echo $this->Form->input('file', array(
				'accept' => 'image/jpeg,image/png',
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
				<p><?php echo __("Upload your evidence's image"); ?></p>
			</div>

			<img id="fileinput-{{id}}-filecontent" />
		</a>
	</div>
</script>