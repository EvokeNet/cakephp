
<!-- TOP LEADERS HAVE BIG PICTURES -->
<div class="row">
    <ul class="user-panel large-block-grid-3 medium-block-grid-1">
      <?php
        $counter = 0;
        foreach($similar_users as $similar_user):
          if ($counter > 2) break; //FORCE 3 FOR UI TESTING

          $pic = $this->webroot.'webroot/img/user_avatar.jpg';
          if($similar_user['User']['photo_attachment'] == null) {
            if($similar_user['User']['facebook_id'] != null) {
              $pic = "https://graph.facebook.com/". $similar_user['User']['facebook_id'] ."/picture?type=large";
            }
          }
          else {
            $pic = $this->webroot.'files/attachment/attachment/'.$similar_user['User']['photo_dir'].'/'.$similar_user['User']['photo_attachment'];
          }
      ?>
      <li>
        <!-- PANEL -->
        <a href="#" data-reveal-id="modalProfile<?= $counter ?>">
          <div class="profile-content panel radius margin right-05 bottom-0">
            <!-- USER PICTURE -->
            <img class="profile-picture small radius" src='<?= $pic ?>' alt="<?= $similar_user['User']['name'] ?>'s profile picture" />

            <p class="text-center margins-0"><span class="font-highlight"><?= $similar_user['User']['name'] ?></span></p>

            <!-- USER INFO -->
            <small>Level 5
            <br />2500 points</small>
          </div>
        </a>

        <!-- VIEW AGENT DETAILS MODAL -->
        <?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'user' => $similar_user, 'pic' => $pic, 'add_button' => true)); ?>
      </li>
      <?php
          $counter++;
        endforeach;
      ?>
    </ul>
</div>

<div class="row">
    <ul class="full-width small-block-grid-1">
      <?php
        $counter = 0;
        foreach($similar_users as $similar_user):
          if ($counter > 2) break; //FORCE 3 FOR UI TESTING

          $pic = $this->webroot.'webroot/img/user_avatar.jpg';
          if($similar_user['User']['photo_attachment'] == null) {
            if($similar_user['User']['facebook_id'] != null) {
              $pic = "https://graph.facebook.com/". $similar_user['User']['facebook_id'] ."/picture?type=large";
            }
          }
          else {
            $pic = $this->webroot.'files/attachment/attachment/'.$similar_user['User']['photo_dir'].'/'.$similar_user['User']['photo_attachment'];
          }
      ?>
      <li>
        <!-- PANEL -->
        <a href="#" data-reveal-id="modalProfile<?= $counter ?>">
          <div class="profile-content padding top-1 border-top-divisor">
            <!-- POSITION -->
            <div class="left padding right-1">
              <span class="font-highlight"><strong><?= $counter ?>th</strong></span>
            </div>

            <!-- USER PICTURE -->
            <div class="left padding right-1">
              <img class="profile-picture smallest radius" src='<?= $pic ?>' alt="<?= $similar_user['User']['name'] ?>'s profile picture" />
            </div>

            <!-- USER INFO -->
            <div class="padding right-1">
              <p class="margins-0"><span class="font-highlight"><?= $similar_user['User']['name'] ?></span></p>

              <small>Level 5</small>

              <div class="right">
                <small>2500 points</small>
              </div>
            </div>
          </div>
        </a>

        <!-- VIEW AGENT DETAILS MODAL -->
        <?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'user' => $similar_user, 'pic' => $pic, 'add_button' => true)); ?>
      </li>
      <?php
          $counter++;
        endforeach;
      ?>
    </ul>
</div>



<!-- NEXT 3 LEADERS -->
<div class="row">
</div>
<div class="row">
</div>
