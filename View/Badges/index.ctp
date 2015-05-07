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
					$skills_and_achievements = array(
						'0' => array( //Badge Creative Visionary
							'Commandes the World of Ideas' => array(
								'achievements' => array(
									'Generates lots of new ideas',
									'Simplifies complex ideas',
									'Synthesizes ideas'
								)
							),
							'Is Open and Flexible' => array(
								'achievements' => array(
									'Embraces new ideas from different cultures and perspectives',
									'Engages with increasingly complex ideas',
									'Sees issues of social injustice as problems to be solved'
								)
							),
							'Applies the imagination.  Is original' => array(
								'achievements' => array(
									'Presents unique view of the world',
									'Frames issues in new ways',
									'Presents ideas in a diversity of ways'
								)
							),
							'Displays clarity of vision' => array(
								'achievements' => array(
									'Develops ideas with clear evidence',
									'Inspires deeper thinking',
									'Moves a concept to reality'
								)
							)
						),
						'1' => array( //Deep Collaborator
							'Understands an issue and communicates it clearly' => array(
								'achievements' => array(
									'Seeks Understanding',
									'Engages other agents',
									'Presents ideas in a compelling way'
								)
							),
							'Participates in Diverse Teams' => array(
								'achievements' => array(
									'Collaborates with distant agents',
									'Works on teams with diversity of views',
									'Gets things done by working with others'
								)
							),
							'Engages actively in networks' => array(
								'achievements' => array(
									'Constructively assesses other agents',
									'Comments on other agents evidence',
									'Provides respectful feedback to other agents'
								)
							),
							'Never gives up' => array(
								'achievements' => array(
									'Shows relentless engagement',
									'Reflects on what it means to be gritty',
									'Creates world changing ideas'
								)
							)
						),
						'2' => array( //Systems Thinker
							'Solves problems' => array(
								'achievements' => array(
									'Takes on unfamiliar problems',
									'Poses important questions',
									'Clearly specifies the problem'
								)
							),
							'Reveals systems' => array(
								'achievements' => array(
									'Articulates a hypothesis about a system',
									'Illuminates the interconnectedness of ideas',
									'Models a system'
								)
							),
							'Intensly curious' => array(
								'achievements' => array(
									'Displays critical reflection',
									'Is not afraid to consistently question to seek answers',
									'Shares reasoning with others through visualizations'
								)
							),
							'Connects to multiple sources of information and knowledge' => array(
								'achievements' => array(
									'Researches many sources of information',
									'Connects disparate disciplines',
									'Understands through self reflection'
								)
							)
						),
						'3' => array( //Social Activist
							'Ventures into the unknown' => array(
								'achievements' => array(
									'Takes on unfamiliar problems',
									'Poses intriguing questions',
									'Seeks answers from the network'
								)
							),
							'Displays a generosity of spirit' => array(
								'achievements' => array(
									'Engages with other agents',
									'Shares resources freely',
									'Collaborates with others'
								)
							),
							'Inspires' => array(
								'achievements' => array(
									'Motivates others to take action',
									'Tells compelling stories',
									'Starts movements'
								)
							),
							'Displays passion and empathy' => array(
								'achievements' => array(
									'Understands how others feel',
									'Is passionate about making a difference',
									'Displays a sense of belonging'
								)
							)
						)
					);
				$badge_count = -1;
				foreach($badges as $b => $badge):
					$badge_count++;

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
						<div id="badge-skills-<?= $badge_id ?>" class="row badge-skills standard-width margins-auto full-height centering-block table text-center">
							<!-- SKILLS (TAB LINKS) -->
							<div class="evoke small-block-grid-5 tabs-style-linetriangle full-width margins-0 centered-block show-for-large-up">
								<ul id="tabs-skills" class="tabs full-width show-for-large-up" data-tab role="tablist">
									<?php
										$badge_skills_and_achievements = $skills_and_achievements[$badge_count];
										$skill_count = 0;
										foreach ($badge_skills_and_achievements as $skill_name => $skill_content):
											$skill_count++;
									?>
										<li class="tab-title text-glow-on-hover <?= ($skill_count == 0) ? 'active' : ''?> text-glow" role="presentational">
											<a href="#panelBadge<?= $badge_id ?>Skill<?= $skill_count ?>" role="tab" aria-selected="true" controls="panelBadge<?= $badge_id ?>Skill<?= $skill_count ?>">
												<i class="fa fa-bolt fa-4x text-color-highlight"></i>
												<h6 class="text-color-highlight text-glow-on-hover"><?= $skill_name ?></h6>
											</a>
										</li>
									<?php
										endforeach;
									?>
								</ul>
							</div>

							<!-- ACHIEVEMENTS (TAB CONTENT) -->
							<div class="tabs-content">
								<dl class="accordion" data-accordion>
									<dd class="accordion-navigation">
										<?php
											$badge_skills_and_achievements = $skills_and_achievements[$badge_count];
											$skill_count = 0;
											foreach ($badge_skills_and_achievements as $skill_name => $skill_content):
												$skill_count++;
													?>
													<!-- Accordion link for small and medium screens -->
													<a href="#panelBadge<?= $badge_id ?>Skill<?= $skill_count ?>" class="text-left hide-for-large-up">
														<i class="fa fa-bolt fa-2x text-color-highlight padding right-1"></i>
														<?= $skill_name ?>
													</a>

													<!-- SKILL -->
													<section role="tabpanel" aria-hidden="false" class="content radius <?= ($skill_count == 0) ? 'active' : ''?>" id="panelBadge<?= $badge_id ?>Skill<?= $skill_count ?>">
														<h6 class="margin top-2 bottom-2"><?= __('Necessary achievements:') ?></h6>
														<ul class="badge-achievements inline-block text-left">
															<?php
																foreach ($skill_content['achievements'] as $achievement):
															?>
																<li>
																	<p class="font-size-important"><?= $achievement ?></p>
																</li>
															<?php
																endforeach;
															?>
														</ul>
													</section>
										<?php
											endforeach;
										?>

										
									</dd>
								</dl>
							</div>
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