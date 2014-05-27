<?php
$pages = $this->Forum->topicPages($topic['Topic']);
$columns = isset($columns) ? $columns : array(); 

$post_count = 0;
$reply = strtoupper(_('Replies'));

if($topic['Topic']['post_count'] == 0)
    $post_count = $topic['Topic']['post_count'];
else
    $post_count = $topic['Topic']['post_count'] - 1;

if($post_count == 1)
    $reply = strtoupper(_('Reply'));

?>

<div class = "evoke forum-post-bg">
    <table>
      <!-- <thead>
        <tr>
          <th width="150"></th>
          <th></th>
        </tr>
      </thead> -->
      <tbody>
        <tr>
          <td width="120" class = "forum right-border">
            <a href = "<?= $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'profile', $post['User']['id'])) ?>">
                <?php if($post['User']['photo_attachment'] == null) : ?>
                    <?php if($post['User']['facebook_id'] == null) : ?>
                        <div class = "topic icon margin top"><img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/></div>
                    <?php else : ?> 
                        <div class = "topic icon margin top"><img src="https://graph.facebook.com/<?php echo $post['User']['facebook_id']; ?>/picture?type=large"/></div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class = "topic icon margin top"><img src="<?= $this->webroot.'files/attachment/attachment/'.$post['User']['photo_dir'].'/'.$post['User']['photo_attachment'] ?>"/></div>
                <?php endif; ?>

                <h6 class = "white margin top"><?= $post['User']['name'] ?></h6>
            </a>
          </td>
          <td width="80%"class = "forum padding left-2">

            <div class="post">
                <?php if ($isBuried) { ?>

                    <div class="buried-text text-muted">
                        <?php echo __d('forum', 'This post has been buried.'); ?>
                        <a href="javascript:;" onclick="return Forum.toggleBuried(<?php echo $post_id; ?>);"><?php echo __d('forum', 'View the buried post?'); ?></a>
                    </div>

                    <div class="post-buried" id="post-buried-<?php echo $post_id; ?>" style="display: none">
                        <?php echo $this->Decoda->parse($post['Post']['content']); ?>
                    </div>

                <?php
                } else {
                    echo $this->Decoda->parse($post['Post']['content']);
                } ?>
            </div>

            <?php if (!$isBuried && !empty($post['User'][$userFields['signature']])) { ?>
                <div class="signature">
                    <?php echo $this->Decoda->parse($post['User'][$userFields['signature']]); ?>
                </div>
            <?php } ?>
            <p class = "content margin top-1"><?php //echo $post['Post']['content']; ?></p>

            <?php

            if (count($pages) > 1) { ?>
                <div class="topic-pages"><?php echo __d('forum', 'Pages'); ?>: [ <?php echo implode(', ', $pages); ?> ]</div>
            <?php } ?>

            <h6 class = "margin top-2 name"><?= date("F j, Y", strtotime($post['Post']['created'])) ?>
            <?php //echo $this->Time->timeAgoInWords($post['Post']['created'], array('timezone' => $this->Forum->timezone())); ?>
            </h6>

          </td>
          <td class = "actions">
            <div class="forum action-icons">
                <?php
                $links = array();

                if ($user) {
                    $isMod = $this->Forum->isMod($topic['Forum']['id']);

                    if ($topic['Topic']['firstPost_id'] == $post_id) {
                        if ($isMod || ($topic['Topic']['status'] && $user['id'] == $post['Post']['user_id'])) {
                            $links[] = $this->Html->link('<span class="fa fa-pencil fa-lg"></span>', array('controller' => 'topics', 'action' => 'edit', $topic['Topic']['slug'], (!empty($topic['Poll']['id']) ? 'poll' : '')), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Edit Topic')));
                        }

                        if ($isMod) {
                            $links[] = $this->Html->link('<span class="fa fa-times fa-lg"></span>', array('controller' => 'topics', 'action' => 'delete', $topic['Topic']['slug']), array('escape' => false, 'confirm' => __d('forum', 'Are you sure you want to delete?'), 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Delete Topic')));
                        }

                        //$links[] = $this->Html->link('<span class="fa fa-flag"></span>', array('controller' => 'topics', 'action' => 'report', $topic['Topic']['slug']), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Report Topic')));
                    } else {
                        if ($isMod || ($topic['Topic']['status'] && $user['id'] == $post['Post']['user_id'])) {
                            $links[] = $this->Html->link('<span class="fa fa-pencil fa-lg"></span>', array('controller' => 'posts', 'action' => 'edit', $post_id), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Edit Post')));
                            $links[] = $this->Html->link('<span class="fa fa-times fa-lg"></span>', array('controller' => 'posts', 'action' => 'delete', $post_id), array('escape' => false, 'confirm' => __d('forum', 'Are you sure you want to delete?'), 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Delete Post')));
                        }

                        //$links[] = $this->Html->link('<span class="fa fa-flag"></span>', array('controller' => 'posts', 'action' => 'report', $post_id), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Report Post')));
                    }

                    if ($canReply) {
                        $links[] = $this->Html->link('<span class="fa fa-quote-left fa-lg"></span>', array('controller' => 'posts', 'action' => 'add', $topic['Topic']['slug'], $post_id), array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Quote')));
                    }
                }

                //$links[] = $this->Html->link('<span class="fa fa-link"></span>', '#post-' . $post_id, array('escape' => false, 'class' => 'js-tooltip', 'data-tooltip' => __d('forum', 'Link To This')));

                if ($links) {
                    echo implode(' ', $links);
                } ?>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
</div>


<!-- <div class = "evoke forum-post-bg">

    <div class="row full-width-alternate padding bottom-1" data-equalizer>
      <div class="small-2 medium-2 large-2 columns" data-equalizer-watch>
        <a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $post['User']['id'])) ?>">
            <?php if($post['User']['photo_attachment'] == null) : ?>
                <?php if($post['User']['facebook_id'] == null) : ?>
                    <div class = "topic icon"><img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/></div>
                <?php else : ?> 
                    <div class = "topic icon"><img src="https://graph.facebook.com/<?php echo $post['User']['facebook_id']; ?>/picture?type=large"/></div>
                <?php endif; ?>
            <?php else : ?>
                <div class = "topic icon"><img src="<?= $this->webroot.'files/attachment/attachment/'.$post['User']['photo_dir'].'/'.$post['User']['photo_attachment'] ?>"/></div>
            <?php endif; ?>

            <?= $post['User']['name'] ?>
        </a>
      </div>
      <div class="small-8 medium-8 large-8 columns" data-equalizer-watch>

        <p class = "content margin top-1"><?php echo $post['Post']['content']; ?></p>

        <?php

        if (count($pages) > 1) { ?>
            <div class="topic-pages"><?php echo __d('forum', 'Pages'); ?>: [ <?php echo implode(', ', $pages); ?> ]</div>
        <?php } ?>

        <h5 class = "margin top name"><?= date("F j, Y", strtotime($topic['Topic']['created'])) ?></h5>

      </div>

      <div class="small-2 medium-2 large-2 columns" data-equalizer-watch>

      </div>

    </div>

</div> -->