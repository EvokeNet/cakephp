<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('View Badge') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div class="large-10 centered columns">
            <p><span class = "font-weight-bold"><?= __('Name:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Description:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['description'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Organization:') ?></span>&nbsp;&nbsp;<?= $badge['Organization']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Mission:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['mission_id'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Power Points:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['power_points_only'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Trigger:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['trigger'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Language:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['language'] ?></p>
            <!--<p><span class = "font-weight-bold"><?= __('Created:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['created'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Modified:') ?></span>&nbsp;&nbsp;<?= $badge['Badge']['modified'] ?></p>-->
        </div>
    </div>
</div>

<?php $this->end(); ?>