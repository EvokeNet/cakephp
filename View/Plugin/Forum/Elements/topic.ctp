<?php
$pages = $this->Forum->topicPages($topic['Topic']);
$columns = isset($columns) ? $columns : array(); 

$post_count = 0;
$reply = strtoupper(_('Replies'));

if($replies == 0)
    $post_count = $replies;
else
    $post_count = $replies - 1;

if($post_count == 1)
    $reply = strtoupper(_('Reply'));

?>

<div class = "evoke forum-topic-bg custom-padding">

    <div class="text-align-end margin bottom-1">
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
        </a>
      </div>
      <div class="small-8 medium-8 large-8 columns" data-equalizer-watch>

        <a href = "<?= $this->Html->url(array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])) ?>" class = "title">
            <?= $topic['Topic']['title'] ?>
        </a>

        <?php

        if (count($pages) > 1) { ?>
            <div class="topic-pages"><?php echo __d('forum', 'Pages'); ?>: [ <?php echo implode(', ', $pages); ?> ]</div>
        <?php } ?>

        <h5 class = "margin top name"><?= sprintf(__('Posted by %s in %s'), $post['User']['name'], date("F j, Y", strtotime($topic['Topic']['created']))) ?></h5>

      </div>

      <div class="small-2 medium-2 large-2 columns" data-equalizer-watch>
        <div class = "forum bubble">
            <a href = "<?= $this->Html->url(array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])) ?>">
            <h2 class = "text-align-center reply_number"><?php echo number_format($post_count); ?></h2>
            <h5 class = "text-align-center reply_number"><?= $reply ?></h5>
            </a>
        </div>

        <!-- <div class = "text-align-end margin top-2"><a href = "<?= $this->Html->url(array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])) ?>" class = "button general green"><?= __('Reply') ?></a></div> -->

      </div>

    </div>

    <p class = "content margin top-1"><?php echo $post['Post']['content']; ?></p>

    <!-- <div class = "margin top-2 bottom-1">
        <i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;&nbsp;0 <?= __('Likes') ?>
    </div> -->

</div>