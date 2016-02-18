<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('View Organization') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div class="large-4 columns">
            <p><span class = "font-weight-bold"><?= __('Name:') ?></span>&nbsp;&nbsp;<?= $organization['Organization']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Description:') ?></span>&nbsp;&nbsp;<?= $organization['Organization']['description'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Birthdate:') ?></span>&nbsp;&nbsp;<?= $organization['Organization']['birthdate'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Facebook:') ?></span>&nbsp;&nbsp;<?= $organization['Organization']['facebook'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Twitter:') ?></span>&nbsp;&nbsp;<?= $organization['Organization']['twitter'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Website:') ?></span>&nbsp;&nbsp;<?= $organization['Organization']['website'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Blog:') ?></span>&nbsp;&nbsp;<?= $organization['Organization']['blog'] ?></p>
        </div>
    </div>
</div>

<?php $this->end(); ?>