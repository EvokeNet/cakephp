<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke leaderboard default-background">	

	<?php echo $this->Session->flash(); ?>

	<div class="evoke row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	
		
		<div class="small-8 medium-8 large-8 columns maincolumn padding top-2">

			<div class = "default">
				<h3 class = "padding bottom-1"> <?= strtoupper(__('Leaderboard')) ?> </h3>
			</div>

			<div class="evoke sheer-background headings">
				
				<h1 id="positionh1" class = "float-right"><?= strtoupper(__("Your position: ")) ?> <span id="positionHolder">5</span></h1>

				<ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5">
					<li><h3><?= strtoupper(__("Position")) ?></h3></li>
					<li><h3><?= strtoupper(__("Agent ID")) ?></h3></li>
					<li><h3><?= strtoupper(__("Agent name")) ?></h3></li>
					<li><h3><?= strtoupper(__("Level")) ?></h3></li>
					<li><h3><?= strtoupper(__("XP")) ?></h3></li>
				</ul>
				<?php 
					$pos = 1;
					foreach ($points_users as $p => $point):
						foreach ($point as $usr):
							if($usr['id'] == $user['User']['id'])
								$position[0] = $pos;
							?>
							<ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5">
								<li><h1 style = "font-size: 4rem; margin-left: 10%; margin-top: -5px; line-height: 1.0em;"><?= $pos ?></h1></li>

								<li>
									<a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $usr['id']))?>">
									<?php if($usr['photo_attachment'] == null) : 
		  								if($usr['facebook_id'] == null) : 
											$pic = $this->webroot.'img/user_avatar.jpg';
										else : 
											$pic = "https://graph.facebook.com/". $usr['facebook_id'] . "/picture?type=large";
										endif;
		  							else : 
		  								$pic =  $this->webroot.'files/attachment/attachment/'.$usr['photo_dir'].'/'.$usr['photo_attachment'];
		  							endif; ?>
									<div class="evoke dashboard users-icon" style="min-width: 5vw; min-height: 5vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;"></div>

		  							</a>
		  						</li>
		  						<li><h3 style = "font-size: 2.5rem;"><?= $usr['name'] ?></h3></li>
	  							<li><h3><?= $usr['level']?></h3></li>
	  							<li><h3><?= $p ?></h3></li>
	  							<span class = "evoke leaderboard-border"></span>
								</ul>
						<?php 
							$pos++;
						endforeach;
					endforeach;
				?>
				
			</div>
		</div>
			
		<div class="small-2 medium-2 large-2 columns">

			<div class="icon-bar vertical six-up margin top-6">
			  <a class="item" href = "<?= $this->webroot . 'users/leaderboard' ?>">
			    <i class="fa fa-heart"></i>
			    <label>Levels</label>
			  </a>
			  <a class="item" href = "<?= $this->webroot . 'users/leaderboard/evokation' ?>">
			    <i class="fa fa-heart"></i>
			    <label>Evokation</label>
			  </a>

			  <?php 
				$index = 1;
				foreach ($power_points as $pp): ?>

					<a class="item" href = "<?= $this->webroot . 'users/leaderboard/' . $index ?>">
					    <i class="fa fa-heart"></i>
					    <label><?= strtoupper($pp['PowerPoint']['name']) ?></label>
					</a>

				<?php endforeach; ?>

			</div>

		</div>

	</div>
</section>



<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	//echo $this->Html->script('/components/foundation/js/foundation.min.js');
	//echo $this->Html->script('/components/foundation/js/foundation.min.js', array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
?>

<script type="text/javascript" charset="utf-8">
	
	$("#positionHolder").text('<?= $position[0] ?>');

</script>