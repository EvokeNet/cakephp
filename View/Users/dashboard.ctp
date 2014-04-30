<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('jcarousel');
	//echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');

	$name = explode(' ', $users['User']['name']);

	echo $this->element('header', array('user' => $users, 'sumMyPoints' => $sumMyPoints));
	$this->end(); 
?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">
	  <div class="small-2 medium-2 large-2 columns">
	  	<h3> <?= strtoupper(__('Evidence')) ?> </h3>
	  </div>

	  <div class="small-7 medium-7 large-7 columns">
	  	<h3> <?= strtoupper(__('Evidence/Project Stream')) ?> </h3>

	  	<dl class="default tabs" data-tab>
		  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('All Evidence')) ?></a></dd>
		  <dd><a href="#panel2-2"><?= strtoupper(__('Projects I Follow')) ?></a></dd>
		  <dd><a href="#panel2-3"><?= strtoupper(__('My Projects')) ?></a></dd>
		</dl>
		<div class="evoke content-block default tabs-content">
		  <div class="content active" id="panel2-1">
		    
		    <?php 
	    		//Lists all projects and evidences
	    		foreach($evidence as $e): 
	    				//echo $this->element('evidence_blue_box', array('e' => $e)); 
	    				echo $this->element('evidence_box', array('e' => $e)); 
	    				echo $this->element('evidence', array('e' => $e)); 
	    		endforeach; 


	    		foreach($evokations as $e):
	    			$showFollowButton = true;
	    			foreach($myEvokations as $my)
	    				if(array_search($my['Evokation']['id'], $e['Evokation'])) {
	    					$showFollowButton = false;
	    					break;
	    				}
	    			if($showFollowButton) 
	    				echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
	    			else
	    				echo $this->element('evokation_box', array('e' => $e, 'mine' => true));
				endforeach;
			?>

		  </div>
		  <div class="content" id="panel2-2">
		    <p>Second panel content goes here...</p>
		  </div>
		  <div class="content" id="panel2-3">
		    <p>Third panel content goes here...</p>
		  </div>
		</div>

	  </div>

	  <div class="small-3 medium-3 large-3 columns">
	  	
	  	<h3> <?= strtoupper(__('Feed')) ?> </h3>
	  	<div class = "evoke content-block padding-10">
	  		YAY
	  	</div>

	  	<h3> <?= strtoupper(__('Discussions')) ?> </h3>
	  	<div class = "evoke content-block padding-10">
	  		YAY
	  	</div>

	  </div>
	</div>

</section>

<?php
	echo $this->Html->script('reveal_modal', array('inline' => false));
	// echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('/components/jcarousel/dist/jquery.jcarousel', array('inline' => false));
	//echo $this->Html->script('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->script('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->script('/components/jcarousel/examples/responsive/jcarousel.responsive', array('inline' => false));



?>

<script>

	// $('#formModal').foundation('reveal', 'open');

</script>
