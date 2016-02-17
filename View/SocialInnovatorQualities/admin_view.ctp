<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('View Social Innovator Quality') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div class="large-10 centered columns">
            <p><span class = "font-weight-bold"><?= __('Name:') ?></span>&nbsp;&nbsp;<?= $socialInnovatorQuality['SocialInnovatorQuality']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Short name:') ?></span>&nbsp;&nbsp;<?= $socialInnovatorQuality['SocialInnovatorQuality']['short_name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Description:') ?></span>&nbsp;&nbsp;<?= $socialInnovatorQuality['SocialInnovatorQuality']['description'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Created:') ?></span>&nbsp;&nbsp;<?= $socialInnovatorQuality['SocialInnovatorQuality']['created'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Modified:') ?></span>&nbsp;&nbsp;<?= $socialInnovatorQuality['SocialInnovatorQuality']['modified'] ?></p>
        </div>
    </div>
</div>

<?php $this->end(); ?>