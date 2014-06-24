<div class = "evoke forum-post-bg">
    <table width = "100%">
      <!-- <thead>
        <tr>
          <th width="150"></th>
          <th></th>
        </tr>
      </thead> -->
      <tbody>
        <tr>
          <td width="120" class = "forum right-border">
            <a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $post['User']['id'])) ?>">
                <?php if($post['User']['photo_attachment'] == null) : ?>
                    <?php if($post['User']['facebook_id'] == null) : ?>
                        <?php $pic = $this->webroot.'img/user_avatar.jpg'; ?>
                    <?php else : ?> 
                        <?php $pic = "https://graph.facebook.com/". $post['User']['facebook_id']. "/picture?type=large"; ?>
                    <?php endif; ?>
                <?php else : ?>
                    <?php $pic = $this->webroot.'files/attachment/attachment/'.$post['User']['photo_dir'].'/'.$post['User']['photo_attachment']; ?>
                <?php endif; ?>
                <div style="min-width: 5vw; max-width: 5vw; min-height: 5vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;"></div>
                <h6 class = "white margin top"><?= $post['User']['name'] ?></h6>
            </a>
          </td>

          <td width="80%"class = "forum padding left-2">

            <?php

                if (strpos($post['ForumPost']['content'], '[quote') !== false):
                    $aux = explode(']', $post['ForumPost']['content']);
                    $aux2 = explode('[', $aux[1]);
                    $aux3 = explode('&quot;', $post['ForumPost']['content']);
                
                ?>
                
                <div class="post">
                    
                    <div class = "decoda-quote">
                        <h5 class = "content margin top-1"><?= $aux3[1] ?></h5> <!-- Name -->
                        <h5 class = "content margin top-1"><?= $aux2[0] ?></h5> <!-- Replied content -->
                        <h6 class = "margin top-1 name"><?= date("F j, Y", strtotime($aux3[3])) ?></h6> <!-- Date -->
                    </div>

                    <p class = "content margin top-1"><?= $aux[2] ?></p> <!-- Content -->
                    
                </div>

                <h6 class = "margin top-2 name"><?= date("F j, Y", strtotime($post['ForumPost']['created'])) ?></h6>


            <?php else: ?>

                <div class="post">
                    <p class = "content margin top-1"><?= $post['ForumPost']['content'] ?></p>
                </div>

                <h6 class = "margin top-2 name"><?= date("F j, Y", strtotime($post['ForumPost']['created'])) ?></h6>

            <?php endif; ?>

          </td>
          <td class = "actions">
            <div class="forum action-icons">
                
                <a href = "<?= $this->Html->url(array('controller' => 'forum_posts', 'action' => 'reply', $post['ForumTopic']['id'], $post['ForumPost']['id'])) ?>"><span class="fa fa-reply fa-lg"></span></a>&nbsp;&nbsp;&nbsp;
                <a href = "<?= $this->Html->url(array('controller' => 'forum_posts', 'action' => 'edit', $post['ForumPost']['id'])) ?>"><span class="fa fa-pencil fa-lg"></span></a>&nbsp;&nbsp;
                <a href = "<?= $this->Html->url(array('controller' => 'forum_posts', 'action' => 'delete', $post['ForumPost']['id'])) ?>"><span class="fa fa-times fa-lg"></span></a>&nbsp;&nbsp;

                <?php

                // if ($user) {
                //     $isMod = $this->Forum->isMod($topic['Forum']['id']);

                //     if ($topic['Topic']['firstPost_id'] == $post_id) {
                //         if ($isMod || ($topic['Topic']['status'] && $user['User']['id'] == $post['Post']['user_id'])) {
                //             $links[] = $this->Html->link('<span class="fa fa-pencil fa-lg"></span>', array('controller' => 'topics', 'action' => 'edit', $topic['Topic']['slug'], (!empty($topic['Poll']['id']) ? 'poll' : '')), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Edit Topic')));
                //         }

                //         if ($isMod) {
                //             $links[] = $this->Html->link('<span class="fa fa-times fa-lg"></span>', array('controller' => 'topics', 'action' => 'delete', $topic['Topic']['slug']), array('escape' => false, 'confirm' => __d('forum', 'Are you sure you want to delete?'), 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Delete Topic')));
                //         }

                //         //$links[] = $this->Html->link('<span class="fa fa-flag"></span>', array('controller' => 'topics', 'action' => 'report', $topic['Topic']['slug']), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Report Topic')));
                //     } else {
                //         if ($isMod || ($topic['Topic']['status'] && $user['User']['id'] == $post['Post']['user_id'])) {
                //             $links[] = $this->Html->link('<span class="fa fa-pencil fa-lg"></span>', array('controller' => 'posts', 'action' => 'edit', $post_id), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Edit Post')));
                //             $links[] = $this->Html->link('<span class="fa fa-times fa-lg"></span>', array('controller' => 'posts', 'action' => 'delete', $post_id), array('escape' => false, 'confirm' => __d('forum', 'Are you sure you want to delete?'), 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Delete Post')));
                //         }

                //         //$links[] = $this->Html->link('<span class="fa fa-flag"></span>', array('controller' => 'posts', 'action' => 'report', $post_id), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Report Post')));
                //     }

                //     if ($canReply) {
                //         $links[] = $this->Html->link('<span class="fa fa-quote-left fa-lg"></span>', array('controller' => 'posts', 'action' => 'add', $topic['Topic']['slug'], $post_id), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Quote')));
                //     }
                // }

                // //$links[] = $this->Html->link('<span class="fa fa-link"></span>', '#post-' . $post_id, array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Link To This')));

                // if ($links) {
                //     echo implode(' ', $links);
                // } ?>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
</div>