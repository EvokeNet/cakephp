<?php if ($user) {
    $isMod = $this->Forum->isMod($forum['Forum']['id']); ?>

    <div class="action-buttons <?php echo isset($class) ? $class : ''; ?>">
        <?php 

        if ($user && $this->Admin->isAdmin()) {
            echo $this->Html->link(__d('forum', 'Admin'), array('controller' => 'admin', 'action' => 'index', 'plugin' => 'admin', 'admin' => false), array('class' => 'button general green'));
        }

        if ($settings['enableForumSubscriptions']) {
            if (empty($subscription)) {
                //echo $this->Html->link(__d('forum', 'Subscribe'), array('controller' => 'stations', 'action' => 'subscribe', $forum['Forum']['id']), array('class' => 'button subscription general green', 'onclick' => 'return Forum.subscribe(this);'));
            } else {
                //echo $this->Html->link(__d('forum', 'Unsubscribe'), array('controller' => 'stations', 'action' => 'unsubscribe', $subscription['Subscription']['id']), array('class' => 'button subscription general green', 'onclick' => 'return Forum.unsubscribe(this);'));
            }
        }

        if ($isMod) {
            echo $this->Html->link(__d('forum', 'Moderate'), array('controller' => 'stations', 'action' => 'moderate', $forum['Forum']['slug']), array('class' => 'button info general green'));
        }

        if ($forum['Forum']['status']) {

            echo $this->Html->link(__d('forum', 'Search'), array('controller' => 'search', 'action' => 'index'), array('class' => 'button general green'));
            
            if ($this->Forum->hasAccess('Forum.Topic', 'create', $forum['Forum']['accessPost']) || $isMod) {
                echo $this->Html->link(__d('forum', 'Create Topic'), array('controller' => 'topics', 'action' => 'add', $forum['Forum']['slug']), array('class' => 'button general green'));
            }

            if ($this->Forum->hasAccess('Forum.Poll', 'create', $forum['Forum']['accessPoll']) || $isMod) {
                //echo $this->Html->link(__d('forum', 'Create Poll'), array('controller' => 'topics', 'action' => 'add', $forum['Forum']['slug'], 'poll'), array('class' => 'button general green'));
            }
        } else {
            echo $this->Html->link(__d('forum', 'Closed'), 'javascript:;', array('class' => 'button is-disabled'));
        } ?>
    </div>
<?php } ?>