<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
	echo $this->element('header', array('user' => $user));

	$this->end(); 
	$this->Html->css('dashboard');
?>

<section class="evoke margin top-2">
	<div class="row full-width">
		<h1><?php echo __('Leadercloud');?></h1>
		<div class="evoke screen-box dashboard leadercloud margin">
		
			<dl class="tabs" data-tab>
				<dd class="active"><a href="#panelXP"><?= __('Levels')?></a></dd>
				<?php 
					$index = 1;
					foreach ($power_points as $pp) {
						echo '<dd><a href="#panel2-'. $index .'">'. $pp['PowerPoint']['name'] .'</a></dd>';
						$index++;
					}
				?>
			</dl>
			<div class="tabs-content">
				<div class="content active" id="panelXP">
					<ul>
					<?php 
						$pos = 1;
						$zeros = array();
						foreach ($users as $usr) {
							if(isset($points_users[$usr['User']['id']])) {
								echo '<li>';
								echo '<h1>'. $pos .'</h1>';
								echo '<img src = '. $this->webroot.'img/test_users/leslie.jpg' . ' class = "evoke dashboard users-icon">';
								echo '<span>'. $usr['User']['name'] . '</span>';
								echo '<span>Level '. $points_users['Level'][$usr['User']['id']] .' | Points '. $points_users[$usr['User']['id']] .'</span>';
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
							echo '<span>Level 0 | Points 0</span>';
							echo '</li>';
							$pos++;	
						}	
					?>
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
		<div class="small-3 medium-3 large-3 columns"></div>
	</div>
</section>