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

					foreach($badges as $badge): ?>
						<li>
							<?php if(isset($badge['Badge']['img_dir'])) : ?>
								<!-- <img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'> -->
						
								<!-- <img class='knob' src='<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'>  -->
								<!-- <img class="knob badges-knob" src = '<?= $this->webroot.'img/badge.png' ?>'> -->
								

								<div class="evoke default badges view view-first">
				                    
				                    <div class = "margin-left-13">
				                    <div class="loader">
									    <div class="loader-bg" id="two">
									    	<img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'>
									    </div>    

									    <div class="spiner-holder-one animate-0-25-a">
									        <div class="spiner-holder-two animate-0-25-b">
									            <div class="loader-spiner" style=""></div>
									        </div>
									    </div>
									    <div class="spiner-holder-one animate-25-50-a">
									        <div class="spiner-holder-two animate-25-50-b">
									            <div class="loader-spiner"></div>
									        </div>
									    </div>
									    <div class="spiner-holder-one animate-50-75-a">
									        <div class="spiner-holder-two animate-50-75-b">
									            <div class="loader-spiner"></div>
									        </div>
									    </div>
									    <div class="spiner-holder-one animate-75-100-a">
									        <div class="spiner-holder-two animate-75-100-b">
									            <div class="loader-spiner"></div>
									        </div>
									    </div>
									</div>
				                    </div>
				                    <div class="evoke badges mask">
				                        <!-- <h2><?= $mission['Mission']['title'] ?></h2> -->
				                        <p class="btext"></p>
				                        <!-- <div class="btext"></div>
				                        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="button general info"><?= __('Go to mission') ?></a> -->
				                    </div>
				                </div> 

							<?php else: ?>
								<!-- <img class='knob badges-knob' src = '<?= $this->webroot.'img/badge.png' ?>'> -->

								<div class="evoke default view view-first">
				                    
				                    <div class = "margin-left-13">
				                    <div class="loader">
									    <div class="loader-bg" id="two">
									    	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
									    </div>    

									    <div class="spiner-holder-one animate-0-25-a">
									        <div class="spiner-holder-two animate-0-25-b">
									            <div class="loader-spiner" style=""></div>
									        </div>
									    </div>
									    <div class="spiner-holder-one animate-25-50-a">
									        <div class="spiner-holder-two animate-25-50-b">
									            <div class="loader-spiner"></div>
									        </div>
									    </div>
									    <div class="spiner-holder-one animate-50-75-a">
									        <div class="spiner-holder-two animate-50-75-b">
									            <div class="loader-spiner"></div>
									        </div>
									    </div>
									    <div class="spiner-holder-one animate-75-100-a">
									        <div class="spiner-holder-two animate-75-100-b">
									            <div class="loader-spiner"></div>
									        </div>
									    </div>
									</div>
				                    </div>
				                    <div class="evoke mask">
				                        <!-- <h2><?= $mission['Mission']['title'] ?></h2> -->
				                        <p class="btext"></p>
				                        <!-- <div class="btext"></div>
				                        <a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="button general info"><?= __('Go to mission') ?></a> -->
				                    </div>
				                </div> 
							
							<?php endif;
								// echo '<input type="text" class="dial" value="'.$badge['Badge']['UserPercentage'].'">';
								$owned = ' (owned)';
								if($badge['Badge']['owns'] != 1)
									$owned = '';
							?>
							<h1><?= $badge['Badge']['name'] . $owned;?></h1>
				  			
							
				  			<?php foreach ($badge['Badge']['PowerPoints'] as $bpp) : ?>
				  				<?php $current = ($bpp['UserPercentage']/100) * $bpp['UserGoal']; ?>
								<div>
				  				
				  				<span style="color:#fff"><?=$bpp['name'] .':'?>&nbsp;</span>
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
//  $(".dial").val(90);
// $(".dial").trigger('change');

// $(".dial").knob({
//                 // 'min':0,
//                 'max':100,
//                 'readOnly':true,
//                 'fgColor':'#c65862',
//                 'lineCap' : 'round',
//                 'thickness' : 0.1,
//                 'dynamicDraw': true,
//                 'skin': 'tron',
//                 'displayInput': false
//                 });

 renderProgress(88);
 renderProgress(50, 'two');
 renderProgress(100, 'three');

function renderProgress(progress)
{
    progress = 50;
    if(progress<25){
        var angle = -90 + (progress/100)*360;
        $(".animate-0-25-b").css("transform","rotate("+angle+"deg)");
    }
    else if(progress>=25 && progress<50){
        var angle = -90 + ((progress-25)/100)*360;
        $(".animate-0-25-b").css("transform","rotate(0deg)");
        $(".animate-25-50-b").css("transform","rotate("+angle+"deg)");
    }
    else if(progress>=50 && progress<75){
        var angle = -90 + ((progress-50)/100)*360;
        $(".animate-25-50-b, .animate-0-25-b").css("transform","rotate(0deg)");
        $(".animate-50-75-b").css("transform","rotate("+angle+"deg)");
    }
    else if(progress>=75 && progress<=100){
        var angle = -90 + ((progress-75)/100)*360;
        $(".animate-50-75-b, .animate-25-50-b, .animate-0-25-b")
                                              .css("transform","rotate(0deg)");
        $(".animate-75-100-b").css("transform","rotate("+angle+"deg)");
    }
    $(".btext").html(progress+"%");
}
// $( document ).ready(function() {
//         $('#myStathalf').circliful();
// 		$('#myStat').circliful();
// 		$('#myStathalf2').circliful();
// 		$('#myStat2').circliful();
//     });
// $(".knob").val(90);
// $(".knob").knob({
// 				'fgColor':'#c65862',
// 				'lineCap' : 'round',
// 				'thickness' : 0.1,
// 				'width' : '75%',
// 				'height' : '75%',
//                 /*change : function (value) {
//                     //console.log("change : " + value);
//                 },
//                 release : function (value) {
//                     console.log("release : " + value);
//                 },
//                 cancel : function () {
//                     console.log("cancel : " + this.value);
//                 },*/
//                 draw : function () {

//                     // "tron" case
//                     if(this.$.data('skin') == 'tron') {

//                         var a = this.angle(this.cv)  // Angle
//                             , sa = this.startAngle          // Previous start angle
//                             , sat = this.startAngle         // Start angle
//                             , ea                            // Previous end angle
//                             , eat = sat + a                 // End angle
//                             , r = true;

//                         this.g.lineWidth = this.lineWidth;

//                         this.o.cursor
//                             && (sat = eat - 0.3)
//                             && (eat = eat + 0.3);

//                         if (this.o.displayPrevious) {
//                             ea = this.startAngle + this.angle(this.value);
//                             this.o.cursor
//                                 && (sa = ea - 0.3)
//                                 && (ea = ea + 0.3);
//                             this.g.beginPath();
//                             this.g.strokeStyle = this.previousColor;
//                             this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
//                             this.g.stroke();
//                         }

//                         this.g.beginPath();
//                         this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
//                         this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
//                         this.g.stroke();

//                         this.g.lineWidth = 2;
//                         this.g.beginPath();
//                         this.g.strokeStyle = this.o.fgColor;
//                         this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
//                         this.g.stroke();

//                         return false;
//                     }
//                 }
//             });
</script>