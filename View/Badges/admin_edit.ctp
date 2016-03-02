<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<?php echo $this->Form->create('Badge'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('Edit Badge') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    
    <div class="row" data-equalizer>

	    <div class="large-12 columns" id="panel-content" data-equalizer-watch>
            <?php 
                echo $this->Form->input('id');
                echo $this->Form->input('name');
				echo $this->Form->input('description');
             ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('organization_id');
            ?>
        </div>
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('mission_id');
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-4 columns">
            <?php
                echo $this->Form->input('power_points_only');
            ?>
        </div>
        <div class="large-4 columns">
            <?php
                echo $this->Form->input('trigger');
            ?>
        </div>
        <div class="large-4 columns">
            <?php
                echo $this->Form->input('language');
            ?>
        </div>
    </div>
    
</div>

<?php echo $this->Form->end(__('Submit')); ?>

<?php $this->end(); ?>