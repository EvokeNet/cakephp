<?php

/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
    
    // var_dump($forumTopic);
?>

<div class="row">
    <div class="large-12 large-centered columns">

        <div class = "forum-background margin-top-2em margin-bottom-2em">
            
            <div class="row">
                <div class="large-10 large-centered columns">
            
                    <h2 class = "text-align-left uppercase margin-top-05em"><?= $forumTopic['ForumTopic']['title'] ?></h2>
                    
                    <div class = "margin-top-2em">
                        <a href="/evoke/users/profile/<?= $forumTopic['User']['id'] ?>">
                            <h4 class = "display-inline"><?= $forumTopic['User']['name'] ?></h4>
                        </a>

                        <!--<span class = "margin-left-2em">
                            <i class="fa fa-comment"></i>&nbsp;&nbsp;&nbsp;<?= $forumTopic['0']['answers'] ?>
                        </span>

                        <span class = "margin-left-2em">
                            <i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;<?= $forumTopic['ForumTopic']['view_count'] ?>
                        </span> -->
                        
                        <span class = "right">
                            <?= date("d/m/Y", strtotime($forumTopic['ForumTopic']['created'])) ?>
                        </span>
                        
                        <p class = "margin-top-2em">
                            <?= $forumTopic['ForumTopic']['content'] ?>
                        </p>
                                        
                    </div>
                
                </div>
            </div>
            
            <?php if($forumTopic['User']['id'] == $loggedInUser['id']): ?>
            <div class = "button-top">
                
                <!-- EDIT BUTTON -->
                <a class="button" href="/evoke/forum_topics/edit/<?= $forumTopic['ForumTopic']['id'] ?>">
                    <i class="fa fa-pencil fa-1x"></i>
                </a>

                <!-- DELETE BUTTON -->
                <form action="/evoke/forum_topics/delete/<?=$forumTopic['ForumTopic']['id']?>" name="delete<?=$forumTopic['ForumTopic']['id']?>" id="delete<?=$forumTopic['ForumTopic']['id']?>" style="display:none;" method="post">
                    <input type="hidden" name="_method" value="POST">
                </form>
                <a class="button" href="#" onclick="if (confirm('Are you sure you want to delete # 1?')) { document.delete<?=$forumTopic['ForumTopic']['id']?>.submit(); } event.returnValue = false; return false;">
                    <i class="fa fa-trash-o fa-1x"></i>
                </a>
                
            </div>
            <?php endif; ?>
            
            <a class="button bottom" href="/evoke/forum_topics/post/<?= $forumTopic['ForumTopic']['id'] ?>">
                <?= ('Reply') ?>
            </a>
            
        </div>
        
    </div>
</div>

<div class="row">
      <div class="large-10 large-centered columns">

        <?php foreach ($forumPosts as $post): ?>

            <div class= "forum-category">
                
                <div class="row">                    
                    <div class="large-3 columns text-align-center">
                        <?= $post['User']['name'] ?>
                        
                        <?php if($post['User']['id'] == $loggedInUser['id']): ?>
                        <div>
                            <!-- EDIT BUTTON -->
                            <a class="button" href="/evoke/forum_posts/edit/<?= $post['ForumPost']['id'] ?>">
                                <i class="fa fa-pencil fa-1x"></i>
                            </a>

                            <!-- DELETE BUTTON -->
                            <form action="/evoke/forum_posts/delete/<?=$post['ForumPost']['id']?>" name="delete<?=$post['ForumPost']['id']?>" id="delete<?=$post['ForumPost']['id']?>" style="display:none;" method="post">
                                <input type="hidden" name="_method" value="POST">
                            </form>
                            <a class="button" href="#" onclick="if (confirm('Are you sure you want to delete # 1?')) { document.delete<?=$post['ForumPost']['id']?>.submit(); } event.returnValue = false; return false;">
                                <i class="fa fa-trash-o fa-1x"></i>
                            </a>
                        </div>
                        <?php endif; ?>
            
                    </div>
                    
                    <div class="large-9 columns">
                        
                        <a href="/evoke/forum_topics/view/<?= $post['ForumPost']['id'] ?>">
                            <h4 class = "font-green"><?= $post['ForumPost']['title'] ?></h4>
                        </a>
                        
                        <div>
                            <?= $post['ForumPost']['content'] ?>                   
                        </div>
                            
                    </div>
                    
                </div>
            
            </div>
            
        <?php endforeach; ?>
            
       </div>
</div>

