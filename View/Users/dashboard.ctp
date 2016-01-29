<?php
  $this->start('topbar');
  echo $this->element('topbar');
  $this->end();

  /* Image header */
  $this->start('image_header');
  echo $this->element('image_header',array('imgHeaderTitle' => __('Profile'), 'imgSrc' => ($this->webroot.'img/header-profile.jpg'), 'margin' => false));
  $this->end();
?>

<div class="evoke row background-color-standard full-width" data-equalizer data-equalizer-mq="large-up">
  <!-- LEFT SIDEBAR -->
  <div class="small-12 medium-5 large-3 columns gradient-on-right profile-sidebar" data-equalizer-watch>
    <!-- PROFILE -->
    <div class="row padding top-2 bottom-1 left-2 right-2">

      <!-- PICTURE -->
      <?= $this->Picture->showUserCircularPicture(
        $user['User'],
        'square-150px',
        __("Your profile picture")
      ); ?>

      <!-- NAME -->
      <h4 class="text-color-highlight text-center margin top-1"><?= $user['User']['name'] ?></h4>

      <!-- BIOGRAPHY -->
      <div>
        <p class="text-center">
          <?= (isset($user['User']['mini_biography']) && (($user['User']['mini_biography']) != ""))
            ? $user['User']['mini_biography']
            : $this->Text->getExcerpt($user['User']['biography'], 30, '...') ?>
        </p>
      </div>
    </div>

    <!-- SOCIAL NETWORKS -->
    <div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor text-center">
      <?php echo $this->element('social_networks_bar', array('social_networks_user' => $user['User'])) ?>
    </div>

    <!-- LEVEL -->
    <div class="row padding top-1 bottom-1 left-2 right-2 border-top-divisor">
      <?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>
    </div>

    <!-- Available Missions -->
    <div class="available-missions">
      <h4><?php echo __('Available Missions'); ?></h4>
      <?php foreach($available_missions as $index => $available_mission): ?>
        <?php  $available_mission_url = $this->Html->url(array('controller' => 'missions', 'action' => 'view_mission', $available_mission['Mission']['id'])); ?>
        <!-- Mission Link -->
        <div data-mission="mission<?php echo $available_mission['Mission']['id']; ?>" class="view view-first available-mission <?php if($index==0){echo 'selected-mission';} ?>">
          <a>
            <?php if(!is_null($available_mission['Mission']['cover_dir'])) :?>
              <img src="<?= $this->webroot.'files/attachment/attachment/'.$available_mission['Mission']['cover_dir'].'/'.$available_mission['Mission']['cover_attachment'] ?>">
            <?php else :?>
              <img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
            <?php endif ?>

              <div class="mask">
                  <h4><?php echo $available_mission['Mission']['title'] ?></h4>
                  <p><?php echo $this->Text->getExcerpt($available_mission['Mission']['description'], 25, "...") ?></p>
              </div>
            </a>
        </div>
        <!-- End Mission Link -->
      <?php endforeach; ?>
    </div>
    <!-- End Available Missions -->

    <!-- POTENTIAL ALLIES -->
    <?php
    //Show only in my profile
    if ($user['User']['id'] == $users['User']['id']): ?>
      <div class="row hide-for-small-only padding top-1 bottom-1 left-2 border-top-divisor">
        <h4><?= __('Potential allies') ?></h4>

        <ul class="full-width small-block-grid-1 potential-allies-list">
          <?php
          $counter = 0;
          foreach($similar_users as $similar_user): ?>

            <li>
              <!-- PANEL -->
              <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $similar_user['User']['id'], false)); ?>">

                <div class="table full-width profile-content padding top-1">
                  <!-- USER PICTURE -->
                        <div class="table-cell vertical-align-middle square-40px">
                  <?= $this->Picture->showUserCircularPicture(
                    $similar_user['User'],
                    'square-40px',
                    __("%s's profile picture",$similar_user['User']['name'])
                  ); ?>
                  </div>

                  <!-- USER INFO -->
                  <div class="table-cell vertical-align-middle padding left-1">
                    <p class="user-name margins-0">
                      <?= $similar_user['User']['name'] ?>
                    </p>

                    <small>Level <?= $similar_user['User']['level'] ?></small>
                  </div>
                </div>
              </a>

              <!-- VIEW AGENT DETAILS MODAL -->
              <?php echo $this->element('user_biography', array('modal' => true, 'counter' => 'PotentialAllies'.$counter, 'user' => $similar_user, 'add_button' => true)); ?>
            </li>

          <?php
            $counter++;
          endforeach;
          ?>
        </ul>


        <a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view_all')); ?>"><?php echo __('SEE ALL USERS'); ?></a>
      </div>

      <?php
    endif;
    ?>
    <!-- End Potential Allies -->
    <!-- LEADERBOARD -->
    <div class="row hide-for-small-only padding top-1 bottom-1 left-2 border-top-divisor">
        <h3><?= __('Leaderboard') ?></h3>
        <div class="leaderboard">
          <?php echo $this->element('leaderboard'); ?>
        </div>
    </div>
    <!-- End Leaderboard -->
  </div>

  <!-- CENTER -->
  <div class="small-12 medium-7 large-9 columns padding top-2 bottom-2 left-2 right-2" data-equalizer-watch>

    <!-- Current Mission -->
    <?php foreach($available_missions as $index => $mission): ?>
      <div id="mission<?php echo $mission['Mission']['id'] ?>" class="row current-mission <?php if($index==0){echo 'selected-mission';} ?>">
        <h2 class="display-inline"> <?= strtoupper(__('Current Mission')) ?> - </h2>
        <h3 class="text-color-highlight display-inline"><?= strtoupper($mission['Mission']['title']) ?></h3>


        <?php  $mission_url = $this->Html->url(array('controller' => 'missions', 'action' => 'view_mission', $mission['Mission']['id'])); ?>
        <!-- Mission Link -->
        <div class="view view-first">
          <a href="<?= $mission_url ?>">
            <?php if(!is_null($mission['Mission']['cover_dir'])) :?>
              <img src="<?= $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/'.$mission['Mission']['cover_attachment'] ?>">
            <?php else :?>
              <img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
            <?php endif ?>

              <div class="mask">
                  <p><?= $this->Text->getExcerpt($mission['Mission']['description'], 200, "...") ?></p>
              </div>
            </a>
        </div>
        <!-- End Mission Link -->
        <!-- Available Quests -->
        <?php $mission_phase_icons = $this->Phase->getPhaseIcons(); ?>
        <div class="phase-quest">
          <div class="row">
            <span class="section-title small-4 medium-3 large-3 columns"><?php echo __('Current Phase'); ?></span>
            <span class="section-title small-8 medium-9 large-9 columns"><?php echo __('Available Quests'); ?></span>
          </div>
          <div class="row">
            <div class="button-bar phases-bar small-4 medium-3 large-3 columns">
              <span class="button current">
                <i class="fa <?= $mission_phase_icons[$current_phases[$index]['position']] ?> fa-lg"></i>
                <?php echo $current_phases[$index]['name'] ?>
              </span>
            </div>
            <ul class="quest-list small-8 medium-9 large-9 columns">
              <?php foreach($quests[$index] as $quest): ?>
                <li class="quest-link text-glow-on-hover">
                  <a href="<?= $mission_url ?>" data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover='false' title="<?php echo $this->Text->getExcerpt($quest['Quest']['description'], 50, '...'); ?>">
                    <span>
                      <?php echo $quest['Quest']['title'] ?>
                    </span>
                    <span class="points">pts. <?php echo $quest['Quest']['points'] ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <!-- End Available Quests -->
      </div>
    <?php endforeach; ?>
    <!-- End Current Mission -->
    <!-- Allies' Activity -->
    <div class="row border-top-divisor">
      <div class="small-12 columns margin top-2">

        <div class="row margins-0">
          <h3 class="left margin right-2"><?= __("Allies' Recent Activity") ?></h3>
        </div>


        <!-- ALLIES GRID -->
        <?php
        //Has allies
        if (count($friends) > 0): ?>
          <ul class="large-block-grid-6 medium-block-grid-3 small-block-grid-2 no-marker">

          <?php
            foreach($friends as $index=>$ally):
               ?>
              <?php if(!empty($allies_evidences[$index]['Evidence'])): ?>
                <li class="text-center">
                  <!-- PICTURE -->

                  <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view_mission', $allies_evidences[$index]['Evidence']['mission_id'])); ?>">

                    <?= $this->Picture->showUserCircularPicture(
                      $ally['Friend'],
                      'square-60px',
                      __("%s's profile picture",$ally['Friend']['name'])
                    ); ?>

                    <p class="text-center text-glow-on-hover">
                      <?php
                        if(!empty($allies_evidences[$index]['Evidence']['title'])) {
                          echo __("Submitted Evidence: ");
                          echo $allies_evidences[$index]['Evidence']['title'];
                        }
                      ?>
                    </p>
                  </a>
                </li>
            <?php
              endif;
            endforeach;
            ?>

          </ul> <?php
        else: ?>
          <div data-alert="" class="alert-box radius">
            <?= __('You have no allies! Get started looking at people similar to you!') ?>
          </div><?php
        endif; ?>
      </div>
    </div>
    <!-- End Allies' Activity -->

    <div class="row standard-width">
      <!-- PSYCHOMETRIC ANALYSIS -->
      <div class="large-6 medium-12 columns">
        <h3><?= __('Psychometric Analysis') ?></h3>
        <p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
        <p><?= __('You have the heart of a Local Leader!') ?></p>
        <p><?= __('Your Entrepreneurship and Local Insight are key to you. Embrace your qualities and use them for the better.') ?></p>
        <!-- Badges -->
        <div>
          <h3><?= __('Badges earned') ?>&nbsp;&nbsp;(<?= count($badges) ?>)</h3>
          <?php echo $this->element('badges'); ?>
        </div>
        <!-- End Badges -->
      </div>

      <!-- RADAR GRAPH FOR MATCHING RESULTS -->
      <div class="large-6 medium-12 columns centering-block">
        <div class="text-center vertical-align-middle centered-block">
          <div>
            <?php echo $this->element('matching_graph', array('height' => '550', 'width' => '550')); ?>
          </div>
        </div>
      </div>
      <!-- End Radar Graph -->
    </div>

    <!-- BIOGRAPHY -->
    <div class="row border-top-divisor">
      <div class="small-12 columns margin top-2 bottom-2">
        <h3><?= __('About') ?></h3>
        <?php
        //Has biography
        if (!empty($user['User']['biography'])):
          echo $user['User']['biography'];

        //Doesn't have biography and it's not me
        elseif ($user['User']['id'] != $users['User']['id']): ?>
          <div data-alert="" class="alert-box radius">
            <?= __('This user has not added a biography yet.') ?>
          </div>
          <?php

        //Doesn't have biography and it's me
        else: ?>
          <div data-alert="" class="alert-box radius">
            <?= __('You have not added a biography yet!') ?>
          </div>
          <div class="text-center">
            <a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>"><?php echo __('Complete your profile!'); ?></a>
          </div>
          <?php
        endif;
        ?>
      </div>
    </div>

    <!-- ALLIES -->
    <div class="row border-top-divisor">
      <div class="small-12 columns margin top-2">

        <div class="row margins-0">
          <h3 class="left margin right-2"><?= __("Allies I follow") ?></h3>

          <a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view_all')); ?>"><?php echo __('SEE ALL USERS'); ?></a>
        </div>


        <!-- ALLIES GRID -->
        <?php
        //Has allies
        if (count($friends) > 0): ?>
          <ul class="large-block-grid-6 medium-block-grid-3 small-block-grid-2 no-marker">

          <?php
            $counter = 0;
            foreach($friends as $ally):
               ?>
              <li class="text-center">
                <!-- PICTURE -->

                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['Friend']['id'], false)); ?>">

                  <?= $this->Picture->showUserCircularPicture(
                    $ally['Friend'],
                    'square-60px',
                    __("%s's profile picture",$ally['Friend']['name'])
                  ); ?>

                  <p class="text-center text-glow-on-hover"><?= $ally['Friend']['name'] ?></p>
                </a>

                <!-- MODAL USER BIOGRAPHY -->
                <?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'user' => $ally, 'add_button' => false)); ?>
              </li>
            <?php
              $counter++;
            endforeach;
          ?>

          </ul> <?php

        //Doesn't have allies and it's not me
        elseif ($user['User']['id'] != $users['User']['id']): ?>
          <div data-alert="" class="alert-box radius">
            <?= __('This user has no allies yet.') ?>
          </div><?php

        //Doesn't have allies and it's me
        else: ?>
          <div data-alert="" class="alert-box radius">
            <?= __('You have no allies! Get started looking at people similar to you!') ?>
          </div><?php
        endif; ?>
      </div>
    </div>
  </div>
</div>

<?php
  //JAVASCRIPT VARIABLES
  $this->start('evoke_javascript_variables');

    echo "evokeData.webroot = 'TESTE';";
  $this->end();

  //SCRIPT
  $this->Html->script('requirejs/app/Users/profile.js', array('inline' => false));
  $this->Html->script('requirejs/app/Users/dashboard.js', array('inline' => false));
?>

<?php
  /* Footer */
  $this->start('footer');
  echo $this->element('footer');
  $this->end();
?>
