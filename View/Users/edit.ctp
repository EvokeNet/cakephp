<?php

	echo $this->Html->css('/components/jquery-ui/themes/smoothness/jquery-ui.css');

	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Edit Profile', 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>

<div class="evoke row standard-width">
	<div class="form-evoke-style">
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'edit'), 'data-abide')); ?>

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
					<?php
						echo $this->Form->input('language', array(
								'options' => array('portuguese' => __('Portuguese'), 'english' => __('English'), 'spanish' => __('Spanish')),
								'empty' => '(choose one)'
						));

						echo $this->Form->input('birthdate', array(
								'label' => 'Date of birth',
								'dateFormat' => 'DMY',
								'minYear' => date('Y') - 130,
								'maxYear' => date('Y'),
								'empty'=> true,
								'separator' => '&nbsp;&nbsp;',
								'style' => 'width:auto'
						));

					?>
				</div>
				<div class="large-6 columns">
					<?php
						echo $this->Form->input('country', array(
								'options' => array('Brasil','USA','South Africa','Colombia'),
								'empty' => '(choose one)'
						));
					?>
				</div>

			</div>

			<div class="small-12">
				<?php
					echo $this->Form->input('biography', array('required' => true, 'label' => __('Biography')));
				?>
			</div>

		</div>

		<div class="medium-6 columns">

			<div class="row">
				<div class="large-6 columns">
					<?php
						echo $this->Form->input('facebook', array('label' => __('Facebook')));
					?>
				</div>
				<div class="large-6 columns">
					<?php
						echo $this->Form->input('twitter', array('label' => __('Twitter')));
					?>
				</div>
			</div>

			<div class="row">
				<div class="large-6 columns">
					<?php
						echo $this->Form->input('google_plus', array('label' => __('Google Plus')));
					?>
				</div>
				<div class="large-6 columns">
					<?php
						echo $this->Form->input('instagram', array('label' => __('Instagram')));
					?>
				</div>
			</div>

			<?php
				echo $this->Form->input('website', array('label' => __('Personal Site')));
				echo $this->Form->input('blog', array('label' => __('Blog')));
			?>


			<label for="UserMiniBiography" style = "display: inline;"><?= __('Mini bio') ?></label>&nbsp;
			<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= ('The mini bio is a text up to 140 characters') ?>"><i class="fa fa-question-circle"></i></span>
			<?php echo $this->Form->input('mini_biography', array(
				// 'label' => array('class' => 'display-inline', 'text' => __('Mini bio')),
				'label' => false,
				'id' => 'counttextarea',
				'cols' => '45',
				'rows' => '6',
				'maxlength' => '140'
				));
			?>
			<div class = "ending-block"><span name="countchars" id="countchars"></span><?= __(' Characters Remaining') ?></div><br><br>

		</div>
	</div>
</div>

<div class="row">
  <div class="small-7 small-centered columns"><button class="button small full-width margin top-05 bottom-0" type="submit"><?php echo __('Save') ?></button><br><br></div>
</div>

<?php echo $this->Form->end(); ?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/edit.js', array('inline' => false));
?>