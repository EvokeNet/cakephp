<?php
    if(!isset($user['User'])){
        $user['User'] = $user;
    }

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
        <?php if (!empty($topic['Poll']['id'])) {
            echo $this->Html->tag('span', '', array('class' => 'fa fa-bar-chart-o js-tooltip float-right', 'data-tooltip' => __d('forum', 'Poll')));
        } ?>

        <a href = "<?= $this->Html->url(array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])) ?>" class = "title">
            <?= $topic['Topic']['title'] ?>
        </a>

        <?php

        if (count($pages) > 1) { ?>
            <div class="topic-pages"><?php echo __d('forum', 'Pages'); ?>: [ <?php echo implode(', ', $pages); ?> ]</div>
        <?php } ?>

        <h5 class = "margin top-2 name"><?= sprintf(__('Posted by %s in %s'), $topic['User']['name'], date("F j, Y", strtotime($topic['Topic']['created']))) ?></h5>

      </div>

      <div class="small-2 medium-2 large-2 columns">
        <div class = "forum bubble">
            <a href = "<?= $this->Html->url(array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])) ?>">
            <h2 class = "text-align-center reply_number"><?php echo number_format($post_count); ?></h2>
            <h5 class = "text-align-center reply_number"><?= $reply ?></h5>
            </a>
        </div>

        <!-- <div class = "text-align-end margin top-2"><a href = "<?= $this->Html->url(array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'])) ?>" class = "button general green"><?= __('Reply') ?></a></div> -->

      </div>

    </div>

</div>

<!-- <tr>
    <?php if (in_array('status', $columns)) { ?>
        <td class="col-icon"><input type="checkbox" name="data[Topic][items][]" value="<?php echo $topic['Topic']['id']; ?>"></td>
    <?php } else { ?>
        <td class="col-icon"><?php echo $this->Forum->topicIcon($topic); ?></td>
    <?php } ?>
    <td>
        <?php if (!empty($topic['Poll']['id'])) {
            echo $this->Html->tag('span', '', array('class' => 'fa fa-bar-chart-o js-tooltip float-right', 'data-tooltip' => __d('forum', 'Poll')));
        } ?>

        <?php echo $this->Html->link($topic['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug']), array('class' => 'topic-title'));

        if (count($pages) > 1) { ?>
            <div class="topic-pages"><?php echo __d('forum', 'Pages'); ?>: [ <?php echo implode(', ', $pages); ?> ]</div>
        <?php } ?>
    </td>
    <?php if (in_array('forum', $columns)) { ?>
        <td class="col-parent"><?php echo $this->Html->link($topic['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $topic['Forum']['slug'])); ?></td>
    <?php } ?>
    <?php if (in_array('status', $columns)) { ?>
        <td class="col-status"><?php echo $this->Utility->enum('Forum.Topic', 'status', $topic['Topic']['status']); ?></td>
    <?php } ?>
    <td class="col-author">
        <?php echo $this->Html->link($topic['User'][$userFields['username']], $this->Forum->profileUrl($topic['User'])); ?>
    </td>
    <td class="col-created">
        <?php echo $this->Time->niceShort($topic['Topic']['created'], $this->Forum->timezone()); ?>
    </td>
    <td class="col-stat">
        <?php echo number_format($topic['Topic']['post_count']); ?>
    </td>
    <td class="col-stat">
        <?php echo number_format($topic['Topic']['view_count']); ?>
    </td>
    <td class="col-activity">
        <?php if (!empty($topic['LastPost']['id'])) {
            echo $this->Time->timeAgoInWords($topic['LastPost']['created'], array('timezone' => $this->Forum->timezone())); ?>

            <?php if (!empty($topic['LastUser']['id'])) { ?>
                <span class="text-muted"><?php echo __d('forum', 'by'); ?> <?php echo $this->Html->link($topic['LastUser'][$userFields['username']], $this->Forum->profileUrl($topic['LastUser'])); ?></span>
            <?php } ?>

            <?php echo $this->Html->link('<span class="fa fa-external-link"></span>', array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug'], 'page' => $topic['Topic']['page_count'], '#' => 'post-' . $topic['Topic']['lastPost_id']), array('escape' => false)); ?>
        <?php } else { ?>
            <em class="text-muted"><?php echo __d('forum', 'No latest activity to display'); ?></em>
        <?php } ?>
    </td>
</tr> -->