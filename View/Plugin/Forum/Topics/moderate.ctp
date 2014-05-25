<?php
    if (!empty($topic['Forum']['Parent']['slug'])) {
        $this->Breadcrumb->add($topic['Forum']['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $topic['Forum']['Parent']['slug']));
    }

    $this->Breadcrumb->add($topic['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $topic['Forum']['slug']));
    $this->Breadcrumb->add($topic['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug']));
    $this->Breadcrumb->add(__d('forum', 'Moderate'), array('controller' => 'topics', 'action' => 'moderate', $topic['Topic']['slug'])); 

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

            <div class="title">
                <div class="action-buttons">
                    <?php
                    echo $this->Html->link(__d('forum', 'Delete Topic'), array('controller' => 'topics', 'action' => 'delete', $topic['Topic']['slug']), array('class' => 'button error general green', 'confirm' => __d('forum', 'Are you sure you want to delete?')));
                    echo $this->Html->link(__d('forum', 'Return to Topic'), array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug']), array('class' => 'button general green')); ?>
                </div>

                <!-- <h2><span><?php echo __d('forum', 'Moderate'); ?>:</span> <?php echo h($topic['Topic']['title']); ?></h2> -->

                <div class = "default">
                    <h3 class = "padding bottom-1"> <?= strtoupper(sprintf(__('Moderate: %s'), h($topic['Topic']['title']))) ?> </h3>
                </div>
            </div>

            <div class="container">
                <?php echo $this->Form->create('Topic', array('class' => 'form--inline'));

                //echo $this->element('Admin.pagination', array('class' => 'top')); ?>
               
                <div class = "forum index">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="Forum.toggleCheckboxes(this, 'Post', 'items');"></th>
                                <th><?php echo __d('forum', 'User'); ?></th>
                                <th><?php echo __d('forum', 'Post'); ?></th>
                                <th><?php echo __d('forum', 'Date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($posts as $counter => $post) { ?>

                            <tr>
                                <td class="col-icon">
                                    <?php if ($post['Post']['id'] == $topic['Topic']['firstPost_id']) { ?>
                                        <em class="text-muted">X</em>
                                    <?php } else { ?>
                                        <input type="checkbox" name="data[Post][items][]" value="<?php echo $post['Post']['id']; ?>">
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link($post['User'][$userFields['username']], $this->Forum->profileUrl($post['User'])); ?>
                                </td>
                                <td>
                                    <?php echo $this->Text->truncate($this->Decoda->strip($post['Post']['content'], 100)); ?>
                                </td>
                                <td class="col-created">
                                    <?php echo $this->Time->niceShort($post['Post']['created'], $this->Forum->timezone()); ?>
                                </td>
                            </tr>

                        <?php } ?>

                        </tbody>
                    </table>
                </div>          

                <?php echo $this->element('Admin.pagination', array('class' => 'bottom')); ?>

                <div class="row">
                    <div class="small-4 small-centered large-uncentered columns">
                        <div class="mod-actions">
                            <?php
                            echo $this->Form->input('action', array('options' => array('delete' => __d('forum', 'Delete Post(s)')), 'div' => 'field', 'label' => __d('forum', 'Perform Action') . ': '));
                            echo $this->Form->submit(__d('forum', 'Process'), array('div' => false, 'class' => 'button small')); ?>
                        </div>
                    </div>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>

        </div>

        <div class="medium-1 columns end"></div>
    </div>  

</section>