<?php
	//Plugin CSS
	echo $this->Html->css(
		array(
			'/components/slick-carousel/slick/slick.css',
			'slick.css'
		)
	);
?>

<!-- TOPBAR MENU -->
<?php $this->start('topbar'); ?>
<div id="missions-menu" class="sticky fixed">
	<?php echo $this->element('topbar', array('sticky' => '', 'fixed' => '')); ?>
</div>
<?php $this->end(); ?>
<!-- TOPBAR MENU -->


	<div id="missions-body" class="missions full-height clearfix">
		<!-- MENU ICONS (BUTTONS TO OPEN MISSION-TAB-CONTENT) -->
		<nav class="tab-bar" id="tab-bar-off-canvas">
			<div class="close-sidebar-button fixed left-small text-center hidden">
				<a class="close-sidebar">
					<div class="row">
						<i class="fa fa-angle-double-left fa-2x"></i>
					</div>
					<div class="row menu-icon-label">
						<span><?= __('Back') ?></span>
					</div>
				</a>
			</div>

			<section class="left-small" id="menu-left-small">
				<div class="left-small-content text-center background-color-standard opacity-07 padding bottom-1">
					<!-- QUESTS -->
					<a class="menu-icon default" id="menu-icon-tabQuests" data-tab-content="tabQuests">
						<div class="row">
							<span class="icon-brankic icon-compass fa-2x vertical-align-middle text-color-gray"></span>
						</div>
						<div class="row menu-icon-label">
							<span><?= __('Quests') ?></span>
						</div>
					</a>

					<!-- DOSSIER -->
					<a class="menu-icon default" id="menu-icon-tabDossier" data-tab-content="tabDossier">
						<div class="row">
							<span class="icon-brankic icon-cabinet2 fa-2x vertical-align-middle text-color-gray"></span>
						</div>
						<div class="row menu-icon-label">
							<span><?= __('Dossier') ?></span>
						</div>
					</a>
					
					<!-- EVIDENCES -->
					<a class="menu-icon default" id="menu-icon-tabEvidences" data-tab-content="tabEvidences">
						<div class="row">
							<span class="icon-brankic icon-wallet fa-2x vertical-align-middle text-color-gray"></span>
						</div>
						<div class="row menu-icon-label">
							<span><?= __('Evidences') ?></span>
						</div>
					</a>
					

					<!-- FORUM -->
					<?php
					if (isset($forum) && isset($forum['Forum'])): ?>
					
					<a class="menu-icon forum" id="menu-icon-tabForum" data-forum-url="<?php echo rawurldecode($this->Html->url(array('plugin' => 'optimum', 'controller' => 'forum', 'action' => 'view', "#/".$forum['Forum']['id']))); ?>" data-tab-content="tabForum" data-forum-id="<?= $forum['Forum']['id'] ?>">
						<div class="row">
							<span class="fa fa-lightbulb-o fa-2x vertical-align-middle text-color-gray"></span>
						</div>
						<div class="row menu-icon-label">
							<span><?= __('Discuss') ?></span>
						</div>
					</a>
					<?php
					endif;
					?>

					<!-- MENU -->
					<a class="menu-icon default" id="menu-icon-tabMenu" data-tab-content="tabMenu">
						<div class="row">
							<span class="icon-brankic icon-grid icon-size-medium vertical-align-middle text-color-gray"></span>
						</div>
						<div class="row menu-icon-label">
							<span><?= __('Menu') ?></span>
						</div>
					</a>
				</div>
			</section>
		</nav>

		<!-- CONTENT OVERLAY - Section that dinamically loads content that will be manipulated by the user, and therefore needs focus -->
		<div id="missions-content-overlay" class="background-color-dark absolute min-full-height full-width hidden">
			<div class="relative min-full-height">
				<!-- CLOSE BUTTON -->
				<div id="close-content-overlay-button" class="right absolute margin right-2 top-5">
					<a class="close-missions-content-overlay">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x text-color-dark"></i>
							<i class="fa fa-times fa-stack-1x fa-inverse text-color-highlight"></i>
						</span>
					</a>
				</div>

				<!-- CONTENT LOADED -->
				<div id="missions-content-overlay-body" class="content-body min-full-height" >
				</div>
			</div>
		</div>
		
		<!-- MAIN SECTION -->
		<section class="main-section relative min-full-height">
			<div id="missionSidebar" class="row full-width clearfix absolute full-height hidden" data-equalizer>
				<!-- MISSION SUBMENU (description, phases) -->
				<div class="mission-sidebar small-6 medium-6 large-4 columns min-full-height" data-equalizer-watch>
					<div class="missions-submenu padding top-1 left-3">
						<?php echo $this->fetch('missionsSubmenuContent'); ?>
					</div>
				</div>


				<!-- CONTENT -->
				<div class="mission-sidebar small-6 medium-6 large-8 columns min-full-height padding all-0" data-equalizer-watch>
					<!-- CONTENT: QUEST TAB -->
					<aside class="tabContent hidden full-height" id="tabQuests">
						<div class="table large-12 large-centered columns tabs-style-small-image right full-height overflow-hidden paddings-0 background-color-standard tabs-content tabQuestsContent full-width">
							<?php echo $this->fetch('tabQuestsContent'); ?>
						</div>
					</aside>

					<!-- DOSSIER -->
					<aside class="tabContent hidden full-height" id="tabDossier">
						<div class="large-12 large-centered columns full-height paddings-0 margin right-1">
							<?php echo $this->fetch('tabDossierContent'); ?>
						</div>
					</aside>

					<!-- EVIDENCES -->
					<aside class="tabContent hidden full-height" id="tabEvidences">
						<div class="large-12 large-centered columns full-height paddings-0 background-color-standard margin right-1">
							<?php echo $this->fetch('tabEvidencesContent'); ?>
						</div>
					</aside>

					<!-- MENU -->
					<aside class="tabContent hidden full-height" id="tabMenu">
						<div class="large-12 large-centered full-height background-color-standard tabMenuContent">
							<ul class=" full-width no-marker">
								<!-- OTHER MISSIONS -->
								<li class="table full-width text-center">
									<div class="table-cell  vertical-align-middle background-cover" data-interchange="['<?= $this->webroot.'img/missionTabMenu_missions.jpg' ?>',(default)]">
										<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="text-glow-on-hover">
											<div class="inline-block padding all-2 margin bottom-1 background-color-standard img-circular border-color-highlight border-style-solid img-glow-on-hover-small">
												<span class="icon-brankic icon-folder fa-4x text-color-highlight"></span>
											</div>
											<h4 class="text-color-highlight"><?= __('See other missions') ?></h4>
										</a>
									</div>
								</li>

								<!-- EVOKATION -->
								<li class="table full-width text-center">
									<div class="table-cell  vertical-align-middle background-cover" data-interchange="['<?= $this->webroot.'img/missionTabMenu_evokation.jpg' ?>',(default)]">
										<a href="#" class="text-glow-on-hover">
											<div class="inline-block padding all-2 margin bottom-1 background-color-standard img-circular border-color-highlight border-style-solid img-glow-on-hover-small">
												<span class="icon-brankic icon-rocket fa-4x text-color-highlight"></span>
											</div>
											<h4 class="text-color-highlight"><?= __('Create your evokation') ?></h4>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</aside>
				</div>
			</div>

			<div id="tabForum" class="row full-width clearfix absolute full-height hidden">
				<div id="tabForumContent" class="full-height">
					<div>
						<div class="loading-circle-outside"></div>
						<div class="loading-circle-inside"></div>
					</div>
				</div>
			</div>

			<!-- GRAPHIC NOVEL -->
			<div class="section missions-graphic-novel">
				<div id="loading">
					<div class="loading-circle-outside"></div>
					<div class="loading-circle-inside"></div>
				</div>

				<div class="missions-carousel full-width">
					<?php foreach ($novels as $novel) :
						//Reserve height space for image before HTML loads it
						//IMPORTANT: This is only fast when the image is in the same server!!!
						list($width_img, $height_img) = getimagesize('./files/attachment/attachment/'.$novel['Novel']['page_dir'].'/'.$novel['Novel']['page_attachment']);
					?>
						<div>
							<img data-lazy="<?= $this->webroot.'files/attachment/attachment/'.$novel['Novel']['page_dir'].'/'.$novel['Novel']['page_attachment'] ?>" height="<?= $height_img ?>px" class="full-width" />
						</div>
					<?php endforeach; ?>
					
					<?php
					//NO GRAPHIC NOVEL (just in case)
					if (count($novels) < 1) {?>
						<div data-alert="" class="alert-box radius">
							Alert: There is no graphic novel available in this mission.
							<a href="" class="close">×</a>
						</div>
					<?php } ?>
				</div>

				<!-- NAVIGATION BAR -->
				<div id="navigationBar" class="evoke row full-width fixed sticky contain-to-grid padding top-1 bottom-1 text-center background-color-dark-opacity-05 bottom-0">
						<div class="small-12 medium-12 large-12 columns centering-block">
							<ul class="inline-list centered-block margins-0">
								<li><h5 class="text-glow"><?= (isset($mission['Mission'])) ? $mission['Mission']['title'] : '' ?></h5></li>
								<li><div id="slickPrevArrow"></div></li>
								<li><h5 class="text-glow">Page <span id="page-number">1</span></h5></li>
								<li><div id="slickNextArrow"></div></li>
								<li><div id="slickArrows"></div></li>
							</ul>
						</div>
				</div>
			</div>

		</section>
	</div>

<?php
	//SCRIPT
	$this->Html->script('requirejs/app/Common/view-mission.js', array('inline' => false));
?>