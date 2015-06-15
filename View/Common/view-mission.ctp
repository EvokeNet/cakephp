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
		<?php echo $this->fetch('panelsMenu'); ?>

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
				<div class="missions-submenu mission-sidebar small-12 medium-12 large-5 columns min-full-height padding all-0" data-equalizer-watch data-equalizer-mq="large-up">
					<?php echo $this->fetch('panelsMainContent'); ?>
				</div>


				<!-- CONTENT -->
				<div class="mission-sidebar small-12 medium-12 large-7 columns min-full-height padding all-0" data-equalizer-watch data-equalizer-mq="large-up">
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
				</div>
			</div>

			<!-- EVOKE FORUM -->
			<div id="tabForum" class="row full-width clearfix absolute full-height hidden">
				<!-- FORUM TITLE -->
				<div class="full-width background-color-darkest padding all-1">
					<h5 class="text-center">
						<span class="fa fa-lightbulb-o fa-2x vertical-align-middle margin right-05"></span>
						<?= __('Evoke Forum') ?>
					</h5>
				</div>

				<!-- FORUM CONTENT -->
				<div id="tabForumContent" class="content full-height">
					<?php echo $this->element('loading_animation'); ?>
				</div>
			</div>

			<!-- GROUP FORUM -->
			<div id="tabGroupForum" class="row full-width clearfix absolute full-height hidden">
				<!-- FORUM TITLE -->
				<div class="full-width background-color-darkest padding all-1">
					<h5 class="text-center">
						<span class="fa fa-lightbulb-o fa-2x vertical-align-middle margin right-05"></span>
						<?= __('Group Forum') ?>
					</h5>
				</div>

				<!-- FORUM CONTENT -->
				<div id="tabGroupForumContent" class="content full-height">
					<?php echo $this->element('loading_animation'); ?>
				</div>
			</div>


			<!-- GRAPHIC NOVEL -->
			<div class="section missions-graphic-novel">
				<div id="loading">
					<?php echo $this->element('loading_animation'); ?>
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
						<div data-alert class="alert-box radius">
							<?= __('Alert: There is no graphic novel available in this mission.'); ?>
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
