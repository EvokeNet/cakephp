<?php

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
?>

<section class="evoke default-background">

	<div class="evoke default row full-width-alternate profile">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-10 medium-10 large-10 columns maincolumn">
	  	<?php echo $this->Session->flash(); ?>

	  	<div class = "default">
            <h3 class = "padding bottom-1"> <?= strtoupper(__('Forum')) ?> </h3>
        </div>

        <div class="text-align-end">
            <?php 
                if ($user['User']['role_id'] == 1): ?>

                <a href = "<?= $this->Html->url(array('controller' => 'forum_topics', 'action' => 'add', $forum['Forum']['id'])) ?>" class = 'button general green'><?= __('Add Topic') ?></a>
            <?php
                endif;
            ?>
        </div>

        <div class="evoke sheer-background">
            <?php
            if (isset($topics)):
                foreach ($topics as $topic): ?>

            <div class = "evoke forum-topic-bg">
            	<div class = "row full-width-alternate padding bottom-1">

            		<div class = "small-2 medium-2 large-2 columns"></div>
            		<div class = "small-8 medium-8 large-8 columns"><a href = "<?= $this->Html->url(array('controller' => 'forum_topics', 'action' => 'view', $topic['ForumTopic']['id'])) ?>"><?= $topic['ForumTopic']['title'] ?></a></div>
            		<div class = "small-2 medium-2 large-2 columns"><?= $topic['ForumTopic']['forumPost_count'] ?></div>

                </div>

                <?php endforeach; endif; ?>
            </div>
        </div>

	  </div>
	
	</div>

</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>
