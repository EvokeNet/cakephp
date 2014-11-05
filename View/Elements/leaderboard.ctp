
<!-- TOP LEADERS HAVE BIG PICTURES -->
<div class="row top-leaders">
    <ul class="user-panel large-block-grid-3 medium-block-grid-1" data-equalizer>
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
          <div class="img-glow-on-hover-small">
            <div class="profile-content panel radius text-center margin right-05 bottom-0" data-equalizer-watch>
              <!-- USER PICTURE -->
              <img class="profile-picture small radius img-glow-on-hover-small" src='<?= $pic ?>' alt="<?= $similar_user['User']['name'] ?>'s profile picture" />

              <p class="text-center margins-0 user-name"><span class="font-highlight"><?= $similar_user['User']['name'] ?></span></p>

              <!-- USER INFO -->
              <small>Level 5
              <br />2500 points</small>
            </div>
          </div>
        </a>

        <!-- VIEW AGENT DETAILS MODAL -->
        <?php echo $this->element('user_biography', array('modal' => true, 'counter' => 'Leaderboard'.$counter, 'user' => $similar_user, 'pic' => $pic, 'add_button' => true)); ?>
      </li>
      <?php
          $counter++;
        endforeach;
      ?>
    </ul>
</div>

<!-- NEXT LEADERS -->
<div class="row other-leaders">
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
        <a href="#" data-reveal-id="modalProfileLeaderboard<?= $counter ?>">
          <div class="profile-content padding top-1 border-top-divisor table">
            <!-- POSITION -->
            <div class="table-cell vertical-align-middle padding right-1">
              <span class="font-highlight"><strong><?= $counter ?>th</strong></span>
            </div>

            <!-- USER INFO -->
            <div class="table-cell vertical-align-middle padding right-1 full-width">
              <!-- USER PICTURE -->
              <div class="left padding right-1">
                <img class="profile-picture smallest radius" src='<?= $pic ?>' alt="<?= $similar_user['User']['name'] ?>'s profile picture" />
              </div>

              <p class="user-name margins-0"><span class="font-highlight"><?= $similar_user['User']['name'] ?></span></p>

              <small>Level 5</small>
            </div>

            <!-- POINTS -->
            <div class="table-cell vertical-align-middle">
              <small>2500 points</small>
            </div>
          </div>
        </a>

        <!-- VIEW AGENT DETAILS MODAL -->
        <?php echo $this->element('user_biography', array('modal' => true, 'counter' => 'Leaderboard'.$counter, 'user' => $similar_user, 'pic' => $pic, 'add_button' => true)); ?>
      </li>
      <?php
          $counter++;
        endforeach;
      ?>
    </ul>
</div>


<?php
  /* Script */
  $this->start('script');
?>
  <script type="text/javascript">
    //Top-leaders glow when selected
    $("div.top-leaders li")
    .on("mouseover", function(){
      $(this).find('.profile-picture').addClass('img-glow-small');
      $(this).find('.user-name').addClass('text-glow');
    })
    .on("mouseout", function(){
      $(this).find('.profile-picture').removeClass('img-glow-small');
      $(this).find('.user-name').removeClass('text-glow');
    });

    //Other leaders glow when selected
    $("div.other-leaders .profile-content")
    .on("mouseover", function(){
      $(this).find('.profile-picture').addClass('img-glow-small');
      $(this).find('.user-name').addClass('text-glow');
    })
    .on("mouseout", function(){
      $(this).find('.profile-picture').removeClass('img-glow-small');
      $(this).find('.user-name').removeClass('text-glow');
    });
  </script>
<?php $this->end(); ?>