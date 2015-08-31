	<div class="form-evoke-style">
		<?php echo $this->Form->create('User', array('type' => 'file', 'url' => array('controller' => 'users', 'action' => 'register'))); ?>

		<div class="medium-6 columns">
			<?php
				echo $this->Form->input('email', array('type' => 'email', 'required' => true, 'label' => __('Email'), 'errorMessage' => __('Please verify your email address'), 'error' => array(
			        'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
			    )));
				echo $this->Form->input('password', array('type' => 'password', 'required' => true, 'label' => __('Password')));
				echo $this->Form->input('confirm_password', array('type' => 'password', 'required' => true, 'label' => __('Confirm Password')));

				?>

				<!-- PROFILE PICTURE UPLOAD -->
				<div class="pass"> 
					<?php
						echo $this->Form->input('file', array(
							'accept' => 'image/jpeg,image/png',
							'type'   => 'file',
							'label'  => __('Profile picture'),
							'class'  => 'hidden upload-file-input',
							'div'    => false,
							'name' => 'data[Attachment][][attachment]',
							'id' => 'upload-profile-img-fileinput'
						));
					?>

					<a type="button" class="button thin upload-file-button" id="upload-profile-img-button" data-file-input-id="upload-profile-img-fileinput">
						<i class="fa fa-user"></i>
						<?php echo __('Upload'); ?>
					</a>

					<span id="upload-profile-img-fileinput-filename"> <?= (isset($user['photo_attachment']) ? $user['photo_attachment'] : '') ?></span>
				</div>
		</div>

		<div class="medium-6 columns">
			<!-- NAME -->
			<div class="row">
				<div class="large-6 columns">
					<?php
						echo $this->Form->input('firstname', array('required' => true, 'label' => __('First name')));
					?>
				</div>
				<div class="large-6 columns">
					<?php
						echo $this->Form->input('lastname', array('required' => true, 'label' => __('Last name')));
					?>
				</div>
			</div>

			<!-- USERNAME -->
			<div class="small-12">
				<?php
				echo $this->Form->input('username', array('required' => true, 'label' => __('Username')));
				?>
			</div>

			<!-- ADDITIONAL INFO -->
			<div class="row">
				<div class="large-6 columns">
					<!-- DATE OF BIRTH -->
					<?php
						echo $this->Form->input('birthdate', array(
							'required' => true,
						    'label' => 'Date of birth',
						    'dateFormat' => 'DMY',
						    'minYear' => date('Y') - 130,
						    'maxYear' => date('Y'),
								'empty'=> true,
								'separator' => '&nbsp;&nbsp;',
								'style' => 'width:auto'
						));
					?>
					<!-- COUNTRY -->
					<?php
						echo $this->Form->input('country', array(
								'options' => array('Colombia','Brasil','USA','South Africa','China','Sweden','Other'),
								'empty' => '(choose one)'
						));
					?>
				</div>
				<div class="large-6 columns">
					<!-- LANGUAGE -->
					<?php
						echo $this->Form->input('language', array(
							'options' => array(
								'es' => __('Spanish'),
								'pt_BR' => __('Portuguese'),
								'en' => __('English')
							),
							'empty' => '(choose one)'
						));
					?>

					<!-- SIGN UP BUTTON -->
					<button class="button small full-width margin top-05 bottom-0" type="submit"><?php echo __('Sign up') ?></button>

					<p class="text-right"><small class="text-color-highlight"><?php echo __('Already an agent? Sign in on the top bar!') ?></small></p>
				</div>
			</div>


		</div>
		<?php echo $this->Form->end(); ?>
	</div>

<?php
	//SCRIPT
	$this->Html->script('requirejs/app/file_upload.js', array('inline' => false));
?>