<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	
	echo $this->Html->css(
		array(
			'/components/slick-carousel/slick/slick.css',
			'slick.css',
			'/components/medium-editor/dist/css/medium-editor.css',
			'/components/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.css',
			'medium.css',
			'sidr.css'
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

	<div id="missions-body" class="missions height-inherit">
		<!-- CONTENT OVERLAY -->
		<div id="missions-content-overlay" class="background-color-dark-opacity-06 absolute min-full-height full-width hidden" style="z-index: 6;">
			<a class="close-reveal-modal right">&#215;</a>
		</div>

		<div class="off-canvas-wrap height-inherit" data-offcanvas>
			<div class="inner-wrap">
				<nav class="tab-bar full-height" id="tab-bar-off-canvas">
					<!-- MENU ICONS (BUTTONS TO OPEN OFFCANVAS) -->
					<section class="right-small text-center opacity-07">
					    <a class="menu-icon custom background-color-standard" id="menu-icon-tabQuests" data-tab-content="tabQuests">
					    	<span class="icon-brankic icon-compass fa-2x vertical-align-middle text-color-gray"></span>
					    </a>
					    <a class="menu-icon custom background-color-standard" id="menu-icon-tabDossier" data-tab-content="tabDossier">
					    	<span class="icon-brankic icon-cabinet2 fa-2x vertical-align-middle text-color-gray"></span>
					    </a>
					    <a class="menu-icon custom background-color-standard" id="menu-icon-tabEvidences" data-tab-content="tabEvidences">
					    	<span class="icon-brankic icon-wallet fa-2x vertical-align-middle text-color-gray"></span>
					    </a>
					    <a class="menu-icon custom background-color-standard" id="menu-icon-tabMenu" data-tab-content="tabMenu">
					    	<span class="icon-brankic icon-grid icon-size-medium vertical-align-middle text-color-gray"></span>
					    </a>
				  </section>
				</nav>

				<aside class="right-off-canvas-menu tabQuests" id="tabQuests">
					<div class="table large-12 large-centered columns tabs-style-small-image right full-height overflow-hidden paddings-0">
						<!-- TABS COM QUESTS -->
						<dl class="tabs vertical table-cell full-width full-height margin right-1 background-color-standard opacity-07" id="questsTabs" data-tab>
							<?php 
								$counter = 1;
								$active = 'class = "active"';

								if (isset($mission['Quest'])) {
									foreach($mission['Quest'] as $m): 
										if($counter != 1)
											$active = null;
										?>
										<dd <?= $active ?>><a href="#quest<?= $counter ?>" class="text-glow-on-hover"><?= $m['title'] ?></a></dd>
										<?php
										$counter++;
									endforeach;

									//NO QUESTS: Show alert
									if (count($mission['Quest']) < 1) { ?>
										<div data-alert="" class="alert-box radius">
											There are no quests available in this mission.
											<a href="" class="close">×</a>
										</div>
									<?php }
								}
							?>
						</dl>

						<div class="tabs-content table-cell vertical-align-top full-width full-height background-color-standard gradient-on-left">
							<?php 
								$counter = 1;
								$active = 'active'; ?>

							<?php 
								if (isset($mission['Quest'])) {
									foreach($mission['Quest'] as $m): 
										if($counter != 1)
											$active = null;
										?>
								
								<div class="content <?= $active ?>" id="quest<?= $counter ?>">
									<div class = "margin right-1">
										<h3 class="text-color-highlight text-center"><?= $m['title'] ?></h3>
										<?= $m['description'] ?>

										<h5 class="text-color-highlight text-center">REWARDS</h5>
							    		<p class="text-center">Submitting an evidence for this quest is worth 3 badges:</p>
							    		<p class="text-center">
									    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge1.png' ?>" alt="Quests" />
									    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge2.png' ?>" alt="Quests" />
									    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/badge3.png' ?>" alt="Quests" />
									    </p>
									   
									    <p class="text-center margin top-2">
									    	<span data-tooltip aria-haspopup="true" class="has-tip" title="In preview mode, you can test this form, but not submit an actual response. Click to test it!">
									    		<a class="button small submit-evidence" data-quest-id="<?= $counter ?>">Submit your evidence</a>
									    	</span>
									    </p>

									    <!-- SUBMIT EVIDENCE -->
									    <div class="evidence-quest-<?= $counter ?> hidden text-center margin top-2" style="width: 70%;float: right;">
									    	
									    	<?php echo $this->Form->create('Evidence', array('enctype' => 'multipart/form-data')); ?>
											<?php //echo __('Edit Evidence'); ?>

											<?php
												// echo $this->Form->input('id');
												echo $this->Form->hidden('title');
												echo $this->Form->hidden('content');

												// echo $this->Form->hidden('user_id', array('value' => $user['User']['id']));

												echo $this->Form->hidden('quest_id', array('value' => $m['id']));
												echo $this->Form->hidden('mission_id', array('value' => $mission['Mission']['id']));
												echo $this->Form->hidden('phase_id', array('value' => $m['phase_id']));

												?>
												
												<?php
												echo '<div class = "editableTitle" id = "evidenceTitle"></div>';
												echo '<div class = "editableContent margin bottom-3" id = "evidenceContent"></div>';
												?>

												<span data-tooltip aria-haspopup="true" class="has-tip tip-top" title="In preview, it is not possible to add attachments.">
												<?php
												// echo "<label>".__('Attachments'). "</label>";
												echo '<button class="button small" style="display:inline" disabled>'.__('+ File').'</button>';
												?>
												</span>
												<?php
									            // echo '<div id="fileInputHolder">';
									            // echo "<ul>";
									            // $k = 0;
									            // foreach ($attachments as $media) {
									            //     echo "<li>";
									            //     echo '<div class="input file" id="prev-'. $k .'"><label id="label-'. $k .'" for="Attachment'. $k .'Attachment">'. $media['Attachment']['attachment'] .'</label>';
									                
									            //     echo '<input type="hidden" name="data[Attachment][Old]['. $k .'][id]" id="Attachmentprev-'. $k .'Id" value="NO-'. $media['Attachment']['id'] .'">';
									            //     echo '<img id="img-'. $k .'"src="' . $this->webroot.'files/attachment/attachment/'.$media['Attachment']['dir'].'/thumb_'.$media['Attachment']['attachment'] . '"/>';

									            //     echo '<button class="button tiny alert" id="-'. $k .'">delete</button></div>';

									            //     $k++;
									            // }
									            // echo "</ul>";
									            // echo '</div>';
											?>
											
											<div class="evoke titles-right" style = "display: inline;">
												<span data-tooltip aria-haspopup="true" class="has-tip tip-top" title="In preview, it is not possible to save your evidence.">
													<button type="submit" class="evidenceButton button small" disabled><?= strtoupper(__('Save Evidence')) ?></button>
												</span>	
											</div>
									    </div>
							    	</div>
								</div>

							<?php
									$counter++;
									endforeach;
								} ?>

						</div>
					</div>
				</aside>

				<aside class="right-off-canvas-menu tabDossier" id="tabDossier">
					<div class="large-12 large-centered columns full-height paddings-0 margin right-1">
						<?php echo $this->fetch('tabDossierContent'); ?>
					</div>
				</aside>

				<aside class="right-off-canvas-menu tabEvidences" id="tabEvidences">
					<div class="large-12 large-centered columns full-height paddings-0 background-color-standard-opacity-07 margin right-1">
						<?php echo $this->fetch('tabEvidencesContent'); ?>
					</div>
				</aside>

				<aside class="right-off-canvas-menu tabMenu" id="tabMenu">
					<div class="large-12 large-centered full-height background-color-standard tabMenuContent">
						<ul class="full-height full-width no-marker">
							<!-- OTHER MISSIONS -->
							<li class="table full-width text-center">
								<div class="table-cell full-height vertical-align-middle background-cover" data-interchange="['<?= $this->webroot.'img/missionTabMenu_missions.jpg' ?>',(default)]">
									<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>" class="text-glow-on-hover">
										<div class="inline-block padding all-2 margin bottom-1 background-color-standard img-circular border-color-highlight border-style-solid img-glow-on-hover-small">
											<span class="icon-brankic icon-folder fa-4x text-color-highlight"></span>
										</div>
										<h4 class="text-color-highlight"><?= __('See other missions') ?></h4>
									</a>
								</div>
							</li>

							<!-- FORUM -->
							<li class="table full-width text-center">
								<div class="table-cell full-height vertical-align-middle background-cover" data-interchange="['<?= $this->webroot.'img/missionTabMenu_forum.jpg' ?>',(default)]">
									<a href="#" class="text-glow-on-hover">
										<div class="inline-block padding all-2 margin bottom-1 background-color-standard img-circular border-color-highlight border-style-solid img-glow-on-hover-small">
											<span class="icon-brankic icon-chat fa-4x text-color-highlight"></span>
										</div>
										<h4 class="text-color-highlight"><?= __('Forum') ?></h4>
									</a>
								</div>
							</li>

							<!-- EVOKATION -->
							<li class="table full-width text-center">
								<div class="table-cell full-height vertical-align-middle background-cover" data-interchange="['<?= $this->webroot.'img/missionTabMenu_evokation.jpg' ?>',(default)]">
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

				<section class="main-section">
					<!-- SUBMENU -->
					<div class="missions-submenu fixed hidden padding top-1 left-3">
						<div class="content">
							<h1 class="text-glow"><?= (isset($mission['Mission'])) ? $mission['Mission']['title'] : '' ?></h1>

							<!-- PROGRESS BAR -->
							<div class="button-bar phases-bar padding top-05 bottom-05">
								<ul class="button-group radius">
									<li><a href="#" class="button small thin past font-weight-bold"><i class="fa fa-flag fa-lg"></i> <?= __('Explore') ?></a></li>
									<li><a href="#" class="button small thin present font-weight-bold"><i class="fa fa-fighter-jet fa-lg"></i> <?= __('Imagine') ?></a></li>
									<li><a href="#" class="button small thin disabled font-weight-bold"><i class="fa fa-eye fa-lg"></i> <?= __('Act') ?></a></li>
									<li><a href="#" class="button small thin disabled font-weight-bold"><i class="fa fa-flash fa-lg"></i> <?= __('Evoke') ?></a></li>
								</ul>
							</div>

							<!-- MISSION DESCRIPTION -->
							<p class="text-shadow-dark mission-description"><?php echo h($mission['Mission']['description']); ?></p>
						</div>
					</div>

					<!-- MISSOES -->
					<div class="section missions-content">
				    	<div class="missions-carousel full-width">
				    		<!-- MISSAO 1 -->

				    		<?php foreach ($novels as $novel) : ?>
								<div>
									<img src="<?= $this->webroot.'img/chip105.png' ?>" class="full-width" />
									
									<!-- <img src="<?= $this->webroot.'files/attachment/attachment/'.$novel['Novel']['page_dir'].'/'.$novel['Novel']['page_attachment'] ?>" class="full-width" /> -->
								</div>
							<?php endforeach; 

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
		</div>
	</div>



<?php $this->start('script'); ?>
<?php 
	//SLICK CAROUSEL
	echo $this->Html->script('/components/slick-carousel/slick/slick.min.js');
	echo $this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js');

	//STICKY KIT
	echo $this->Html->script('/components/sticky-kit/jquery.sticky-kit.min.js');

	//FOUNDATION
	echo $this->Html->script('/components/foundation/js/foundation/foundation.tab.js');
	
	//MEDIUM EDITOR
	echo $this->Html->script('/components/medium-editor/dist/js/medium-editor.min.js');
	echo $this->Html->script('/components/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.all.min.js');
	
	//SIDR (offcanvas)
	echo $this->Html->script('/components/sidr/jquery.sidr.min.js');
?>

	<script type="text/javascript">

		$(document).ready(function() {
			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			$('#missions-body').css("margin-top",$('#missions-menu').height());
			$('.missions-submenu').css("top",$('#missions-menu').height());

			//--------------------------------------------//
			//Creates carousel
			//--------------------------------------------//
			$('.missions-carousel').slick({
			  slidesToShow: 1,
			  variableHeight: true,
			  responsive: true,
			  lazyLoad: 'progressive',
			  arrows: true,
			  onInit: function(slider) {
			  	$('.slick-slide img:not(.slick-active)').addClass("hidden");
			  },
			  onBeforeChange: function(slider, currentIndex, targetIndex){
			  	//Hide previous image, so that it's height does not count in parent
			  	$('.slick-slide img').addClass("hidden");
			  	//Page number
			  	$('#page-number').html(targetIndex+1);
			  },
			  onAfterChange: function(slider,index){
			  	//Show this image
			  	$('.slick-active img').removeClass("hidden");
			  }
			});

			$('.missions-carousel').slickGoTo(0);

			//Changes the position of the arrows
			$('#slickPrevArrow').append($('.slick-prev'));
			$('#slickNextArrow').append($('.slick-next'));

			//--------------------------------------------//
			//Off canvas
			//--------------------------------------------//
			function open_sidr(sidr_button,sidr_source) {
				$(sidr_source).addClass("sidr-open");
				$(sidr_button+" span").addClass("text-color-highlight").removeClass("text-color-gray"); //Icon highlight
				$('.off-canvas-wrap .missions-content').addClass('blur-strong opacity-04'); //Blur everything else

				//Show submenu
				$('div.missions-submenu .content').css("margin-right",$(sidr_source).width()+100);
	    		$('div.missions-submenu').removeClass("hidden");

	    		//Position missions-content-overlay
	    		$('#missions-content-overlay').css("padding-right",$(sidr_source).width()+100);

	    		//Off-canvas buttons go to the left
	    		$('.right-small').css("right",$(sidr_source).width());
			}

			function close_sidr(sidr_button,sidr_source) {
				$(sidr_button+" span").removeClass("text-color-highlight").addClass("text-color-gray"); //Icon grey
				$('.off-canvas-wrap .missions-content').removeClass('blur-strong').removeClass('opacity-04'); //Blur everything else
				$('div.missions-submenu').addClass("hidden"); //Hide submenu
				$('#missions-content-overlay').addClass("hidden"); //Hide content overlay
				$('.right-small').css("right","0"); //Off-canvas buttons go back to the right
			}

			$('#menu-icon-tabQuests').sidr({
				name: 'sidr-tabQuests',
				side: 'right',
				source: '#tabQuests',
				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabQuests','#sidr-tabQuests'); },
				onClose: function() { close_sidr('#menu-icon-tabQuests','#sidr-tabQuests'); }
			});

			$('#menu-icon-tabDossier').sidr({
				name: 'sidr-tabDossier',
				side: 'right',
				source: '#tabDossier',
				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabDossier','#sidr-tabDossier'); },
				onClose: function() { close_sidr('#menu-icon-tabDossier','#sidr-tabDossier'); }
			});

			$('#menu-icon-tabEvidences').sidr({
				name: 'sidr-tabEvidences',
				side: 'right',
				source: '#tabEvidences',
				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabEvidences','#sidr-tabEvidences'); },
				onClose: function() { close_sidr('#menu-icon-tabEvidences','#sidr-tabEvidences'); }
			});

			$('#menu-icon-tabMenu').sidr({
				name: 'sidr-tabMenu',
				side: 'right',
				source: '#tabMenu',
				displace: false, renaming: false,
				onOpen: function() { open_sidr('#menu-icon-tabMenu','#sidr-tabMenu'); },
				onClose: function() { close_sidr('#menu-icon-tabMenu','#sidr-tabMenu'); }
			});

			//--------------------------------------------//
			//Top-bar margins
			//--------------------------------------------//
			//Adds margin so that the menu won't be on top of the container
			$('.sidr').css("top",$('#missions-menu').height());

			//--------------------------------------------//
			//SUBMIT EVIDENCE BUTTON
			//--------------------------------------------//
			$(".submit-evidence.button").click(function(){				
				var evidence = $(".evidence-quest-" + $(this).data("quest-id"));
				if ($(".evidence-quest-" + $(this).data("quest-id")).hasClass("hidden")) {
        			$(".evidence-quest-" + $(this).data("quest-id")).removeClass("hidden");
				} else {
					$(".evidence-quest-" + $(this).data("quest-id")).addClass("hidden");
				}
			});


			//--------------------------------------------//
			//MEDIUM EDITOR FOR EVIDENCES
			//--------------------------------------------//
			var editor = new MediumEditor('.editableContent', {
			    buttons: [
			    	'bold',
			        'italic',
			        'underline',
			        'header1',
			        'header2',
			        'orderedlist',
			        'unorderedlist',
			        'anchor',
			        'quote',
			        'superscript',
			        'subscript',
			        'strikethrough',
			    ],
			    checkLinkFormat: true,
			    cleanPastedHTML: true,
			    placeholder: "<?= __('Write here your Evidence') ?>",
			    targetBlank: true,
		  	});

			var editor1 = new MediumEditor('.editableTitle', {
			    buttons: [
			    	'bold',
			        'italic',
			        'underline',
			        'header1',
			        'header2',
			        'orderedlist',
			        'unorderedlist',
			        'anchor',
			        'quote',
			        'superscript',
			        'subscript',
			        'strikethrough',
			    ],
			    checkLinkFormat: true,
			    cleanPastedHTML: true,
			    placeholder: "<?= __('Write here the title for your Evidence') ?>",
			    targetBlank: true,
		  	});

			jQuery('.evidenceButton').click(function() {

				var MyDiv = document.getElementById('evidenceTitle');
				var MyDiv1 = document.getElementById('evidenceContent');

		        $('#EvidenceTitle').val(MyDiv.innerHTML);
		        $('#EvidenceContent').val(MyDiv1.innerHTML);

		    });
		    
			//--------------------------------------------//
		    //REFLOW FOUNDATION - After setting up slick (or generating any other elements), foundation needs to be updated
		    //--------------------------------------------//
			$(document).foundation('reflow');

			
			/*
			//http://blog.jonathanargentiero.com/?p=335
			//Using lazy load with foundation interchange
			function lazyInterchange(selector){
			       if($(selector).attr('data-lazy')){
			                $(selector).attr('data-interchange',$(selector).attr('data-lazy'));
			                $(document).foundation('reflow');
			                $(selector).removeAttr('data-lazy');
			        }
			}

			lazyInterchange($('#my_element'));
			*/
		});
	</script>
<?php $this->end(); ?>