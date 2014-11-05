
<!-- NEXT LEADERS -->
<div class="row other-leaders">
    <ul class="full-width small-block-grid-1 table">
      <?php
        $counter = 0;
        foreach($similar_users as $similar_user):
          if ($counter > 4) break; //FORCE 3 FOR UI TESTING

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
          <div class="profile-content padding top-1 border-top-divisor table-row">
            <!-- POSITION -->
            <div class="table-cell vertical-align-middle padding right-1">
              <strong><span class="font-highlight <?= ($counter < 3) ? 'text-color-highlight' : '' ?>">#<?= $counter ?></span></strong>
            </div>

            <!-- USER INFO -->
            <div class="table-cell vertical-align-middle padding right-1 full-width">
              <!-- USER PICTURE -->
              <div class="left padding right-1">
                <img class="profile-picture img-circular smallest radius margin bottom-0" src='<?= $pic ?>' alt="<?= $similar_user['User']['name'] ?>'s profile picture" />
              </div>

              <p class="user-name margins-0">
                <span class="font-highlight "><?= $similar_user['User']['name'] ?></span>
              </p>

              <small>Level 5</small>
            </div>

            <!-- POINTS -->
            <div class="table-cell vertical-align-middle text-center">
              2500
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
      $(this).find('.profile-content').addClass('background-color-darkest');
      $(this).find('.profile-picture').addClass('img-glow-small');
      $(this).find('.user-name').addClass('text-glow');
    })
    .on("mouseout", function(){
      $(this).find('.profile-content').removeClass('background-color-darkest');
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