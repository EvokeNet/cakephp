<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<?php echo $this->Form->create('Organization'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('Edit Organization') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row" data-equalizer>
        <div class="large-12 columns" id="panel-content" data-equalizer-watch>
            <?php
                echo $this->Form->input('name');
                
                echo $this->Form->input('birthdate', array(
                        'label' => 'Date of birth',
                        'dateFormat' => 'DMY',
                        'minYear' => date('Y') - 130,
                        'maxYear' => date('Y'),
                        'empty'=> true,
                        'separator' => '&nbsp;&nbsp;',
                        'style' => 'width:100px'
                ));
                
                echo $this->Form->input('description');
                
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-6 columns">
            <?php echo $this->Form->input('facebook', array('label' => __('Facebook'))); ?>
        </div>
        <div class="large-6 columns">
            <?php echo $this->Form->input('twitter', array('label' => __('Twitter'))); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-6 columns">
            <?php echo $this->Form->input('website', array('label' => __('Website'))); ?>
        </div>
        <div class="large-6 columns">
            <?php echo $this->Form->input('blog', array('label' => __('Blog'))); ?>
        </div>
    </div>
                    
</div>

<?php echo $this->Form->end(__('Submit')); ?>

<?php $this->end(); ?>
