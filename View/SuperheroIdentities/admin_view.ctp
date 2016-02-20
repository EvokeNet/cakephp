<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<h3 class = "uppercase font-weight-bold font-gray margin-bottom-05em"><?= __('View Superhero Identity') ?></h3>
<div class = "section padding-top-1em padding-bottom-1em">
    <div class="row">
        <div class="large-10 centered columns">
            <p><span class = "font-weight-bold"><?= __('Name:') ?></span>&nbsp;&nbsp;<?= $superheroIdentity['SuperheroIdentity']['name'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Description:') ?></span>&nbsp;&nbsp;<?= $superheroIdentity['SuperheroIdentity']['description'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Quality 1:') ?></span>&nbsp;&nbsp;<?= $qualities[$superheroIdentity['SuperheroIdentity']['quality_1']] ?></p>
            <p><span class = "font-weight-bold"><?= __('Quality 2:') ?></span>&nbsp;&nbsp;<?= $qualities[$superheroIdentity['SuperheroIdentity']['quality_2']] ?></p>
            <p><span class = "font-weight-bold"><?= __('Primary Power:') ?></span>&nbsp;&nbsp;<?= $powers[$superheroIdentity['SuperheroIdentity']['primary_power']] ?></p>
            <p><span class = "font-weight-bold"><?= __('Secondary Power:') ?></span>&nbsp;&nbsp;<?= $powers[$superheroIdentity['SuperheroIdentity']['secondary_power']] ?></p>
            <p><span class = "font-weight-bold"><?= __('Created:') ?></span>&nbsp;&nbsp;<?= $superheroIdentity['SuperheroIdentity']['created'] ?></p>
            <p><span class = "font-weight-bold"><?= __('Modified:') ?></span>&nbsp;&nbsp;<?= $superheroIdentity['SuperheroIdentity']['modified'] ?></p>
        </div>
    </div>
</div>

<?php $this->end(); ?>