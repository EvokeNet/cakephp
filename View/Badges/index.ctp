<?php
	/* CSS */
	echo $this->Html->css('badge_round');
	echo $this->Html->css('mission_hover');

	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Badges', 'imgSrc' => ($this->webroot.'img/header-leaderboard-3.jpg')));
	$this->end();
?>
<div class="row standard-width">
	<div class="small-10 medium-10 large-10 columns margin top-2">
		<div class="text-center black-bg badges-bg">
			<ul class="small-block-grid-2 medium-block-grid-4 large-block-grid-4">
				<?php 

				foreach($badges as $b => $badge): ?>
					<li>
						<div id="<?= $badge['Badge']['id'] ?>" class="badge view view-first" data-progress="<?= $badge['Badge']['UserPercentage'] ?>">
							<div class="loader">
								<div class="loader-bg img-circular">
									<!-- BADGE IMAGE -->
									<?php
										$image_url = $this->webroot.'img/badge.png';
										if(isset($badge['Badge']['img_dir'])) {
											$image_url = $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'];
										}
									?>
									
									<img src='<?= $image_url ?>' alt="<?= 'Badge '.$badge['Badge']['name'].' icon' ?>" />
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
							<div class="badges mask">
								<p class="btext"></p>
							</div>
						</div>

						<!-- BADGE TITLE -->
						<h3 class="<?= ($badge['Badge']['owns'] == 1) ? 'text-color-highlight' : '' ?>">
							<?= $badge['Badge']['name'] ?>
						</h3>

						<p><?= $badge['Badge']['description']?></p>
					</li>
				<?php endforeach;?>
			</ul>
		</div>

	</div>
</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Badges/index.js', array('inline' => false));
?>