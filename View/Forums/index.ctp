<?php
/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>   
 
<div class="row margin-top-2em">
    <div class="large-12 large-centered columns">
        
	<?php foreach ($forums as $forum): ?>
		
        <h2 class = "font-green uppercase"><?= $forum['Forum']['title'] ?></h2>
        
        <p><?= $forum['Forum']['description'] ?></p>
        
        <?php foreach ($forumCategories[$forum['Forum']['id']] as $forumCategory): ?>
            <div class="forum-category">
                <a href="/evoke/forum_categories/view/<?php echo $forumCategory['ForumCategory']['id']?>">
                    <h4 class = "font-green"><?= $forumCategory['ForumCategory']['title'] ?></h4>
                </a>
                <span><?= $forumCategory['ForumCategory']['description'] ?></span>
            </div>
        <?php endforeach; ?>
		
	<?php endforeach; ?>

    </div>
</div>

