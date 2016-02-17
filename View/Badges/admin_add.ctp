<<<<<<< HEAD
<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>
=======
<?php
	
    $this->extend('/Common/admin_panel');
>>>>>>> df5fc7cf806321277e6458ec61cff6a85daba3be

<?php echo $this->Form->create('Badge'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('Edit Badge') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    
    <div class="row" data-equalizer>

	    <div class="large-12 columns" id="panel-content" data-equalizer-watch>
            <?php 
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

<?php $this->start('page_content'); ?>

<div class="row full-width" data-equalizer>

<<<<<<< HEAD
	<div class="large-10 columns" id="panel-content" data-equalizer-watch>	
=======
	<div class="large-10 columns" id="panel-content" data-equalizer-watch>			
>>>>>>> df5fc7cf806321277e6458ec61cff6a85daba3be
		<div class="badges form">
		<?php echo $this->Form->create('Badge'); ?>
			<fieldset>
				<legend><?php echo __('Admin Edit Badge'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('organization_id');
				echo $this->Form->input('mission_id');
				echo $this->Form->input('name');
				echo $this->Form->input('name_es');
				echo $this->Form->input('description');
				echo $this->Form->input('description_es');
				echo $this->Form->input('power_points_only');
				echo $this->Form->input('trigger');
				echo $this->Form->input('language');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>

				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Badge.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Badge.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Badges'), array('action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List User Badges'), array('controller' => 'user_badges', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User Badge'), array('controller' => 'user_badges', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
</div>

<?php $this->end(); ?>