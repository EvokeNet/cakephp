 <?php

	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

?>

<?php echo $this->Form->create('User', array('type' => 'file', 'url' => array('controller' => 'users', 'action' => 'edit'), 'data-abide')); ?>

<div class="row margin-top-2em" data-equalizer>
  <div class="large-2 columns" data-equalizer-watch>
    <h4 class = "font-green"><?= __('Edit Your Picture') ?></h4>
    
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

        <a class="button" id="upload-profile-img-button" data-file-input-id="upload-profile-img-fileinput">
            <?php echo __('Upload'); ?>
        </a>

        <span id="upload-profile-img-fileinput-filename"> <?= (isset($user['photo_attachment']) ? $user['photo_attachment'] : '') ?></span>
    </div>
                    
  </div>
  <div class="large-5 columns" data-equalizer-watch>
    <h4 class = "font-green"><?= __('Edit Your Personal Information') ?></h4>
    
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
    
    <?php echo $this->Form->input('username', array('required' => true, 'label' => __('Username'))); ?>
       
    <div class="row">
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('language', array(
                    'options' => $languages,
                    'empty' => '(choose one)'
                ));

            ?>
        </div>
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('country', array(
                        'options' => $countries,
                        'empty' => '(choose one)'
                ));
            ?>
        </div>

    </div>
            
    <?php
    
        echo $this->Form->input('birthdate', array(
                'label' => 'Date of birth',
                'dateFormat' => 'DMY',
                'minYear' => date('Y') - 130,
                'maxYear' => date('Y'),
                'empty'=> true,
                'separator' => '&nbsp;&nbsp;',
                'style' => 'width:100px'
        ));
        
        
        echo $this->Form->input('biography', array(
            'type' => 'text', 
            'required' => true, 
            'label' => __('Biography'),
            'cols' => '45',
            'rows' => '6'
        ));
        
    ?>
                    
    <label for="UserMiniBiography" style = "display: inline;"><?= __('Mini bio') ?></label>&nbsp;
    <span data-tooltip aria-haspopup="true" class="has-tip" title="<?= ('The mini bio is a text up to 140 characters') ?>"><i class="fa fa-question-circle"></i></span>
    <?php 
        echo $this->Form->input('mini_biography', array(
            'label' => false,
            'id' => 'counttextarea',
            'cols' => '45',
            'rows' => '6',
            'maxlength' => '140'
        ));
    ?>
    <div class = "ending-block"><span name="countchars" id="countchars"></span><?= __(' Characters Remaining') ?></div><br><br>
                    
  </div>
  <div class="large-5 columns" data-equalizer-watch>
    <h4 class = "font-green"><?= __('Edit Your External Links') ?></h4>
    
    <?php
        echo $this->Form->input('facebook', array('label' => __('Facebook')));
        
        echo $this->Form->input('twitter', array('label' => __('Twitter')));
        
        echo $this->Form->input('google_plus', array('label' => __('Google Plus')));
        
        echo $this->Form->input('instagram', array('label' => __('Instagram')));
        
        echo $this->Form->input('website', array('label' => __('Personal Site')));
        
        echo $this->Form->input('blog', array('label' => __('Blog')));
    ?>
    
  </div>
</div>

<div class="row">
  <div class="large-1 columns"></div>
  <div class="large-4 large-offset-7 columns">
    <button class="right" type="submit"><?php echo __('Save') ?></button>    
  </div>
</div>

<?php echo $this->Form->end(); ?>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/edit.js', array('inline' => false));
	$this->Html->script('requirejs/app/file_upload.js', array('inline' => false));
?>
