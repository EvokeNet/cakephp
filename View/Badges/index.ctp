<?php
	/* CSS */
	echo $this->Html->css('badge_round');

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
	<div class="small-12 columns margin top-2 bottom-5">
		<!-- BADGE LIST -->
		<div class="row text-center badge">
			<?php 
			foreach($badges as $b => $badge):
				$badge_id = $badge['Badge']['id'];
			?>
				<div id="<?= $badge_id ?>" class="centered-block margin right-5  view closed" data-progress="<?= $badge['Badge']['UserPercentage'] ?>">
					<!-- BADGE IMAGE -->
					<div class="badge-image loader">	
						<?php
							$image_url = $this->webroot.'img/badge.png';
							if(isset($badge['Badge']['img_dir'])) {
								$image_url = $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'];
							}
						?>
						<div class="img-circular img-glow-on-hover background-cover background-center full-height full-width" data-interchange="['<?= $image_url ?>',(default)]">
							<noscript>
								<img src="<?= $image_url ?>" alt="<?= 'Badge '.$badge['Badge']['name'].' icon' ?>" />
							</noscript>
						

							<!-- PROGRESS CIRCLE -->
							<div class="loader-bg"></div>
							
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
					
					<!-- BADGE TITLE -->
					<p class="font-highlight badge-title <?= ($badge['Badge']['owns'] == 1) ? 'text-color-highlight' : '' ?>">
						<?= $badge['Badge']['name'] ?>
					</p>
				</div>
			<?php
			endforeach;
			?>
		</div>
		
		<!-- BADGE CONTENT -->
		<div class="row text-center">
				<?php 
				foreach($badges as $b => $badge):
					$badge_id = $badge['Badge']['id'];
				?>
					<div id="badge-content-<?= $badge_id ?>" class="hide margin top-5 right-5">
						<!-- BADGE TITLE -->
						<h3 class="<?= ($badge['Badge']['owns'] == 1) ? 'text-color-highlight' : '' ?>">
							<?= $badge['Badge']['name'] ?>
						</h3>
					
						<!-- BADGE DESCRIPTION -->
						<div id="badge-description-<?= $badge_id ?>" class="badge-description">
							<p><?= $badge['Badge']['description']?></p>
						</div>


						<!-- BADGE SKILLS -->
						<div id="badge-skills-<?= $badge_id ?>" class="badge-skills text-center">
							<ul class="small-block-grid-2 medium-block-grid-4 large-block-grid-4">
								<li class="closed" data-badge-id="<?= $badge_id ?>">
									<i class="fa fa-bolt fa-3x text-color-highlight text-glow-on-hover"></i>
									<h5 class="text-color-highlight text-glow-on-hover"><?= __('Commandes the World of Ideas') ?></h5>

									<ul class="badge-achievements hide">
										<li>
											<p><?= __('Takes on unfamiliar problems') ?></p>
										</li>
										<li>
											<p><?= __('Articulates a hypothesis about a system') ?></p>
										</li>
										<li>
											<p><?= __('Illuminates the interconnectedness of ideas') ?></p>
										</li>
									</ul>
								</li>
								<li class="closed">
									<i class="fa fa-dot-circle-o fa-3x text-color-highlight text-glow-on-hover"></i>
									<h5 class="text-color-highlight text-glow-on-hover"><?= __('Never gives up') ?></h5>

									<ul class="badge-achievements hide">
										<li>
											<p><?= __('Displays critical reflection') ?></p>
										</li>
										<li>
											<p><?= __('Is not afraid to consistently question to seek answers') ?></p>
										</li>
										<li>
											<p><?= __('Shares reasoning with others through visualizations') ?></p>
										</li>
									</ul>
								</li>
								<li class="closed">
									<i class="fa fa-eye fa-3x text-color-highlight text-glow-on-hover"></i>
									<h5 class="text-color-highlight text-glow-on-hover"><?= __('Displays clarity of vision') ?></h5>

									<ul class="badge-achievements hide">
										<li>
											<p><?= __('Researches many sources of information') ?></p>
										</li>
										<li>
											<p><?= __('Connects disparate disciplines') ?></p>
										</li>
										<li>
											<p><?= __('Understands through self reflection') ?></p>
										</li>
									</ul>
								</li>
								<li class="closed">
									<i class="fa fa-fire fa-3x text-color-highlight text-glow-on-hover"></i>
									<h5 class="text-color-highlight text-glow-on-hover"><?= __('Ventures into the unknown') ?></h5>

									<ul class="badge-achievements hide">
										<li>
											<p><?= __('Collaborates with others') ?></p>
										</li>
										<li>
											<p><?= __('Engages with other agents') ?></p>
										</li>
										<li>
											<p><?= __('Shares resources freely') ?></p>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				<?php endforeach;?>
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