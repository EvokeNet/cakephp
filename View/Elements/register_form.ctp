	<div class="form-evoke-style">
		<?php echo $this->Form->create('User'); ?>

		<div class="medium-6 columns">
			<?php
				echo $this->Form->input('email', array('type' => 'email', 'required' => true, 'label' => __('Email')));
				echo $this->Form->input('email', array('type' => 'email', 'required' => true, 'label' => __('Confirm email')));
				echo $this->Form->input('password', array('required' => true, 'label' => __('Password')));
				echo $this->Form->input('password', array('required' => true, 'label' => __('Confirm Password')));
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
						echo $this->Form->input('birth_dt', array(
						    'label' => 'Date of birth',
						    'dateFormat' => 'DMY',
						    'minYear' => date('Y') - 130,
						    'maxYear' => date('Y'),
						));
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
						    'options' => array('Portuguese','English','Spanish'),
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