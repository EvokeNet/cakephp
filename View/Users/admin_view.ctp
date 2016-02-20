<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('View User') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div class="large-4 columns">
            <p><span class = "font-weight-bold"><?= __('Name:') ?></span>&nbsp;&nbsp;<?= $user['User']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Firstname:') ?></span>&nbsp;&nbsp;<?= $user['User']['firstname'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Lastname:') ?></span>&nbsp;&nbsp;<?= $user['User']['lastname'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Birthdate:') ?></span>&nbsp;&nbsp;<?= $user['User']['birthdate'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Email:') ?></span>&nbsp;&nbsp;<?= $user['User']['email'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Role:') ?></span>&nbsp;&nbsp;<?= $role['Role']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Sex:') ?></span>&nbsp;&nbsp;<?= $sexes[$user['User']['sex']] ?></p>
            <p><span class = "font-weight-bold"><?= __('Country:') ?></span>&nbsp;&nbsp;<?= $countries[$user['User']['country']] ?></p>
            <p><span class = "font-weight-bold"><?= __('Language:') ?></span>&nbsp;&nbsp;<?= $languages[$user['User']['language']] ?></p>
            <p><span class = "font-weight-bold"><?= __('Created:') ?></span>&nbsp;&nbsp;<?= $user['User']['created'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Modified:') ?></span>&nbsp;&nbsp;<?= $user['User']['modified'] ?></p>
        </div>
        <div class="large-4 columns">
            <p><span class = "font-weight-bold"><?= __('Facebook:') ?></span>&nbsp;&nbsp;<?= $user['User']['facebook'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Google:') ?></span>&nbsp;&nbsp;<?= $user['User']['google_plus'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Twitter:') ?></span>&nbsp;&nbsp;<?= $user['User']['twitter'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Instagram:') ?></span>&nbsp;&nbsp;<?= $user['User']['instagram'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Website:') ?></span>&nbsp;&nbsp;<?= $user['User']['website'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Blog:') ?></span>&nbsp;&nbsp;<?= $user['User']['blog'] ?></p>
        </div>
        <div class="large-4 columns">
            <p><span class = "font-weight-bold"><?= __('Biography:') ?></span>&nbsp;&nbsp;<?= $user['User']['biography'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Mini Biography:') ?></span>&nbsp;&nbsp;<?= $user['User']['mini_biography'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Superhero Identity:') ?></span>&nbsp;&nbsp;<?= $superHeroIdentity['SuperheroIdentity']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= $powers[1].__(' Points:') ?></span>&nbsp;&nbsp;<?= $user['User']['primary_power_quantity'] ?></p>
            <p><span class = "font-weight-bold"><?= $powers[2].__(' Points:') ?></span>&nbsp;&nbsp;<?= $user['User']['secondary_power_quantity'] ?></p>
        </div>
    </div>
</div>

<?php $this->end(); ?>