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
				<div id="<?= $badge_id ?>" class="centered-block margin right-5 view closed" data-progress="<?= $badge['Badge']['UserPercentage'] ?>">
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
					<p class="font-highlight badge-title text-color-highlight">
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
					<div id="badge-content-<?= $badge_id ?>" class="hide margin top-2 right-5">
						<!-- BADGE IMAGE -->
						<?php
							$image_url = $this->webroot.'img/badge.png';
							if(isset($badge['Badge']['img_dir'])) {
								$image_url = $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'];
							}
						?>
						<div class="img-circular background-cover background-center badge-main-image" data-interchange="['<?= $image_url ?>',(default)]">
							<noscript>
								<img src="<?= $image_url ?>" alt="<?= 'Badge '.$badge['Badge']['name'].' icon' ?>" />
							</noscript>
						</div>

						<!-- BADGE TITLE -->
						<h3 class="text-color-highlight">
							<?= $badge['Badge']['name'] ?>
						</h3>
					
						<!-- BADGE DESCRIPTION -->
						<div id="badge-description-<?= $badge_id ?>" class="badge-description">
							<p><?= $badge['Badge']['description']?></p>
						</div>

						<!-- BADGE SKILLS (tabs) -->
						<div id="badge-skills-<?= $badge_id ?>" class="row standard-width margins-auto full-height centering-block table text-center">
							<!-- SKILLS (TAB LINKS) -->
							<div class="evoke small-block-grid-5 tabs-style-linetriangle centered-block show-for-large-up">
								<ul id="tabs-skills" class="tabs show-for-large-up" data-tab role="tablist" data-options="deep_linking:true">
									<li class="tab-title text-glow-on-hover active text-glow" role="presentational">
										<a href="#panelBadge<?= $badge_id ?>Skill1" role="tab" aria-selected="true" controls="panelBadge<?= $badge_id ?>Skill1">
											<i class="fa fa-bolt fa-4x text-color-highlight"></i>
											<h6 class="text-color-highlight text-glow-on-hover"><?= __('Commandes the World of Ideas') ?></h6>
										</a>
									</li>
									<li class="tab-title text-glow-on-hover" role="presentational">
										<a href="#panelBadge<?= $badge_id ?>Skill2" role="tab" aria-selected="false" controls="panelBadge<?= $badge_id ?>Skill2">
											<i class="fa fa-dot-circle-o fa-4x text-color-highlight"></i>
											<h5 class="text-color-highlight text-glow-on-hover"><?= __('Never gives up') ?></h5>
										</a>
									</li>
									<li class="tab-title text-glow-on-hover" role="presentational">
										<a href="#panelBadge<?= $badge_id ?>Skill3" role="tab" aria-selected="true" controls="panelBadge<?= $badge_id ?>Skill3">
											<i class="fa fa-eye fa-4x text-color-highlight"></i>
											<h5 class="text-color-highlight text-glow-on-hover"><?= __('Displays clarity of vision') ?></h5>
										</a>
									</li>
									<li class="tab-title text-glow-on-hover" role="presentational">
										<a href="#panelBadge<?= $badge_id ?>Skill4" role="tab" aria-selected="false" controls="panelBadge<?= $badge_id ?>Skill4">
											<i class="fa fa-fire fa-4x text-color-highlight"></i>
											<h5 class="text-color-highlight text-glow-on-hover"><?= __('Ventures into the unknown') ?></h5>
										</a>
									</li>
								</ul>
							</div>

							<!-- ACHIEVEMENTS (TAB CONTENT) -->
							<div class="tabs-content">
								<dl class="accordion" data-accordion>
									<dd class="accordion-navigation">
										<!-- Accordion link for small and medium screens -->
										<a href="#panelBadge<?= $badge_id ?>Skill1" class="text-left hide-for-large-up">
											<i class="fa fa-bolt fa-2x text-color-highlight padding right-1"></i>
											<?= __('Commandes the World of Ideas') ?>
										</a>

										<!-- SKILL -->
										<section role="tabpanel" aria-hidden="false" class="content radius active" id="panelBadge<?= $badge_id ?>Skill1">
											<h6 class="margin top-2 bottom-2"><?= __('Necessary achievements:') ?></h6>
											<ul class="badge-achievements inline-block text-left">
												<li>
													<p class="font-size-important"><?= __('Takes on unfamiliar problems') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Articulates a hypothesis about a system') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Illuminates the interconnectedness of ideas') ?></p>
												</li>
											</ul>
										</section>

										<!-- Accordion link for small and medium screens -->
										<a href="#panelBadge<?= $badge_id ?>Skill2" class="text-left hide-for-large-up">
											<i class="fa fa-dot-circle-o fa-2x text-color-highlight padding right-1"></i>
											<?= __('Never gives up') ?>
										</a>

										<!-- SKILL -->
										<section role="tabpanel" aria-hidden="true" class="content radius" id="panelBadge<?= $badge_id ?>Skill2">
											<h6 class="margin top-2 bottom-2"><?= __('Necessary achievements:') ?></h6>
											<ul class="badge-achievements inline-block text-left">
												<li>
													<p class="font-size-important"><?= __('Displays critical reflection') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Is not afraid to consistently question to seek answers') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Shares reasoning with others through visualizations') ?></p>
												</li>
											</ul>
										</section>


										<!-- Accordion link for small and medium screens -->
										<a href="#panelBadge<?= $badge_id ?>Skill3" class="text-left hide-for-large-up">
											<i class="fa fa-eye fa-2x text-color-highlight padding right-1"></i>
											<?= __('Displays clarity of vision') ?>
										</a>

										<!-- SKILL -->
										<section role="tabpanel" aria-hidden="true" class="content radius" id="panelBadge<?= $badge_id ?>Skill3">
											<h6 class="margin top-2 bottom-2"><?= __('Necessary achievements:') ?></h6>
											<ul class="badge-achievements inline-block text-left">
												<li>
													<p class="font-size-important"><?= __('Researches many sources of information') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Connects disparate disciplines') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Understands through self reflection') ?></p>
												</li>
											</ul>
										</section>

										<!-- Accordion link for small and medium screens -->
										<a href="#panelBadge<?= $badge_id ?>Skill4" class="text-left hide-for-large-up">
											<i class="fa fa-fire fa-2x text-color-highlight padding right-1"></i>
											<?= __('Ventures into the unknown') ?>
										</a>

										<!-- SKILL -->
										<section role="tabpanel" aria-hidden="true" class="content radius" id="panelBadge<?= $badge_id ?>Skill4">
											<h6 class="margin top-2 bottom-2"><?= __('Necessary achievements:') ?></h6>
											<ul class="badge-achievements inline-block text-left">
												<li>
													<p class="font-size-important"><?= __('Collaborates with others') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Engages with other agents') ?></p>
												</li>
												<li>
													<p class="font-size-important"><?= __('Shares resources freely') ?></p>
												</li>
											</ul>
										</section>
									</dd>
								</dl>
							</div>
						</div>


						<!-- <div id="badge-skills-<?= $badge_id ?>" class="badge-skills text-center">
							<ul class="small-block-grid-2 medium-block-grid-4 large-block-grid-4">
								<li class="closed">
								</li>
							</ul>
						</div> -->
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