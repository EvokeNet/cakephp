<?php
    if (!empty($topic['Forum']['Parent']['slug'])) {
        $this->Breadcrumb->add($topic['Forum']['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $topic['Forum']['Parent']['slug']));
    }

    $this->Breadcrumb->add($topic['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $topic['Forum']['slug']));
    $this->Breadcrumb->add($topic['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug']));
    $this->Breadcrumb->add(__d('forum', 'Post Reply'), array('action' => 'add', $topic['Topic']['slug'])); 

    $this->extend('/Common/topbar');
    $this->start('menu');

    echo $this->element('forum_header');
    $this->end(); 

?>

<section class="evoke default-background">  

    <div class="evoke row full-width-alternate">

        <div class="small-2 medium-2 large-2 columns padding-left">
            <?php echo $this->element('menu', array('user' => $user));?>
        </div>  
        
        <div class="small-9 medium-9 large-9 columns padding top-2 bg-min-height maincolumn">

            <?php echo $this->Session->flash(); ?>
            
            <div class = "default">
                <h3 class = "padding bottom-1"> <?= strtoupper(__('Post Reply')) ?> </h3>
            </div>

            <div class="panel topic new">
                <?php
                    echo $this->Form->create('Post');
                    echo $this->Form->input('content', array('type' => 'textarea', 'rows' => 15, 'label' => __d('forum', 'Content')));
                    echo $this->element('new_decoda', array('id' => 'PostContent'));
                    echo $this->Form->submit(__d('forum', 'Post Reply'), array('class' => 'button success large'));
                    echo $this->Form->end();

                    if ($review) { ?>

                        <!-- <div class="panel">
                            <div class="panel-head">
                                <h5><?php echo __d('forum', 'Topic Review - Last 10 Replies'); ?></h5>
                            </div>

                            <div class="panel-body" id="topic-review">
                                <table class="table">

                                <?php foreach ($review as $post) { ?>

                                    <tr>
                                        <td colspan="2" class="align-right">
                                            <?php echo $this->Time->niceShort($post['Post']['created'], $this->Forum->timezone()); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="span-2">
                                            <h5><?php echo $this->Html->link($post['User'][$userFields['username']], $this->Forum->profileUrl($post['User'])); ?></h5>
                                        </td>
                                        <td>
                                            <?php echo $this->Decoda->parse($post['Post']['content']); ?>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </table>
                            </div>
                        </div> -->

                    <?php } ?>
            </div>

        </div>

        <div class="medium-1 columns end"></div>
    </div>  

</section>
