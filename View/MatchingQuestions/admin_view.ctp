<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('View Matching Question') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div class="large-10 centered columns">
			<p><span class = "font-weight-bold"><?= __('Description:') ?></span>&nbsp;&nbsp;<?= $matchingQuestion['MatchingQuestion']['description'] ?></p>
			<p><span class = "font-weight-bold"><?= __('Type:') ?></span>&nbsp;&nbsp;<?= $matchingQuestion['MatchingQuestion']['type'] ?></p>
			<p><span class = "font-weight-bold"><?= __('Created:') ?></span>&nbsp;&nbsp;<?= $matchingQuestion['MatchingQuestion']['created'] ?></p>
			<p><span class = "font-weight-bold"><?= __('Modified:') ?></span>&nbsp;&nbsp;<?= $matchingQuestion['MatchingQuestion']['modified'] ?></p>
		</div>
	</div>
</div>

<?php $this->end(); ?>