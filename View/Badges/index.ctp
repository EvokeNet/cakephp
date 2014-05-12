<?php
	
	echo $this->Html->css('badge_round');
	echo $this->Html->css('mission_hover');

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
		  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	

		<div class="small-9 medium-9 large-9 columns maincolumn">
			
			<h3> <?= strtoupper(__('Badges')) ?> </h3>

			<div class = "evoke black-bg badges-bg">
				<ul class="small-block-grid-4 medium-block-grid-4 large-block-grid-4">
				  	<?php 

					foreach($badges as $b => $badge): ?>
						<li>
							<?php //$badges[$b]['Badge']['UserPercentage'] = 0.3;?>
							<?php if(isset($badge['Badge']['img_dir'])) : ?>

								<?php if($badge['Badge']['power_points_only'] == 1) : ?>
									<div id="<?=$badge['Badge']['id']?>" class="evoke default badges view view-first">
					                    
					                    <div class = "margin-left-13">
					                    <div class="loader">
										    <div class="loader-bg">
										    	<img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'>
										    </div>    

										    <div class="spiner-holder-one animate-0-25-a">
										        <?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-0-25-b">
											            <div class="loader-spiner" style=""></div>
											        </div>
										    	<?php endif?>
										    </div>
										    <div class="spiner-holder-one animate-25-50-a">
										        <?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-25-50-b">
										            	<div class="loader-spiner"></div>
										        	</div>
										    	<?php endif?>
										    </div>
										    <div class="spiner-holder-one animate-50-75-a">
										    	<?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-50-75-b">
											            <div class="loader-spiner"></div>
											        </div>
										    	<?php endif?>										        
										    </div>
										    <div class="spiner-holder-one animate-75-100-a">
										        <?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-75-100-b">
											            <div class="loader-spiner"></div>
											        </div>
										    	<?php endif?>
										    </div>
										</div>
					                    </div>
					                    <div class="evoke badges mask">
					                        <p class="btext"></p>
					                    </div>
					                </div> 
					            <?php else :?>
					            	<img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'>
					        	<?php endif;?>

							<?php else: ?>
								<?php if($badge['Badge']['power_points_only'] == 1) : ?>
									<div id="<?=$badge['Badge']['id']?>" class="evoke default badges view view-first">
					                    
					                    <div class = "margin-left-13">
					                    <div class="loader">
										    <div class="loader-bg">
										    	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
										    </div>    

										    <div class="spiner-holder-one animate-0-25-a">
										        <?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-0-25-b">
											            <div class="loader-spiner" style=""></div>
											        </div>
										    	<?php endif?>
										    </div>
										    <div class="spiner-holder-one animate-25-50-a">
										        <?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-25-50-b">
										            	<div class="loader-spiner"></div>
										        	</div>
										    	<?php endif?>
										    </div>
										    <div class="spiner-holder-one animate-50-75-a">
										        <?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-50-75-b">
											            <div class="loader-spiner"></div>
											        </div>
										    	<?php endif?>
										    </div>
										    <div class="spiner-holder-one animate-75-100-a">
										    	<?php if($badge['Badge']['UserPercentage'] != 0):?>
											        <div class="spiner-holder-two animate-75-100-b">
											            <div class="loader-spiner"></div>
											        </div>
										    	<?php endif?>
										    </div>
										</div>
					                    </div>
					                    <div class="evoke badges mask">
					                        <p class="btext"></p>
					                    </div>
					                </div> 
								<?php else :?>
					            	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
					        	<?php endif;?>
							<?php endif;
								// echo '<input type="text" class="dial" value="'.$badge['Badge']['UserPercentage'].'">';
								$owned = ' (owned)';
								if($badge['Badge']['owns'] != 1)
									$owned = '';
							?>
							<h1><?= $badge['Badge']['name'] ?></h1>
				  			
							
				  			<?php foreach ($badge['Badge']['PowerPoints'] as $bpp) : ?>
				  				<?php $current = ($bpp['UserPercentage']/100) * $bpp['UserGoal']; ?>
								<div>
				  				
				  				<span style="color:#fff"><?=$bpp['name']?></span>
				  				<span data-tooltip data-options="disable_for_touch:true" class="has-tip tip-top radius" title="<?=$current.'/'.$bpp['UserGoal'] ?>">
				  				<div class="evoke top-bar-2 progress success round">
									<span class="meter" style="width: <?= $bpp['UserPercentage'] ?>%"></span>
								</div>
								</span>
								<br>
								</div>

							<?php endforeach;?>

							<p><?= $badge['Badge']['description']?></p>
						</li>
					<?php endforeach;?>
				</ul>
			</div>

		</div>

		<div class="medium-1 end columns"></div>

	</div>

</section>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('image_hover', array('inline' => false));
?>

<script>

	<?php 
		foreach ($badges as $badge) {
			// debug($badge['Badge'])
			if(isset($badge['Badge']['UserPercentage']))
				echo 'renderProgress('.($badge['Badge']['UserPercentage']).', $("#'. $badge['Badge']['id'] .'"));';
		}
	?>

function renderProgress(progress, el)
{
    // progress = progress;
    // alert(el.attr('id'));
    if(progress==0) {
    	$("#"+el.attr('id')+" .animate-50-75-b, .animate-25-50-b, .animate-0-25-b")
                                              .css("transform","rotate(90deg)");
        $("#"+el.attr('id')+" .animate-75-100-b").css("transform","rotate(90deg)");
    	$("#"+el.attr('id')+" .btext").html("0%");
    	return;
    }
	if(progress % 1 != 0) {
		progress = progress.toFixed(2);
	}
    if(progress<25){
        var angle = -90 + (progress/100)*360;
        $("#"+el.attr('id')+" .animate-0-25-b").css("transform","rotate("+angle+"deg)");

    }
    else if(progress>=25 && progress<50){
        var angle = -90 + ((progress-25)/100)*360;
        $("#"+el.attr('id')+" .animate-0-25-b").css("transform","rotate(0deg)");
        $("#"+el.attr('id')+" .animate-25-50-b").css("transform","rotate("+angle+"deg)");
    }
    else if(progress>=50 && progress<75){
        var angle = -90 + ((progress-50)/100)*360;
        $("#"+el.attr('id')+" .animate-25-50-b, .animate-0-25-b").css("transform","rotate(0deg)");
        $("#"+el.attr('id')+" .animate-50-75-b").css("transform","rotate("+angle+"deg)");
    }
    else if(progress>=75 && progress<=100){
        var angle = -90 + ((progress-75)/100)*360;
        $("#"+el.attr('id')+" .animate-50-75-b, .animate-25-50-b, .animate-0-25-b")
                                              .css("transform","rotate(0deg)");
        $("#"+el.attr('id')+" .animate-75-100-b").css("transform","rotate("+angle+"deg)");
    }
    
    $("#"+el.attr('id')+" .btext").html(progress+"%");
    
}
</script>