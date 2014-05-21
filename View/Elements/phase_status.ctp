<div class = "evoke mission status-bg">
 	<div class="row full-width-alternate">
	  <div class="small-1 medium-1 large-1 columns" style = "display: inline;"></div>
	  <div class="small-11 medium-11 large-11 columns">
	  	<div class="row full-width-alternate">
		  <div class="small-11 medium-11 large-11 columns">
		  	<div>
	  		<?php 

	  			$phases = count($missionPhases);

	  			$qtd = 90;

	  			if(!empty($phases))
	  				$qtd = 100/$phases;
	  			
	  			if($qtd == 100)
	  				$qtd = 40;


	  			foreach ($missionPhases as $phase): 
	  				$temp = explode(' ', $phase['Phase']['name']);
					$phase['Phase']['name'] = $temp[0]; ?>

					<div style="width:<?= $qtd ?>%; float:left">
						<?php 
							$phaseDone = 'alert';
							
							if(($status['check'.$phase['Phase']['name']] > 0) && ($status['check'.$phase['Phase']['name']] < $status['checklists'.$phase['Phase']['name']]))
								$phaseDone = "dev";

							if($status['check'.$phase['Phase']['name']] == $status['checklists'.$phase['Phase']['name']])
								$phaseDone = "success";

						?>
						<a href = "<?php echo $this->Html->url(array('controller'=>'missions', 'action' => 'view', $phase['Mission']['id'], $phase['Phase']['position'])); ?>"><h2 class = "evoke mission status <?=$phaseDone ?>"><?= strtoupper($phase['Phase']['name'])?>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right fa-lg" style = "margin-left:<?= $qtd ?>%"></i></h2></a>

					</div>

			<?php endforeach; ?>
			</div>
		  </div>
		  <div class="small-1 medium-1 large-1 columns padding">
		  	<div class = "evoke position">
		  		<?php $complete = "alert"; ?> <!-- Needs to check if evokation was approved -->
				<h2 class = "evoke mission status <?= $complete ?>" ><?= strtoupper('Finish') ?></h2>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>