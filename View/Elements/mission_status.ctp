<div class = "evoke mission status-bg">
 	<div class="row full-width">
	  <div class="medium-3 columns" style = "display: inline;">
	  	<?php 
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

		<h1><?= strtoupper(__('Mission Status')) ?></h1>&nbsp;&nbsp;
		<span><?php echo round(($_completed * 100)/$_total).'%'; ?></span>
	  </div>
	  <div class="medium-9 columns" style="/*float:right; display: inline-block;*/">
	  	<?php	
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
					<h2 class = "evoke mission status <?=$phaseDone ?>"><?= strtoupper($phase['Phase']['name'])?></h2>
					<div class = "evoke mission circle-position"><div class="evoke mission circle <?=$phaseDone ?>"></div></div>
					<div class = "evoke mission bar-position">
						<div class="evoke mission status progress <?=$phaseDone ?>" style="">
							<span class="evoke mission status <?=$phaseDone ?> meter" style="width: <?php echo (($completed[$phase['Phase']['id']] * 100)/$total[$phase['Phase']['id']]) ?>%"></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<div class = "evoke mission circle-position"><div class="evoke mission circle"></div></div>
	  </div>
	</div>
</div>