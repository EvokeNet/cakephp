<?php
    $this->OpenGraph->description($forum['Forum']['description']);

    if (!empty($forum['Parent']['slug'])) {
        //$this->Breadcrumb->add($forum['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $forum['Parent']['slug']));
    }

    $this->Breadcrumb->add($forum['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $forum['Forum']['slug'])); 

    $this->extend('/Common/topbar');
    $this->start('menu');

    echo $this->element('forum_header');
    $this->end(); 

?>

<section class="evoke leaderboard default-background">  

    <div class="evoke row full-width-alternate">

        <div class="small-2 medium-2 large-2 columns padding-left">
            <?php echo $this->element('menu', array('user' => $user));?>
        </div>  
        
        <div class="small-9 medium-9 large-9 columns maincolumn padding top-2">

            <?php echo $this->Session->flash(); ?>

            <?php //echo $this->element('tiles/topic_controls', array('topic' => $topic));
                
                // $this->Breadcrumb->prepend(__d('forum', 'Forum'), array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'index'));
                // echo $this->element('Admin.breadcrumbs');
            ?>

            <div class="title">
                <?php if ($forum['Forum']['parent_id']) {
                    // echo $this->element('tiles/forum_controls', array('forum' => $forum));
                    echo $this->element('forum_buttons', array('forum' => $forum));
                } ?>

                <h2><?php //echo h($forum['Forum']['title']); ?></h2>

                <?php if ($forum['Forum']['description']) { ?>
                    <p><?php //echo h($forum['Forum']['description']); ?></p>
                <?php } ?>
            </div>

            <div class="container">
                <?php if ($forum['Children']) { ?>

                    <div class="panel">
                        <div class="panel-head">
                            <h5><?php echo __d('forum', 'Sub-Forums'); ?></h5>
                        </div>

                        <div class="panel-body">
                            <table class="table table--hover">
                                <thead>
                                    <tr>
                                        <th colspan="2"><?php echo __d('forum', 'Forum'); ?></th>
                                        <th><?php echo __d('forum', 'Topics'); ?></th>
                                        <th><?php echo __d('forum', 'Posts'); ?></th>
                                        <th><?php echo __d('forum', 'Activity'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($forum['Children'] as $counter => $subForum) {
                                        echo $this->element('tiles/forum_row', array(
                                            'forum' => $subForum,
                                            'counter' => $counter
                                        ));
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php }

                // Cant post in top level
                if ($forum['Forum']['parent_id']) {
                    //echo $this->element('Admin.pagination', array('class' => 'top')); ?>

                    <!-- <div class="panel" id="topics"> -->
                    <div class = "evoke sheer-background">

                        <div>
                            <table class="table table--hover table--sortable">
                                <!-- <thead>
                                    <tr>
                                        <th colspan="2"><?php echo $this->Paginator->sort('Topic.title', __d('forum', 'Topic')); ?></th>
                                        <th><?php echo $this->Paginator->sort('User.' . $userFields['username'], __d('forum', 'Author')); ?></th>
                                        <th><?php echo $this->Paginator->sort('Topic.created', __d('forum', 'Created')); ?></th>
                                        <th><?php echo $this->Paginator->sort('Topic.post_count', __d('forum', 'Posts')); ?></th>
                                        <th><?php echo $this->Paginator->sort('Topic.view_count', __d('forum', 'Views')); ?></th>
                                        <th><?php echo $this->Paginator->sort('LastPost.created', __d('forum', 'Activity')); ?></th>
                                    </tr>
                                </thead> -->
                                <tbody>

                                <?php if ($stickies) {
                                    foreach ($stickies as $counter => $topic) {
                                        // echo $this->element('tiles/topic_row', array(
                                        //     'counter' => $counter,
                                        //     'topic' => $topic,
                                        //     'userFields' => $userFields,
                                        // ));

                                        echo $this->element('topic_item', array(
                                            'counter' => $counter,
                                            'topic' => $topic,
                                            'userFields' => $userFields,
                                        ));
                                    } ?>

                                    <tr class="divider">
                                        <td colspan="7"><?php echo __d('forum', 'Topics'); ?></td>
                                    </tr>

                                <?php }

                                if ($topics) {
                                    foreach ($topics as $counter => $topic) {
                                        // echo $this->element('tiles/topic_row', array(
                                        //     'counter' => $counter,
                                        //     'topic' => $topic
                                        // ));
                                        echo $this->element('topic_item', array(
                                            'counter' => $counter,
                                            'topic' => $topic,
                                            'userFields' => $userFields,
                                        ));
                                    }
                                } else { ?>

                                    <tr>
                                        <td colspan="7" class="no-results"><?php echo __d('forum', 'There are no topics within this forum'); ?></td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php //echo $this->element('Admin.pagination', array('class' => 'bottom')); ?>

                    <div class="statistics">
                        <?php $moderators = array();

                        if ($forum['Moderator']) {
                            foreach ($forum['Moderator'] as $mod) {
                                $moderators[] = $this->Html->link($mod['User'][$userFields['username']], $this->Forum->profileUrl($mod['User']));
                            }
                        } ?>

                        <!-- <table class="table">
                            <tbody>
                                <tr>
                                    <td class="align-right"><?php echo __d('forum', 'Total Topics'); ?>: </td>
                                    <td><strong><?php echo $forum['Forum']['topic_count']; ?></strong></td>

                                    <td class="align-right"><?php echo __d('forum', 'Increases Post Count'); ?>: </td>
                                    <td><strong><?php echo __d('forum', 'Yes'); ?></strong></td>

                                    <td class="align-right"><?php echo __d('forum', 'Can Read Topics'); ?>: </td>
                                    <td><strong><?php echo $this->Forum->hasAccess('Forum.Topic', 'read', $forum['Forum']['accessRead']) ? __d('forum', 'Yes') : __d('forum', 'No'); ?></strong></td>

                                    <td class="align-right"><?php echo __d('forum', 'Can Create Topics'); ?>: </td>
                                    <td><strong><?php echo $this->Forum->hasAccess('Forum.Topic', 'create', $forum['Forum']['accessPost']) ? __d('forum', 'Yes') : __d('forum', 'No'); ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="align-right"><?php echo __d('forum', 'Total Posts'); ?>: </td>
                                    <td><strong><?php echo $forum['Forum']['post_count']; ?></strong></td>

                                    <td class="align-right"><?php echo __d('forum', 'Auto-Lock Topics'); ?>: </td>
                                    <td><strong><?php echo $forum['Forum']['autoLock'] ? __d('forum', 'Yes') : __d('forum', 'No'); ?></strong></td>

                                    <td class="align-right"><?php echo __d('forum', 'Can Reply'); ?>: </td>
                                    <td><strong><?php echo $this->Forum->hasAccess('Forum.Post', 'create', $forum['Forum']['accessReply']) ? __d('forum', 'Yes') : __d('forum', 'No'); ?></strong></td>

                                    <td class="align-right"><?php echo __d('forum', 'Can Create Polls'); ?>: </td>
                                    <td><strong><?php echo $this->Forum->hasAccess('Forum.Poll', 'create', $forum['Forum']['accessPoll']) ? __d('forum', 'Yes') : __d('forum', 'No'); ?></strong></td>
                                </tr>
                                <?php if ($moderators) { ?>
                                    <tr>
                                        <td class="align-right"><?php echo __d('forum', 'Moderators'); ?>: </td>
                                        <td colspan="7"><?php echo implode(', ', $moderators); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table> -->
                    </div>

                    <?php //echo $this->element('tiles/forum_controls', array('forum' => $forum));
                } ?>
            </div>
        </div>

        <div class="medium-1 columns end"></div>

    </div>
</section>