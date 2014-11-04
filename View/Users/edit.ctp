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

<!-- <div class="row">
	<div class="small-7 small-centered columns">
		<div class = "evoke text-align">
			<?php if(empty($user_photo)) :?>
				<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"/>
			<?php else : ?>
				<img src="<?= $this->webroot.'files/attachment/attachment/'.$user_photo['Attachment']['dir'].'/thumb_'.$user_photo['Attachment']['attachment'] ?>"/>
			<?php endif; ?>
		</div>
		<div id="uploader" class = "evoke text-align">
			<i id="imageUpload" class="fa fa-upload"></i>
		</div>
	</div>
</div> -->

<!-- <dl class="tabs vertical" data-tab>
  <dd class="active"><a href="#panel1">Tab 1</a></dd>
  <dd><a href="#panel2">Tab 2</a></dd>
  <dd><a href="#panel3">Tab 3</a></dd>
  <dd><a href="#panel4">Tab 4</a></dd>
</dl>
<div class="tabs-content vertical">
  <div class="content active" id="panel1">
    <p>This is the first panel of the basic tab example. This is the first panel of the basic tab example.</p>
  </div>
  <div class="content" id="panel2">
    <p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
  </div>
  <div class="content" id="panel3">
    <p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
  </div>
  <div class="content" id="panel4">
    <p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
  </div>
</div> -->

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

			<!-- <div class="name-field">
			<label>Your name <small>required</small>
			<input type="text" required pattern=".{0,10}$" maxlength='10'>
			</label>
			<small class="error" id="nameError">Name is required and must be a string.</small>
			</div> -->

			<label for="UserMiniBiography">Mini bio</label>
			<textarea name="data[User][mini_biography]" id="counttextarea" cols="45" rows="6" maxlength="140"></textarea>
			<div class = "ending-block"><span name="countchars" id="countchars"></span><?= __(' Characters Remaining') ?></div><br><br>

			<!-- <input type="text" name="users_name" required pattern=".{0,10}$"> -->

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
?>

<?php $this->start('script'); ?>
<script>
	$(document).ready(function(){
	    var totalChars      = 140; //Total characters allowed in textarea
	    var countTextBox    = $('#counttextarea') // Textarea input box
	    var charsCountEl    = $('#countchars'); // Remaining chars count will be displayed here

	    charsCountEl.text(totalChars); //initial value of countchars element
	    countTextBox.keyup(function() { //user releases a key on the keyboard
	        var thisChars = this.value.replace(/{.*}/g, '').length; //get chars count in textarea
	        if(thisChars > totalChars) //if we have more chars than it should be
	        {
	            var CharsToDel = (thisChars-totalChars); // total extra chars to delete
	            this.value = this.value.substring(0,this.value.length-CharsToDel); //remove excess chars from textarea
	        }else{
	            charsCountEl.text( totalChars - thisChars ); //count remaining chars
	        }
	    });
	});
</script>
<?php $this->end(); ?>
