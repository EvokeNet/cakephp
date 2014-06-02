<?php
    
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
        
        <div class="small-9 medium-9 large-9 columns maincolumn padding top-2 bg-min-height">

            <?php echo $this->Session->flash(); ?>
            <div class = "default">
                <h3 class = "padding bottom-1"> <?= strtoupper(__('Forum')) ?> </h3>
            </div>

            <div class="text-align-end">
                <?php 
                    if ($user && $this->Admin->isAdmin()) {
                        echo $this->Html->link(__d('forum', 'Admin'), array('controller' => 'admin', 'action' => 'index', 'plugin' => 'admin', 'admin' => false), array('class' => 'button general green'));
                    } 
                ?>
            </div>

            <div class="evoke sheer-background">
                <?php
                if ($forums) {
                    foreach ($forums as $forum) { ?>

                <!-- <div class="panel">
                    <div class="panel-head">
                        <h3><?php echo h($forum['Forum']['title']); ?></h3>
                    </div> -->
                <div class = "evoke forum index">
                    <ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
                        <li><h2><?= strtoupper(__("Forum")) ?></h2></li>
                        <li><h2><?= strtoupper(__("Topics")) ?></h2></li>
                        <li><h2><?= strtoupper(__("Posts")) ?></h2></li>
                        <li><h2><?= strtoupper(__("Last Activity")) ?></h2></li>
                    </ul>

                    <?php if ($forum['Children']) {
                        foreach ($forum['Children'] as $counter => $child) {
                            echo $this->element('forum', array(
                                'forum' => $child,
                                'counter' => $counter
                            ));
                        }
                    } else { ?>

                        <h2><?php echo __d('forum', 'There are no categories within this forum'); ?></h2>

                    <?php } ?>
                </div>

                <div class = "forum index">
                    <!-- <table>
                      <thead>
                        <tr>
                          <th><?php echo __d('forum', 'Forum'); ?></th>
                          <th width="150" class = "text-align-center"><?php echo __d('forum', 'Topics'); ?></th>
                          <th width="150" class = "text-align-center"><?php echo __d('forum', 'Posts'); ?></th>
                          <th width="300" class = "text-align-center"><?php echo __d('forum', 'Activity'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($forum['Children']) {
                            foreach ($forum['Children'] as $counter => $child) {
                                echo $this->element('new_forum_row', array(
                                    'forum' => $child,
                                    'counter' => $counter
                                ));
                            }
                        } else { ?>

                            <tr>
                                <td colspan="5" class="no-results"><?php echo __d('forum', 'There are no categories within this forum'); ?></td>
                            </tr>

                        <?php } ?>
                      </tbody>
                    </table> -->

                    <!-- <table class="table table--hover">
                        <thead>
                            <tr>
                                <th colspan="2"><?php echo __d('forum', 'Forum'); ?></th>
                                <th><?php echo __d('forum', 'Topics'); ?></th>
                                <th><?php echo __d('forum', 'Posts'); ?></th>
                                <th><?php echo __d('forum', 'Activity'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php if ($forum['Children']) {
                            foreach ($forum['Children'] as $counter => $child) {
                                echo $this->element('tiles/forum_row', array(
                                    'forum' => $child,
                                    'counter' => $counter
                                ));
                            }
                        } else { ?>

                            <tr>
                                <td colspan="5" class="no-results"><?php echo __d('forum', 'There are no categories within this forum'); ?></td>
                            </tr>

                        <?php } ?>

                        </tbody>
                    </table> -->

                </div>

                <?php } } ?>

                <?php echo $this->element('login'); ?>
            </div>

            <!-- <div class="row">
              <div class="small-4 small-centered large-uncentered columns">
                <div class="panel statistics">
                    <div class="total-stats">
                        <b><?php echo __d('forum', 'Statistics'); ?>:</b> <?php printf(__d('forum', '%d topics, %d posts, and %d users'), $totalTopics, $totalPosts, $totalUsers); ?>
                    </div>

                    <?php if ($newestUser) { ?>
                        <div class="newest-user">
                            <b><?php echo __d('forum', 'Newest User'); ?>:</b> <?php echo $this->Html->link($newestUser['User'][$userFields['username']], $this->Forum->profileUrl($newestUser['User'])); ?>
                        </div>
                    <?php }

                    if ($whosOnline) {
                        $onlineUsers = array();

                        foreach ($whosOnline as $online) {
                            $onlineUsers[] = $this->Html->link($online['User'][$userFields['username']], $this->Forum->profileUrl($online['User']));
                        } ?>

                        <div class="whos-online">
                            <b><?php echo __d('forum', 'Whos Online'); ?>:</b> <?php echo implode(', ', $onlineUsers); ?>
                        </div>
                    <?php } ?>
                </div>
              </div>
            </div> -->
                
        </div>

        <div class="medium-1 columns end"></div>
    </div>  

</section>
