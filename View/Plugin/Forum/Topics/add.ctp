<?php
    if (!empty($forum['Parent']['slug'])) {
        //$this->Breadcrumb->add($forum['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $forum['Parent']['slug']));
    }

    $this->Breadcrumb->add($forum['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $forum['Forum']['slug']));
    $this->Breadcrumb->add($pageTitle, array('controller' => 'topics', 'action' => 'add', $forum['Forum']['slug']));

    $this->extend('/Common/topbar');
    $this->start('menu');

    echo $this->element('forum_header');
    $this->end(); 

?>

<section class="evoke default-background">  

    <?php echo $this->Session->flash(); ?>

    <div class="evoke row full-width-alternate">

        <div class="small-2 medium-2 large-2 columns padding-left">
            <?php echo $this->element('menu', array('user' => $user));?>
        </div>  
        
        <div class="small-9 medium-9 large-9 columns padding top-2 bg-min-height maincolumn">

            <?php //echo $this->element('tiles/topic_controls', array('topic' => $topic));
                
                // $this->Breadcrumb->prepend(__d('forum', 'Forum'), array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'index'));
                // echo $this->element('Admin.breadcrumbs');
            ?>

            <div class = "default">
                <h3 class = "padding bottom-1"> <?= strtoupper(__('Create Topic')) ?> </h3>
            </div>

            <div class="panel topic new">
                <?php
                echo $this->Form->create('Topic');
                echo $this->Form->input('title', array('label' => __d('forum', 'Title')));
                echo $this->Form->input('forum_id', array('options' => $forums, 'empty' => '-- ' . __d('forum', 'Select a Forum') . ' --', 'label' => __d('forum', 'Forum')));

                
                echo $this->Form->input('status', array('options' => $this->Utility->enum('Forum.Topic', 'status'), 'label' => __d('forum', 'Status')));
                echo $this->Form->input('type', array('options' => $this->Utility->enum('Forum.Topic', 'type'), 'label' => __d('forum', 'Type')));
            

                if ($type === 'poll') {
                    echo $this->Form->input('options', array(
                        'type' => 'textarea',
                        'label' => __d('forum', 'Poll Options'),
                        'after' => '<span class="input-help">' . __d('forum', 'One option per line. Max 10 options.') . '</span>',
                        'rows' => 5
                    ));

                    echo $this->Form->input('expires', array(
                        'label' => __d('forum', 'Expiration Date'),
                        'after' => '<span class="input-help">' . __d('forum', 'How many days till expiration? Leave blank to last forever.') . '</span>',
                        'class' => 'numeric'
                    ));
                }

                if ($forum['Forum']['excerpts']) {
                    $chars = isset($this->request->data['Topic']['excerpt']) ? strlen($this->request->data['Topic']['excerpt']) : 0;
                    $maxLength = $settings['excerptLength'];

                    echo $this->Form->input('excerpt', array(
                        'label' => __d('forum', 'Excerpt'),
                        'type' => 'textarea',
                        'rows' => 5,
                        'onkeyup' => 'Forum.charsRemaining(this, ' . $maxLength . ');',
                        'after' => '<span class="input-help">' . __d('forum', '%s characters remaining', '<span id="TopicExcerptCharsRemaining">' . ($maxLength - $chars) . '</span>') . '</span>',
                    ));
                }

                echo $this->Form->input('content', array(
                    'label' => __d('forum', 'Content'),
                    'type' => 'textarea',
                    'rows' => 15
                ));

                echo $this->element('new_decoda', array('id' => 'TopicContent'));
                echo $this->Form->submit($pageTitle, array('class' => 'button general green margin top-2'));
                echo $this->Form->end(); ?>
            </div>

        </div>

        <div class="medium-1 columns end"></div>
    </div>  

</section>