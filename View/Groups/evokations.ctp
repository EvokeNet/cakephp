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

	<div class="evoke row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-8 medium-8 large-8 columns margin top-2 maincolumn">

	  	<div class = "default">
	  		<h3 class = "margin bottom-1"><?= strtoupper(__('Evokations Teams')) ?></h3>
	  	</div>

		<div class="evoke sheer-background" style = "min-height:500px">

			<dl class="evokations tabs float-right" data-tab>
			  <dd class="active" id = "their"><a href="#panel2-1"><?= strtoupper(__('All Evokations')) ?></a></dd>
			  <dd><a href="#panel2-2" id = "mine"><?= strtoupper(__('My Evokations')) ?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">

			  	<div class="tabs-content">

			  		<?php 
			  			$counte = 0;
			  			$classe = '';

			  			foreach($missions as $m):
			  				$counte++;
			  				if($counte == 1)
			  					$classe = 'active'; 
			  				else
			  					$classe = ''; ?>

				  			<div class="content vertical <?= $classe ?>" id="panel21-<?= $m['Mission']['id'] ?>">
							    <!-- <p><?= strtoupper($m['Mission']['title'])?></p> -->

							    <?php foreach($evokations as $mg):
								//If the mission belongs to that category, it is printed
									if($mg['Group']['mission_id'] == $m['Mission']['id']):
										echo $this->element('evokation_box', array('e' => $mg, 'user' => $user, 'users' => $users_groups)); 
									endif; endforeach; 
								?>

							</div>

					<?php endforeach;  ?>

				</div>

			  </div>
			  <div class="content" id="panel2-2">

			    <div class="tabs-content">

			  		<?php 
			  			$counte2 = 0;
			  			$classe2 = '';

			  			foreach($missions as $m):
			  				$counte2++;
			  				if($counte2 == 1)
			  					$classe2 = 'active';
			  				else
			  					$classe2 = '';	?>

				  			<div class="content vertical <?= $classe2 ?>" id="panel31-<?= $m['Mission']['id'] ?>">
							    <!-- <p><?= strtoupper($m['Mission']['title'])?></p> -->

							    <?php foreach($myevokations as $mg):
								//If the mission belongs to that category, it is printed
									if($mg['Group']['mission_id'] == $m['Mission']['id']):
										echo $this->element('evokation_box', array('e' => $mg, 'user' => $user, 'users' => $users_groups)); 
									endif; endforeach; 
								?>
								
							</div>

					<?php endforeach;  ?>

				</div>

			  </div>
			</div>

		</div>

	  </div>

	  <div class="small-2 medium-2 large-2 columns margin top-6">

	  	<div class = "first-tabs">
		  	<div class = "default">
		  		<h3 class = "margin bottom-1"><?= strtoupper(__('By Missions')) ?></h3>
		  	</div>

		  	<dl class="leaderboard tabs vertical" data-tab>
		  		<?php 
		  			$count = 0;

		  			foreach($missions as $m):
		  				$count++;
		  				if($count == 1): ?>

			  			<dd class="active"><a href="#panel21-<?= $m['Mission']['id'] ?>"><?= strtoupper($m['Mission']['title'])?></a></dd>

			  		<?php else: ?>

			  			<dd><a href="#panel21-<?= $m['Mission']['id'] ?>"><?= strtoupper($m['Mission']['title'])?></a></dd>

			  		<?php endif; ?>

				<?php endforeach;  ?>

			</dl>
		</div>

		<div class = "second-tabs" style="display:none">
			<div class = "default">
		  		<h3 class = "margin bottom-1"><?= strtoupper(__('By Missions')) ?></h3>
		  	</div>

		  	<dl class="leaderboard tabs vertical" data-tab>
		  		<?php 
		  			$count = 0;

		  			foreach($missions as $m):
		  				$count++;
		  				if($count == 1): ?>

			  			<dd class="active"><a href="#panel31-<?= $m['Mission']['id'] ?>"><?= strtoupper($m['Mission']['title'])?></a></dd>

			  		<?php else: ?>

			  			<dd><a href="#panel31-<?= $m['Mission']['id'] ?>"><?= strtoupper($m['Mission']['title'])?></a></dd>

			  		<?php endif; ?>

				<?php endforeach;  ?>
			</dl>
		</div>

	  </div>

  </div>
</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('switch_tabs', array('inline' => false));
?>