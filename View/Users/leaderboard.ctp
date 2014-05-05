<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background">	

	<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
	</div>
	
	
	<div class="row full-width">

		<div class="small-11 small-centered columns">

		<?= $this->element('left_titlebar', array('title' => __('Leaderboard'))) ?>

		<dl class="tabs" data-tab style = "margin-bottom:20px!important">
			<dd class="active"><a id="xp" href="#panelXP"><?= __('Levels')?></a></dd>
			<?php 
				$index = 1;
				foreach ($power_points as $pp) {
					echo '<dd><a id="pp-'. $index.'" href="#panel2-'. $index .'">'. $pp['PowerPoint']['name'] .'</a></dd>';
					$index++;
				}
			?>
		</dl>

		<div class="evoke black-bg leaderboard">
			<h1><?= __("Your position: ") ?> <span id="positionHolder">5</span></h1>
			<div class="tabs-content evoke gray-solid-bg">
				<div class="content active" id="panelXP">

					<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
						<li><h2><?= strtoupper(__("Position")) ?></h2></li>
						<li><h2><?= strtoupper(__("Agent")) ?></h2></li>
						<li><h2><?= strtoupper(__("Level")) ?></h2></li>
						<li><h2><?= strtoupper(__("XP")) ?></h2></li>
						<?php 
							$pos = 1;
							foreach ($points_users as $p => $point) {
								foreach ($point as $usr) { 
									if($usr['id'] == $user['User']['id'])
										$position[0] = $pos;
									?>
									<li><h3 style = "color:#1f8cb2"><?= $pos ?></h3></li>

									<li>
										<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $usr['id']))?>">
										<?php if($usr['photo_attachment'] == null) : ?>
			  								<div>
			  									<img src="https://graph.facebook.com/<?php echo $usr['facebook_id']; ?>/picture?type=large" class = "evoke dashboard users-icon"/>
			  								</div>
			  								<h4><?= $usr['name'] ?></h4>
			  							<?php else : ?>
			  								<div>
			  									<img src="<?= $this->webroot.'files/attachment/attachment/'.$usr['photo_dir'].'/thumb_'.$usr['photo_attachment'] ?>" class = "evoke dashboard users-icon"/>
			  								</div>
			  								<h4><?= $usr['name'] ?></h4>
			  							<?php endif; ?>
			  							</a>
			  						</li>
		  							<li><h3><?= $usr['level']?></h3></li>
		  							<li><h3><?= $p ?></h3></li>
		  							<span class = "evoke leaderboard-border"></span>
									<?php 
									$pos++;
								}
							}
						?>
					</ul>

				</div>
				<?php 
					$index = 1;
					foreach ($power_points as $pp) {
						echo '<div class="content" id="panel2-'. $index .'">';
							echo '<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">';
							?>
							<li><h2><?= strtoupper(__("Position")) ?></h2></li>
							<li><h2><?= strtoupper(__("Agent")) ?></h2></li>
							<li><h2><?= strtoupper(__("Power")) ?></h2></li>
							<li><h2><?= strtoupper(__("Points")) ?></h2></li>
							<?php
							$pos = 1;
							foreach ($powerpoints_users[$pp['PowerPoint']['id']] as $pps => $ppusr) {
								foreach ($ppusr as $usr) {
									if($usr['id'] == $user['User']['id'])
										$position[$index] = $pos;
								 	?>
									<li><h3 style = "color:#1f8cb2"><?= $pos ?></h3></li>

									<li>
										<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $usr['id']))?>">
										<?php if($usr['photo_attachment'] == null) : ?>
				  							<div>
				  								<img src="https://graph.facebook.com/<?php echo $usr['facebook_id']; ?>/picture?type=large" class = "evoke dashboard users-icon"/>
				  							</div>
				  							<h4><?= $usr['name'] ?></h4>
				  						<?php else : ?>
				  							<div>
				  								<img src="<?= $this->webroot.'files/attachment/attachment/'.$usr['photo_dir'].'/thumb_'.$usr['photo_attachment'] ?>" class = "evoke dashboard users-icon"/>
				  							</div>
				  							<h4><?= $usr['name'] ?></h4>
				  						<?php endif; ?>
				  						</a>
				  					</li>
				  					<li><h3><?= $pp['PowerPoint']['name']?></h3></li>
				  					<li><h3><?= $pps ?></h3></li>
		  							<span class = "evoke leaderboard-border"></span>
									<?php 
									
									$pos++;
								}
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



<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	//echo $this->Html->script('/components/foundation/js/foundation.min.js');
	//echo $this->Html->script('/components/foundation/js/foundation.min.js', array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
?>
<script type="text/javascript" charset="utf-8">
	$("#positionHolder").text('<?= $position[0]?>');

	$("#xp").click(function() {
	   	$("#positionHolder").text('<?= $position[0]?>');
	});
	<?php 
		$i = 1;
		foreach ($power_points as $pp) {
			echo '$("#pp-'. $i.'").click(function() { $("#positionHolder").text("' . $position[$i]. '"); });';
			$i++;
		}

	?>
</script>