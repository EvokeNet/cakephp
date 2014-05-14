<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div id="secondModal" class="reveal-modal" data-reveal>
	  <h2>This is a second modal.</h2>
	  <p>See? It just slides into place after the other first modal. Very handy when you need subsequent dialogs, or when a modal option impacts or requires another decision.</p>
	  <a class="close-reveal-modal">&#215;</a>
	</div>

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-9 medium-9 large-9 columns padding top-2 maincolumn">

	  	<h3><?= strtoupper(__('Evokations Teams')) ?></h3>

		<div class="evoke groups-evokations sheer-background">
			<?php foreach($missions as $m):?>

			<h2 class = "white margin bottom-1"><?= $m['Mission']['title'] ?></h1>
			<?php foreach($myGroups as $mg):
			//If the mission belongs to that category, it is printed
				if($mg['Group']['mission_id'] == $m['Mission']['id']):
					echo $this->element('group_box', array('e' => $mg, 'user' => $user, 'users' => $users_groups)); 
				endif; endforeach; endforeach; 
			?>
		</div>

	  </div>

	  <div class="medium-1 end columns"></div>

  </div>
</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>