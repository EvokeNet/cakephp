<?php

/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>

<!--<div class = "forum-background margin-top-2em margin-bottom-2em">
		    <h2 class = "text-align-left uppercase"><?= $forumCategory['ForumCategory']['title'] ?></h2>
            
            <a class="button" href="/evoke/forum_topics/new_topic/<?= $forumCategory['ForumCategory']['id'] ?>">
                <?= ('NEW TOPIC') ?>
            </a>
        </div>-->
        
<div class="row">
    <div class="large-12 large-centered columns">

        <div class = "forum-background margin-top-2em margin-bottom-2em">
            
            <div class="row">
                <div class="large-11 large-centered columns">
                    <h2 class = "uppercase margin-top-05em"><?= $forumCategory['ForumCategory']['title'] ?></h2>
                    <p><?= $forumCategory['ForumCategory']['description'] ?></p>
                </div>
            </div>
            
            <a class="button bottom uppercase" href="/evoke/forum_topics/new_topic/<?= $forumCategory['ForumCategory']['id'] ?>">
                <?= ('New topic') ?>
            </a>
                
        </div>
        
    </div>
</div>
        
<div class="row">
      <div class="large-10 large-centered columns">

        <?php foreach ($forumTopics as $topic): ?>
            <?php if(isset($topic['ForumTopic']['title'])):?>
                <div class= "forum-category">
                    
                    <a href="/evoke/forum_topics/view/<?= $topic['ForumTopic']['id'] ?>">
                        <h4 class = "font-green"><?= $topic['ForumTopic']['title'] ?></h4>
                    </a>

                    <a href="/evoke/users/profile/<?= $topic['ForumTopic']['user_id'] ?>">
                        <?= $topic['User']['name'] ?>
                    </a>

                    <span class = "margin-left-2em">
                        <i class="fa fa-comment"></i>&nbsp;&nbsp;&nbsp;<?= $topic['0']['answers'] ?>
                    </span>

                    <span class = "margin-left-2em">
                        <i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;<?= $topic['ForumTopic']['view_count'] ?>
                    </span> 

                    <span class = "right">
                        <?= date("d/m/Y", strtotime($topic['ForumTopic']['created'])) ?>
                    </span>                    
                    
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
            
       </div>
</div>