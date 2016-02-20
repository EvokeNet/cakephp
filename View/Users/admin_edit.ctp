<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<?php echo $this->Form->create('User'); echo $this->Form->input('id'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('Edit User') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div>
            <?php echo $this->Form->input('id'); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('firstname', array('label' => __('First name'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('lastname', array('label' => __('Last name'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('username', array('label' => __('Username'))); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns">
            <?php echo $this->Form->input('role_id', array('label' => __('Role'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('email', array('label' => __('E-mail'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('sex', array('label' => __('Sex'))); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns">
            <?php echo $this->Form->input('birthdate', array(
                'label' => 'Date of birth',
                'dateFormat' => 'DMY',
                'minYear' => date('Y') - 130,
                'maxYear' => date('Y'),
                'empty'=> true,
                'separator' => '&nbsp;&nbsp;',
                'style' => 'width:100px'
        )); ?>
        </div>
        <div class="large-4 columns">
            <?php
                echo $this->Form->input('language', array(
                    'options' => $languages,
                    'empty' => '(choose one)'
                ));
            ?>
        </div>
        <div class="large-4 columns">
            <?php
                echo $this->Form->input('country', array(
                        'options' => $countries,
                        'empty' => '(choose one)'
                ));
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('new_password', array('label' => __('Type new password')));
            ?>
        </div>
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('confirm_new_password', array('label' => __('Retype new password')));
            ?>
        </div>
    </div>
    
</div>
    
<div class = "section padding-top-1em">
    <div class="row" data-equalizer>
	    <div class="large-12 columns" id="panel-content" data-equalizer-watch>
             
            <?php
           
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
        
    </div> 
</div>

<div class = "section padding-top-1em">
    
    <div class="row">
        <div class="large-4 columns">
            <?php echo $this->Form->input('facebook', array('label' => __('Facebook'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('twitter', array('label' => __('Twitter'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('google_plus', array('label' => __('Google Plus'))); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns">
            <?php echo $this->Form->input('instagram', array('label' => __('Instagram'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('website', array('label' => __('Personal Site'))); ?>
        </div>
        <div class="large-4 columns">
            <?php echo $this->Form->input('blog', array('label' => __('Blog'))); ?>
        </div>
    </div>
                    
</div>
        
<?php echo $this->Form->end(__('Submit')); ?>

<?php $this->end(); ?>