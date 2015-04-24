<?php
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();
?>


<section class="leaderboard">	

	<?php echo $this->Session->flash(); ?>

	<div class="row full-width">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	
		
		<div class="small-8 medium-8 large-8 columns maincolumn padding top-2">

			<div>
				<h1 class="text-color-highlight text-center"> <?= strtoupper(__('Leaderboard by levels')) ?> </h1>
			</div>

			<div class="evoke sheer-background headings">
				
				<h2 id="positionh1" class="text-center padding bottom-1 top-1"><?= strtoupper(__("Your position: ")) ?> <span id="positionHolder">5</span></h2>

				<ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5 text-center">
					<li><h4><?= strtoupper(__("Position")) ?></h4></li>
					<li><h4><?= strtoupper(__("Agent ID")) ?></h4></li>
					<li><h4><?= strtoupper(__("Agent name")) ?></h4></li>
					<li><h4><?= strtoupper(__("Level")) ?></h4></li>
					<li><h4><?= strtoupper(__("XP")) ?></h4></li>
				</ul>
				<?php 
					$pos = 1;
					foreach ($points_users as $p => $user_point):
						// foreach ($point as $usr):
							$usr = $user_point['User'];
							$usr_points = $user_point[0]['total_points'];

							if($usr['id'] == $user['id'])
								$position[0] = $pos;
							?>
							<ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5 text-center">
								<li><p><?= $pos ?></p></li>

								<li>
									<?php $pic = $this->UserPicture->getPictureAbsolutePath($usr); ?>
									<div class="centering-block">
										<img src="<?=$pic?>" class="img-circular square-40px img-glow-on-hover-small" alt="<?= __('User profile picture') ?>" />
									</div>
		  						</li>
		  						<li><p><?= $usr['name'] ?></p></li>
	  							<li><p><?= $usr['level']?></p></li>
	  							<li><p><?= $p ?></p></li>
	  							<span class = "evoke leaderboard-border"></span>
								</ul>
						<?php 
							$pos++;
						// endforeach;
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