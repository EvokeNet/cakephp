<?php
$this->OpenGraph->description($this->Text->truncate($this->Decoda->strip($topic['FirstPost']['content']), 150));

if (!empty($topic['Forum']['Parent']['slug'])) {
    $this->Breadcrumb->add($topic['Forum']['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $topic['Forum']['Parent']['slug']));
}

$this->Breadcrumb->add($topic['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $topic['Forum']['slug']));
$this->Breadcrumb->add($topic['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['Topic']['slug']));

$canReply = ($user && $topic['Topic']['status'] && $this->Forum->hasAccess('Forum.Post', 'create', $topic['Forum']['accessReply'])); 

$this->extend('/Common/topbar');
    $this->start('menu');

    echo $this->element('forum_header', array('user' => $user));
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
                <?php echo $this->element('topic_buttons', array('topic' => $topic)); ?>

                <!-- <h2>
                    <?php if ($topic['Topic']['type'] > Topic::NORMAL) {
                        echo '<span>' . $this->Utility->enum('Forum.Topic', 'type', $topic['Topic']['type']) . ':</span> ';

                    } else if ($topic['Topic']['status'] == Topic::CLOSED) {
                        echo '<span>' . __d('forum', 'Closed') . ':</span> ';
                    }

                    echo h($topic['Topic']['title']); ?>
                </h2> -->
            </div>

            <div class = "evoke sheer-background">
                <?php 
                    $counter = 0;
                    $yep = count($posts);
                    foreach ($posts as $post):
                        $counter++;
                        $post_id = $post['Post']['id'];
                        $hasRated = in_array($post_id, $ratings);
                        $isBuried = ($post['Post']['score'] <= $settings['ratingBuryThreshold']); 

                        if($counter == 1)
                            echo $this->element('topic', array('topic' => $topic, 'post' => $post, 'replies' => $yep, 'post_id' => $post_id, 'hasRated' => $hasRated, 'isBuried' => $isBuried, 'canReply' => $canReply));
                        else
                            echo $this->element('post', array('topic' => $topic, 'post' => $post, 'replies' => $yep, 'post_id' => $post_id, 'hasRated' => $hasRated, 'isBuried' => $isBuried, 'canReply' => $canReply));
                        ?>

                <?php endforeach;?>
            </div>

            <?php //echo $this->element('Admin.pagination', array('class' => 'bottom'));

            //echo $this->element('tiles/topic_controls', array('topic' => $topic));

            if ($settings['enableQuickReply'] && $canReply) { ?>

                <div class = "forum reply panel text-align-center">

                    <div class = "margin bottom-1"><a class = "title" name = "anchor"><?php echo __d('forum', 'Quick Reply'); ?></a></div>

                    <div class="panel-body">
                        <?php
                        echo $this->Form->create('Post', array('url' => array('controller' => 'posts', 'action' => 'add', $topic['Topic']['slug'])));
                        echo $this->Form->input('content', array(
                            'type' => 'textarea',
                            'rows' => 5,
                            'div' => false,
                            'error' => false,
                            'label' => false
                        ));
                        echo $this->element('new_decoda', array('id' => 'PostContent'));
                        echo $this->Form->submit(__d('forum', 'Post Reply'), array('class' => 'button general green'));
                        echo $this->Form->end(); ?>
                    </div>
                </div>

            <?php } ?>

        </div>

        <div class="medium-1 columns end"></div>
    </div>  

</section>