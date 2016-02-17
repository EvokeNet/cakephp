<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<?php echo $this->Form->create('SocialInnovatorQuality'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('Add Social Innovator Quality') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    
    <div class="row">
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('name');
            ?>
        </div>
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('short_name');
            ?>
        </div>
    </div>
    
    <div class="row" data-equalizer>

	    <div class="large-12 columns" id="panel-content" data-equalizer-watch>
            <?php 
				echo $this->Form->input('description');
             ?>
        </div>
    </div>
    
</div>

<?php echo $this->Form->end(__('Submit')); ?>

<?php $this->end(); ?>