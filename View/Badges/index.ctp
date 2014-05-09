<?php

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
								<img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'>

							<?php else: ?>
								<img src = '<?= $this->webroot.'img/badge.png' ?>'><!-- class="dial">-->
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
					<!-- <input type="text" class="dial"> -->
				  	<!-- <img src = '<?= $this->webroot.'img/badge.png' ?>'> -->
				  	<!-- 
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc.</p>
			  	  </li>
			  	-->
				</ul>
			</div>

		</div>

		<div class="medium-1 end columns"></div>

	</div>

</section>

<?php
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('jquery.knob');
?>

<script>
 $(".dial").val(90);
$(".dial").trigger('change');

$(".dial").knob({
                // 'min':0,
                'max':100,
                'readOnly':true,
                'fgColor':'#c65862',
                'lineCap' : 'round',
                'thickness' : 0.1,
                'dynamicDraw': true,
                'skin': 'tron',
                'displayInput': false
                });
</script>