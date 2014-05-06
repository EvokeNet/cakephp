<div class = "evoke mission status-bg">
 	<div class="row full-width-alternate">
	  <div class="small-1 medium-1 large-1 columns" style = "display: inline;">
	  	<?php 
	  		$complete = 0;
	  		$mission_completed = 0;
			$_completed = 0;
			$_total = 0;
			$valid_phases = 0;
			foreach ($missionPhases as $phase) {
				if(!isset($total[$phase['Phase']['id']]))
					continue;
				$valid_phases++;
				$_completed += $completed[$phase['Phase']['id']];
				$_total += $total[$phase['Phase']['id']];
			}
			//echo (($_completed * 100)/$_total) . '%';
		?>

		<!-- <h1><?= strtoupper(__('Mission Status')) ?></h1>&nbsp;&nbsp;
		<span><?php 
			if($_total){
				$mission_completed = round(($_completed * 100)/$_total); 
				//echo $mission_completed.'%';
			}
		?></span> -->
	  </div>
	  <div class="small-11 medium-11 large-11 columns">
	  	<div class="row full-width-alternate">
		  <div class="small-11 medium-11 large-11 columns padding">
		  	<div>
		  		<?php	
			  		if($valid_phases)
						$qtd = 100/$valid_phases;//sizeof($missionPhases);
					foreach ($missionPhases as $phase):
						if((!isset($total[$phase['Phase']['id']]))) continue;
						if(($total[$phase['Phase']['id']] == 0)) continue;
						?>
						<div style="width:<?= $qtd?>%; float:left">
							<?php 
								$phaseDone = "alert";
								if((($completed[$phase['Phase']['id']] * 100)/$total[$phase['Phase']['id']]) == 100)
									$phaseDone = "success";
								if(((($completed[$phase['Phase']['id']] * 100)/$total[$phase['Phase']['id']]) > 0) && ((($completed[$phase['Phase']['id']] * 100)/$total[$phase['Phase']['id']]) < 100))
									$phaseDone = "dev";

							?>
							<a href = "<?php echo $this->Html->url(array('controller'=>'missions', 'action' => 'view', $phase['Mission']['id'], $phase['Phase']['position'])); ?>"><h2 class = "evoke mission status <?=$phaseDone ?>"><?= strtoupper($phase['Phase']['name'])?><i class="fa fa-angle-right fa-lg" style = "margin-left: 40%;"></i></h2></a>
							<!-- <div class = "evoke mission circle-position"><div class="evoke mission circle <?=$phaseDone ?>"></div></div> -->
							<!-- <div class = "evoke mission bar-position">
								<div class="evoke mission status progress <?=$phaseDone ?>" style="">
									<span class="evoke mission status <?=$phaseDone ?> meter" style="width: <?php echo (($completed[$phase['Phase']['id']] * 100)/$total[$phase['Phase']['id']]) ?>%"></span>
								</div>
							</div> -->
						</div>
				<?php endforeach; ?>
			</div>
		  </div>
		  <div class="small-1 medium-1 large-1 columns padding">
		  	<div class = "evoke position">
		  		<?php if($mission_completed == 100)
					 	$complete = 'success';?>
				<h2 class = "evoke mission status <?= $complete ?> text-align-end" ><?= strtoupper('Finish') ?></h2>

				<!-- <div class = "evoke mission bar-position">
					<div class="evoke mission status progress success" style="">
						<span class="evoke mission status success meter" style="100%"></span>
					</div>
				</div> -->

				<!-- <div class="evoke mission circle <?= $complete ?>"><i class="fa fa-flag-checkered fa-lg"></i></div>  -->
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>