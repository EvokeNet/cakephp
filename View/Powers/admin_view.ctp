<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('View Power') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div class="large-10 centered columns">
            <p><span class = "font-weight-bold"><?= __('Name:') ?></span>&nbsp;&nbsp;<?= $power['Power']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Description:') ?></span>&nbsp;&nbsp;<?= $power['Power']['description'] ?></p>
            <!--<p><span class = "font-weight-bold"><?= __('Created:') ?></span>&nbsp;&nbsp;<?= $power['Power']['created'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Modified:') ?></span>&nbsp;&nbsp;<?= $power['Power']['modified'] ?></p>-->
        </div>
    </div>
</div>

<?php $this->end(); ?>