	<div class="form-evoke-style">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'register'))); ?>

		<div class="medium-6 columns">
			<?php
				echo $this->Form->input('email', array('type' => 'email', 'required' => true, 'label' => __('Email')));
				echo $this->Form->input('password', array('type' => 'password', 'required' => true, 'label' => __('Password')));
				echo $this->Form->input('confirm_password', array('type' => 'password', 'required' => true, 'label' => __('Confirm Password')));
			?>
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

						// echo $this->Form->input('birth_dt', array(
						// 	'type' => 'date',
						// 	'label' => 'Expiration Date',
						// 	'dateFormat' => 'MDY',
						// 	'empty' => true,
						// 	'separator' => '&nbsp;',
						// 	'minYear' => date('Y') - 114,
						// 	'maxYear' => date('Y')));
					?>
					<!-- COUNTRY -->
					<?php
						echo $this->Form->input('country', array(
						    'options' => array('Brasil','USA','South Africa','Colombia'),
						    'empty' => '(choose one)'
						));
					?>
				</div>
				<div class="large-6 columns">
					<!-- LANGUAGE -->
					<?php
						echo $this->Form->input('language', array(
							'required' => true,
						    'options' => array('portuguese' => __('Portuguese'), 'english' => __('English'), 'spanish' => __('Spanish')),
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
		<?php
			// echo $this->Html->script('/components/jquery/dist/jquery.js');
			// echo $this->Html->script('/components/jquery-ui/ui/datepicker.js');
		?>
	</div>

	<?php $this->start('script'); ?>
	<script>
		// $(function() {
		// 	$( "#datepicker" ).datepicker();
		// });
	</script>
	<?php $this->end(); ?>
