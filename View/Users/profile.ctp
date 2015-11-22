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

      <!-- ALLIANCE -->
      <div class="padding top-1 text-center">
        <!-- ADD AS AN ALLY -->
        <?php if(empty($is_friend) && ($user['User']['id'] != $users['User']['id'])): ?>
          <a class="button small" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $user['User']['id'], $loggedInUser['id'], false)); ?>">
            <i class="fa fa-plus"></i>
            <?= __('Add as ally') ?>
          </a>

        <!-- ALREADY AN ALLY -->
        <?php elseif(!empty($is_friend) && ($user['User']['id'] != $users['User']['id'])): ?>
          <a class="button small disabled">
            <i class="fa fa-check"></i>
            <?= __('Your ally') ?>
          </a>
        <?php endif; ?>
      </div>

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

    <!-- POTENTIAL ALLIES -->
    <?php
    //Show only in my profile
    if ($user['User']['id'] == $users['User']['id']): ?>
      <div class="row hide-for-small-only padding top-1 bottom-1 left-2 right-2 border-top-divisor">
        <h4><?= __('Potential allies') ?></h4>

        <ul class="full-width small-block-grid-1">
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
  </div>

  <!-- CENTER -->
  <div class="small-12 medium-7 large-9 columns padding top-2 bottom-2 left-2 right-2" data-equalizer-watch>

    <!-- Current Mission -->
    <div class="row current-mission">
      <h2 class="display-inline"> <?= strtoupper(__('Current Mission')) ?> - </h2>
      <h3 class="text-color-highlight display-inline"><?= strtoupper($current_mission['Mission']['title']) ?></h3>


      <?php  $current_mission_url = $this->Html->url(array('controller' => 'missions', 'action' => 'view_mission', $current_mission['Mission']['id'])); ?>
      <!-- Mission Link -->
      <div class="view view-first">
        <a href="<?= $current_mission_url ?>">
          <?php if(!is_null($current_mission['Mission']['cover_dir'])) :?>
            <img src="<?= $this->webroot.'files/attachment/attachment/'.$current_mission['Mission']['cover_dir'].'/'.$current_mission['Mission']['cover_attachment'] ?>">
          <?php else :?>
            <img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
          <?php endif ?>

            <div class="mask">
                <p><?= $this->Text->getExcerpt($current_mission['Mission']['description'], 200, "...") ?></p>
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
              <i class="fa <?= $mission_phase_icons[$current_phase['position']] ?> fa-lg"></i>
              <?php echo $current_phase['name'] ?>
            </span>
          </div>
          <ul class="quest-list small-8 medium-9 large-9 columns">
            <?php $quest_count = count($quests) >= 5 ? 5 : count($quests); ?>
            <?php for($i = 0; $i < $quest_count; $i++): ?>
              <li class="quest-link text-glow-on-hover">
                <a href="<?= $current_mission_url ?>" data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover='false' title="<?php echo $quests[$i]['Quest']['description']; ?>">
                  <span >
                    <?php echo $quests[$i]['Quest']['title'] ?>
                  </span>
                  <span class="points">pts. <?php echo $quests[$i]['Quest']['points'] ?></span>
                </a>
              </li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
      <!-- End Available Quests -->
    </div>
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
    <!-- End Allies' Activity -->

    <div class="row standard-width">
      <!-- PSYCHOMETRIC ANALYSIS -->
      <div class="large-6 medium-12 columns">
        <h3><?= __('Psychometric Analysis') ?></h3>
        <p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
        <p><?= __('You have the heart of a Local Leader!') ?></p>
        <p><?= __('Your Entrepreneurship and Local Insight are key to you. Embrace your qualities and use them for the better.') ?></p>
      </div>

      <!-- RADAR GRAPH FOR MATCHING RESULTS -->
      <div class="large-6 medium-12 columns centering-block">
        <div class="text-center vertical-align-middle centered-block">
          <div>
            <?php echo $this->element('matching_graph', array('height' => '550', 'width' => '550')); ?>
          </div>
        </div>
      </div>
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

    <!-- LEADERBOARD -->
    <div class="row border-top-divisor">
      <div class="large-6 columns padding top-2 right-2 border-right-divisor">
        <h3><?= __('Leaderboard') ?></h3>
        <?php echo $this->element('leaderboard'); ?>
      </div>

      <div class="large-6 columns padding top-2">
        <h3><?= __('Badges earned') ?>&nbsp;&nbsp;(<?= count($badges) ?>)</h3>
        <?php echo $this->element('badges'); ?>
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
?>

<?php
  /* Footer */
  $this->start('footer');
  echo $this->element('footer');
  $this->end();
?>
