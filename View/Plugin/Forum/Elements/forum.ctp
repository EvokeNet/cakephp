<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
    <li><h3><a href = "<?= $this->Html->url(array('controller' => 'stations', 'action' => 'view', $forum['slug'])) ?>"><?= strtoupper($forum['title']) ?></a></h3></li>
    <li><h3><?php echo number_format($forum['topic_count']); ?></h3></li>
    <li><h3><?php echo number_format($forum['post_count']); ?></h3></li>
    <li><h3><?php if (!empty($forum['LastTopic']['id'])) {
        $lastTime = isset($forum['LastPost']['created']) ? $forum['LastPost']['created'] : $forum['LastTopic']['modified'];

        echo $this->Html->link($forum['LastTopic']['title'], array('controller' => 'topics', 'action' => 'view', $forum['LastTopic']['slug'])); ?>

        <span>&nbsp;&nbsp;(<?php echo $this->Time->timeAgoInWords($lastTime, array('timezone' => $this->Forum->timezone())); ?>)</span>

        <?php if (!empty($forum['LastUser']['id'])) { ?>
            <span class="text-muted"><?php //echo __d('forum', 'by'); ?> <?php //echo $this->Html->link($forum['LastUser'][$userFields['username']], $this->Forum->profileUrl($forum['LastUser'])); ?></span>
        <?php }
    } else { ?>
        <span class="text-muted"><?php echo __d('forum', 'No latest activity to display'); ?></span>
    <?php } ?></h3></li>
</ul>
