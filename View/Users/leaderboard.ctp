<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background">	

	<?= $this->element('menu', array('user' => $user)) ?>
	
	<?= $this->element('left_titlebar', array('title' => __('Leaderboard'))) ?>

	<div class="row full-width">

		<div class="small-11 small-centered columns">

		<dl class="tabs" data-tab style = "margin-bottom:20px!important">
			<dd class="active"><a href="#panelXP"><?= __('Levels')?></a></dd>
			<?php 
				$index = 1;
				foreach ($power_points as $pp) {
					echo '<dd><a href="#panel2-'. $index .'">'. $pp['PowerPoint']['name'] .'</a></dd>';
					$index++;
				}
			?>
		</dl>

		<div class="evoke black-bg leaderboard">
			<h1><?= sprintf(__("Your position: %s"), 10) ?>
			<div class="tabs-content evoke gray-solid-bg">
				<div class="content active" id="panelXP">

					<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
						<li><h2><?= strtoupper(__("Position")) ?></h2></li>
						<li><h2><?= strtoupper(__("Agent")) ?></h2></li>
						<li><h2><?= strtoupper(__("Level")) ?></h2></li>
						<li><h2><?= strtoupper(__("XP")) ?></h2></li>
						<?php 
							$pos = 1;
							$zeros = array();
							foreach ($users as $usr) {
								if(isset($points_users[$usr['User']['id']])) {?>

									<li><h3 style = "color:#1f8cb2"><?= $pos ?></h3></li>
									<li><img src = '<?= $this->webroot.'img/test_users/leslie.jpg' ?>' class = "evoke dashboard users-icon"><h4><?= $usr['User']['name'] ?></h4></li>
									<li><h3><?= $points_users['Level'][$usr['User']['id']] ?></h3></li>
									<li><h3><?= $points_users[$usr['User']['id']] ?></h3></li>
									<span class = "evoke leaderboard-border"></span>

								<?php
									$pos++;	
								} else {
									$zeros[] = $usr;
								}	
							}
							foreach ($zeros as $zero) {
								// echo '<li>';
								// echo '<h1>'. $pos .'</h1>';
								// echo '<img src = '. $this->webroot.'img/test_users/leslie.jpg' . ' class = "evoke dashboard users-icon">';
								// echo '<span>'. $zero['User']['name'] . '</span>';
								// echo '<span>Level 0 | Points 0</span>';
								// echo '</li>';?>

								<li><h3 style = "color:#1f8cb2"><?= $pos ?></h3></li>
								<li><img src = '<?= $this->webroot.'img/test_users/leslie.jpg' ?>' class = "evoke dashboard users-icon"><h4><?= $usr['User']['name'] ?></h4></li>
								<li><h3>0</h3></li>
								<li><h3>0</h3></li>

							<?php
								$pos++;	
							}	
						?>
					  <li><!-- Your content goes here --></li>
					  <li><!-- Your content goes here --></li>
					  <li><!-- Your content goes here --></li>
					  <li><!-- Your content goes here --></li>
					  <li><!-- Your content goes here --></li>
					  <li><!-- Your content goes here --></li>
					</ul>

				</div>
				<?php 
					$index = 1;
					foreach ($power_points as $pp) {
						echo '<div class="content" id="panel2-'. $index .'">';
							echo '<ul>';
							$zeros = array();
							$pos = 1;
							foreach ($users as $usr) {
								if(isset($powerpoints_users[$pp['PowerPoint']['id']][$usr['User']['id']])) {
									echo '<li>';
									echo '<h1>'. $pos .'</h1>';
									echo '<img src = '. $this->webroot.'img/test_users/leslie.jpg' . ' class = "evoke dashboard users-icon">';
									echo '<span>'. $usr['User']['name'] . '</span>';
									echo '<span> |'. $pp['PowerPoint']['name'] .' Points: '.$powerpoints_users[$pp['PowerPoint']['id']][$usr['User']['id']].' pts</span>';
									echo '</li>';
									$pos++;	
								} else {
									$zeros[] = $usr;
								}
								
							}
							foreach ($zeros as $zero) {
								echo '<li>';
								echo '<h1>'. $pos .'</h1>';
								echo '<img src = '. $this->webroot.'img/test_users/leslie.jpg' . ' class = "evoke dashboard users-icon">';
								echo '<span>'. $zero['User']['name'] . '</span>';
								echo '<span>|'. $pp['PowerPoint']['name'] .' Points: 0 pts</span>';
								echo '</li>';
								$pos++;	
							}								
							echo '</ul>';

						echo '</div>';
						$index++;
					}
				?>

				
			</div>
		</div>
		</div>
		
	</div>
</section>