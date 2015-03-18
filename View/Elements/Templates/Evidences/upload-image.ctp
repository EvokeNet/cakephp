<script id="evidence-type-image-template" type="text/x-handlebars-template">
	<!-- IMAGE UPLOAD -->
	<div class="pass text-center centered-block">
		<?php
			echo $this->Form->input('file', array(
				'accept' => 'image/jpeg,image/png',
				'type'   => 'file',
				'label'  => __('Profile picture'),
				'class'  => 'hidden upload-file-input',
				'div'    => false,
				'name' => 'data[Attachment][][attachment]',
				'id' => 'evidence-img-fileinput'
			));
		?>

		<a type="button" class="button thin upload-file-button" id="evidence-img-button" data-file-input-id="evidence-img-fileinput">
			<i class="fa fa-user"></i>
			<?php echo __('Upload'); ?>
		</a>

		<span id="evidence-img-fileinput-filename"> <?= (isset($user['photo_attachment']) ? $user['photo_attachment'] : '') ?></span>
	</div>
</script>