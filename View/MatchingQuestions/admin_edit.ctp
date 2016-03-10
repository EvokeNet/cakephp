<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<?php echo $this->Form->create('MatchingQuestion'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('Edit Matching Question') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row" data-equalizer>

	    <div class="large-12 columns" id="panel-content" data-equalizer-watch>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('description');
				echo $this->Form->input('type');
			?>
		</div>
	</div>
</div>
<?php echo $this->Form->end(__('Submit')); ?>
<?php $this->end(); ?>
