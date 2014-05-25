<?php

$this->Breadcrumb->add(__d('forum', 'Search'), array('controller' => 'search', 'action' => 'index')); 

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

            <div class = "default">
                <h3 class = "padding bottom-1"> <?= strtoupper(__('Search')) ?> </h3>
            </div>

            <div class="container">
                <?php echo $this->Form->create('Topic', array('class' => 'form--inline', 'url' => array('controller' => 'search', 'action' => 'proxy'))); ?>

                <div class="panel evoke topic new" id="search">
                    <?php
                    echo $this->Form->input('keywords', array('div' => 'field', 'label' => __d('forum', 'With keywords')));
                    echo $this->Form->input('forum_id', array('div' => 'field', 'label' => __d('forum', 'in forum'), 'options' => $forums, 'empty' => true));
                    echo $this->Form->input('byUser', array('div' => 'field', 'label' => __d('forum', 'by user')));
                    echo $this->Form->input('orderBy', array('div' => 'field', 'label' => __d('forum', 'order by'), 'options' => $orderBy)); ?>
                </div>

                <?php
                echo $this->Form->submit(__d('forum', 'Search Topics'), array('class' => 'button general'));
                echo $this->Form->end();

                if ($searching) {

                    if (!$topics) {
                        echo __d('forum', 'No results were found, please refine your search criteria');
                    } else { ?>

                        <div class = "evoke sheer-background">

                        <?php
                            foreach ($topics as $counter => $topic) {
                                echo $this->element('topic_item', array(
                                    'counter' => $counter,
                                    'topic' => $topic,
                                    'userFields' => $userFields,
                                ));
                            }
                        ?>
                        </div>
                    <?php

                    }

                    //echo $this->element('Admin.pagination', array('class' => 'top')); ?>

                    <!-- <div class="panel">
                        <div class="panel-body">
                            <table class="table table--hover table--sortable">
                                <thead>
                                    <tr>
                                        <th colspan="2"><?php echo $this->Paginator->sort('Topic.title', __d('forum', 'Topic')); ?></th>
                                        <th><?php echo $this->Paginator->sort('Topic.forum_id', __d('forum', 'Forum')); ?></th>
                                        <th><?php echo $this->Paginator->sort('User.' . $userFields['username'], __d('forum', 'Author')); ?></th>
                                        <th><?php echo $this->Paginator->sort('Topic.created', __d('forum', 'Created')); ?></th>
                                        <th><?php echo $this->Paginator->sort('Topic.post_count', __d('forum', 'Posts')); ?></th>
                                        <th><?php echo $this->Paginator->sort('Topic.view_count', __d('forum', 'Views')); ?></th>
                                        <th><?php echo $this->Paginator->sort('LastPost.created', __d('forum', 'Activity')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php if (!$topics) { ?>

                                    <tr>
                                        <td colspan="8" class="no-results"><?php echo __d('forum', 'No results were found, please refine your search criteria'); ?></td>
                                    </tr>

                                <?php } else {
                                    foreach ($topics as $counter => $topic) {
                                        echo $this->element('tiles/topic_row', array(
                                            'topic' => $topic,
                                            'counter' => $counter,
                                            'columns' => array('forum')
                                        ));
                                    }
                                } ?>

                                </tbody>
                            </table>
                        </div>
                    </div> -->

                    <?php //echo $this->element('Admin.pagination', array('class' => 'bottom'));
                } ?>
            </div>

        </div>

        <div class="medium-1 columns end"></div>
    </div>  

</section>