<?php

    $post_count = count($topic['ForumPost']);
    $reply = __('%s Replies');

    if($post_count == 1)
        $reply = __('%s Reply');

?>

<div class = "evoke forum-topic-bg">

    <div class="row full-width-alternate padding bottom-1">
      <div class="small-2 medium-2 large-2 columns">
        <a href = "<?= $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'profile', $topic['User']['id'])) ?>">
            <?php if($topic['User']['photo_attachment'] == null) : ?>
                <?php if($topic['User']['facebook_id'] == null) : ?>
                    <?php $pic = $this->webroot.'img/user_avatar.jpg'; ?>
                <?php else : ?> 
                    <?php $pic = "https://graph.facebook.com/". $topic['User']['facebook_id']. "/picture?type=large"; ?>
                <?php endif; ?>
            <?php else : ?>
                <?php $pic = $this->webroot.'files/attachment/attachment/'.$topic['User']['photo_dir'].'/'.$topic['User']['photo_attachment']; ?>
            <?php endif; ?>
            <div style="min-width: 5vw; max-width: 5vw; min-height: 5vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;"></div>
        </a>
      </div>
      <div class="small-8 medium-8 large-8 columns">
        
        <a href = "<?= $this->Html->url(array('controller' => 'forum_topics', 'action' => 'view', $topic['ForumTopic']['id'])) ?>" class = "title">
            <?= $topic['ForumTopic']['title'] ?>
        </a>

        <h5 class = "margin top-2 name"><?= sprintf(__('Posted by %s in %s'), $topic['User']['name'], date("F j, Y", strtotime($topic['ForumTopic']['created']))) ?></h5>

      </div>

      <div class="small-2 medium-2 large-2 columns">
        <div class = "forum bubble">
            <a href = "<?= $this->Html->url(array('controller' => 'forum_topics', 'action' => 'view', $topic['ForumTopic']['id'])) ?>">
            <h2 class = "text-align-center reply_number"><?= $topic['ForumTopic']['forumPost_count'] ?></h2>
            <h5 class = "text-align-center reply_number"><?= sprintf($reply, $post_count) ?></h5>
            </a>
        </div>

      </div>

    </div>

</div>