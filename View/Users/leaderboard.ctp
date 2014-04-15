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
				<?php 
					$first = ' class="active"';
					$index = 1;
					foreach ($power_points as $pp) {
						echo '<dd'. $first.'><a href="#panel2-'. $index .'">'. $pp['PowerPoint']['name'] .'</a></dd>';
						$index++;
						$first = '';
					}
				?>
			</dl>
			<div class="tabs-content">
				<?php 
					$first = ' active';
					$index = 1;
					foreach ($power_points as $pp) {
						echo '<div class="content'. $first .'" id="panel2-'. $index .'">';
							echo '<ul>';
							$zeros = array();
							$pos = 1;
							foreach ($users as $usr) {
								if(isset($powerpoints_users[$pp['PowerPoint']['id']][$usr['User']['id']])) {
									echo '<li>';
									echo '<h1>'. $pos .'</h1>';
									echo '<img src = '. $this->webroot.'img/test_users/leslie.jpg' . ' class = "evoke dashboard users-icon">';
									echo '<span>'. $usr['User']['name'] . '</span>';
									echo '<span>|'. $pp['PowerPoint']['name'] .' Points: '.$powerpoints_users[$pp['PowerPoint']['id']][$usr['User']['id']].' pts</span>';
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
						$first = '';
					}
				?>

				
			</div>
		</div>
		<div class="small-3 medium-3 large-3 columns"></div>
	</div>
</section>