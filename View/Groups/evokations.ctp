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

		<div class="evoke sheer-background">

			<dl class="evokations tabs float-right" data-tab>
			  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('All Evokation Teams')) ?></a></dd>
			  <dd><a href="#panel2-2"><?= strtoupper(__('My Evokation Teams')) ?></a></dd>
			</dl>
			<div class="tabs-content">
			  <div class="content active" id="panel2-1">

			    <?php foreach($missions as $m):?>

				<h3 class = "white margin bottom-1 top-2"><?= $m['Mission']['title'] ?></h3>
				<?php foreach($myGroups as $mg):
				//If the mission belongs to that category, it is printed
					if($mg['Group']['mission_id'] == $m['Mission']['id']):
						echo $this->element('group_box', array('e' => $mg, 'user' => $user, 'users' => $users_groups)); 
					endif; endforeach; endforeach; 
				?>

			  </div>
			  <div class="content" id="panel2-2">

			    <?php foreach($missions as $m):?>

				<h3 class = "white margin bottom-1 top-2"><?= $m['Mission']['title'] ?></h3>
				<?php foreach($myGroups as $mg):
				//If the mission belongs to that category, it is printed
					if($mg['Group']['mission_id'] == $m['Mission']['id']):
						echo $this->element('group_box', array('e' => $mg, 'user' => $user, 'users' => $users_groups)); 
					endif; endforeach; endforeach; 
				?>

			  </div>
			</div>

		</div>

	  </div>

	  <div class="small-2 medium-2 large-2 columns margin top-6">

	  	<div class = "default">
	  		<h3 class = "margin bottom-1"><?= strtoupper(__('By Missions')) ?></h3>
	  	</div>

	  	<dl class="leaderboard tabs vertical" data-tab>
			<dd class="active"><a id="xp" href="#panel21-1"><?= strtoupper(__('Levels'))?></a></dd>
			<dd><a id="xp" href="#panel21-2"><?= strtoupper(__('Levels'))?></a></dd>
			<dd><a id="xp" href="#panel21-3"><?= strtoupper(__('Levels'))?></a></dd>
			<?php 
				// $index = 1;
				// foreach ($power_points as $pp) {
				// 	echo '<dd><a id="pp-'. $index.'" href="#panel2-'. $index .'">'. strtoupper($pp['PowerPoint']['name']) .'</a></dd>';
				// 	$index++;
				// }
			?>
		</dl>

	  </div>

	  <!-- <div class="medium-1 end columns"></div> -->

  </div>
</section>

<?php
	echo $this->Html->script('menu_height', array('inline' => false));
?>