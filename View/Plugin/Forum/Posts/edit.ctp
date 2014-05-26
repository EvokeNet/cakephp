<?php
	if (!empty($post['Forum']['Parent']['slug'])) {
	    $this->Breadcrumb->add($post['Forum']['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $post['Forum']['Parent']['slug']));
	}

	$this->Breadcrumb->add($post['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $post['Forum']['slug']));
	$this->Breadcrumb->add($post['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $post['Topic']['slug']));
	$this->Breadcrumb->add(__d('forum', 'Edit Post'), array('action' => 'edit', $post['Topic']['slug'])); 

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
                <h3 class = "padding bottom-1"> <?= strtoupper(__('Edit Post')) ?> </h3>
            </div>

			<div class="panel topic new">
			    <?php
			    echo $this->Form->create('Post');
			    echo $this->Form->input('content', array('type' => 'textarea', 'rows' => 15, 'label' => __d('forum', 'Content')));
			    echo $this->element('new_decoda', array('id' => 'PostContent'));
			    echo $this->Form->submit(__d('forum', 'Update Post'), array('class' => 'button general green margin top-2'));
			    echo $this->Form->end(); ?>
			</div>

		</div>

        <div class="medium-1 columns end"></div>
    </div>  

</section>