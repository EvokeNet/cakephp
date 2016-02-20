<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<?php echo $this->Form->create('SuperheroIdentity'); echo $this->Form->input('id'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('Edit Superhero Identity') ?></h3>
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
                echo $this->Form->input('quality_1', array('type'=>'select','label' => 'Quality 1',
		   'options' => $qualities,'empty' => '(choose one)'));
            ?>
        </div>
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('quality_2', array('type'=>'select','label' => 'Quality 2',
		   'options' => $qualities,'empty' => '(choose one)'));
            ?>
        </div>
    </div>
    
    <div class="row">
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('primary_power', array('type'=>'select','label' => 'Primary Power',
		   'options' => $powers,'empty' => '(choose one)'));
            ?>
        </div>
        <div class="large-6 columns">
            <?php
                echo $this->Form->input('secondary_power', array('type'=>'select','label' => 'Secondary Power',
		   'options' => $powers,'empty' => '(choose one)'));
            ?>
        </div>
    </div>
    
</div>

<?php echo $this->Form->end(__('Submit')); ?>

<?php $this->end(); ?>