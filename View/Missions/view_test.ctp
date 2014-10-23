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
			'/components/sidr/stylesheets/jquery.sidr.dark.css',
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
	
	<div id="missions-body" class="missions">
		<div class="off-canvas-wrap" data-offcanvas>
			<div class="inner-wrap">
				<nav class="tab-bar full-height">
				  <section class="right-small text-center opacity-07">
				    <a class="menu-icon background-color-standard" id="left-menu" href="#left-menu1">
				    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/icon-quests-gray.png' ?>" alt="Quests" />
				    </a>
				    <a class="menu-icon background-color-standard" id="right-menu" href="#right-menu">
				    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/icon-dossier-gray.png' ?>" alt="Dossier" />
				    </a>
				    <div id="demo-content">
					    <p style = "visibility: hidden;"><!-- start slipsum code -->

My money's in that office, right? If she start giving me some bullshit about it ain't there, and we got to go someplace else and get it, I'm gonna shoot you in the head then and there. Then I'm gonna shoot that bitch in the kneecaps, find out where my goddamn money is. She gonna tell me too. Hey, look at me when I'm talking to you, motherfucker. You listen: we go in there, and that nigga Winston or anybody else is in there, you the first motherfucker to get shot. You understand?

The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy My brothers. And you will know My name is the Lord when I lay My vengeance upon thee.

Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you. But I can't give you this case, it don't belong to me. Besides, I've already been through too much shit this morning over this case to hand it over to your dumb ass.

Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.

Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my ass, 'cause I'll kill the motherfucker, know what I'm sayin'?

My money's in that office, right? If she start giving me some bullshit about it ain't there, and we got to go someplace else and get it, I'm gonna shoot you in the head then and there. Then I'm gonna shoot that bitch in the kneecaps, find out where my goddamn money is. She gonna tell me too. Hey, look at me when I'm talking to you, motherfucker. You listen: we go in there, and that nigga Winston or anybody else is in there, you the first motherfucker to get shot. You understand?

My money's in that office, right? If she start giving me some bullshit about it ain't there, and we got to go someplace else and get it, I'm gonna shoot you in the head then and there. Then I'm gonna shoot that bitch in the kneecaps, find out where my goddamn money is. She gonna tell me too. Hey, look at me when I'm talking to you, motherfucker. You listen: we go in there, and that nigga Winston or anybody else is in there, you the first motherfucker to get shot. You understand?

Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.

Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.

Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.

Now that there is the Tec-9, a crappy spray gun from South Miami. This gun is advertised as the most popular gun in American crime. Do you believe that shit? It actually says that in the little book that comes with it: the most popular gun in American crime. Like they're actually proud of that shit. 

Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my ass, 'cause I'll kill the motherfucker, know what I'm sayin'?

<!-- please do not remove this line -->

<div style="display:none;">
<a href="http://slipsum.com">lorem ipsum</a></div>

<!-- end slipsum code --></p>
					</div>
					<div id="demo-content1">
					    <p style = "visibility: hidden;">Here are described differentdewdewdewdewdewtails.</p>
					</div>
				    <!-- <a class="right-off-canvas-toggle menu-icon background-color-standard" href="#" data-tabname="tabEvidences">
				    	<img class="evoke vertical-align-middle" src="<?= $this->webroot.'img/icon-evidences-gray.png' ?>" alt="Evidences" />
				    </a>
				    <a class="right-off-canvas-toggle menu-icon background-color-standard" href="#" data-tabname="tabMenu">
				    	<i class="fa fa-th-large fa-2x text-color-gray vertical-align-middle"></i>
				    </a> -->
				  </section>
				</nav>

				<aside class="right-off-canvas-menu tabQuests">
					<div class="large-12 large-centered columns tabs-style-small-image right full-height overflow-hidden paddings-0">
						<!-- TABS COM MENU -->
						<dl class="tabs vertical full-height margin right-1 background-color-standard" data-tab>
							<?php 
								$counter = 1;
								$active = 'class = "active"';

								if (isset($mission['Quest'])) {
									foreach($mission['Quest'] as $m): 
										if($counter != 1)
											$active = null;
										?>
										<dd <?= $active ?>><a href="#panel<?= $counter ?>" class="text-glow-on-hover"><?= $m['title'] ?></a></dd>
										<?php
										$counter++;
									endforeach;

									//ONLY FOR TESTS
									if (count($mission['Quest']) < 1) { ?>
									  <dd class="active"><a href="#panel1" class="text-glow-on-hover">Quest 1</a></dd>
									  <dd><a href="#panel2" class="text-glow-on-hover">Quest 2</a></dd>
									  <dd><a href="#panel3" class="deactivated">Quest 3</a></dd>
									  <dd><a href="#panel4" class="text-glow-on-hover">Quest 4</a></dd>
									<?php }
								}
							?>
						</dl>

						<div class="tabs-content full-height">

							<?php 
								$counter = 1;
								$active = 'active'; ?>

							<?php 
								if (isset($mission['Quest'])) {
									foreach($mission['Quest'] as $m): 
										if($counter != 1)
											$active = null;
										?>
								
								<div class="content <?= $active ?>" id="panel<?= $counter ?>">
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
												echo '<button class="button small general" style = "display:inline" disabled>'.__('+ File').'</button>';
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
											
											<div class = "evoke titles-right" style = "display: inline;">
												<span data-tooltip aria-haspopup="true" class="has-tip tip-top" title="In preview, it is not possible to save your evidence.">
													<button type="submit" id = "evidenceButton" class= "evoke button general small" disabled><?= strtoupper(__('Save Evidence')) ?></button>
												</span>	
											</div>
									    </div>
							    	</div>
								</div>

							<?php
									$counter++;
									endforeach;
								} ?>


						  <!-- TAB DOSSIER -->
						  <!-- <div class="content" id="panel2">
						    <p>Panel 2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						  </div> -->

						  <!-- TAB EVIDENCES -->
						  <!-- <div class="content" id="panel3">
						    <p>Panel 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						  </div> -->

						  <!-- TAB MENU -->
						  <!-- <div class="content" id="panel4">
						    <p>Panel 4. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						  </div> -->
						</div>
					</div>
				</aside>

				<aside class="right-off-canvas-menu tabDossier">
					<div class="large-12 large-centered columns">
						This section is not available in preview.
					</div>
				</aside>

				<aside class="right-off-canvas-menu tabEvidences">
					<div class="large-12 large-centered columns">
						This section is not available in preview.
					</div>
				</aside>

				<aside class="right-off-canvas-menu tabMenu">
					<div class="large-12 large-centered columns">
						This section is not available in preview.
					</div>
				</aside>

				<section class="main-section">
					<!-- SUBMENU -->
					<div class="missions-submenu fixed hidden padding top-1 left-3">

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
					</div>

					<!-- MISSOES -->
					<div class="section missions-content">
				    	<div class="row missions-carousel full-width">
				    		<!-- MISSAO 1 -->

				    		<?php foreach ($novels as $novel) : ?>
								<div>
									<img src="<?= $this->webroot.'files/attachment/attachment/'.$novel['Novel']['page_dir'].'/'.$novel['Novel']['page_attachment'] ?>" class="full-width" />
								</div>
							<?php endforeach; 

							//ONLY FOR TESTS
							if (count($novels) < 1) {?>
							<div>
								<img src="<?= $this->webroot.'img/episodes-example/E01G01P02.jpg' ?>"  class="full-width" />
							</div>
							<div>
								<img src="<?= $this->webroot.'img/episodes-example/E01G01P02.jpg' ?>"  class="full-width" />
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

	<!-- FOOTER -->
	<?php
		$this->start('footer');
		echo $this->element('footer');
		$this->end();
	?>
	<!-- FOOTER -->

<?php 
	echo $this->Html->script('/components/jquery/dist/jquery.min.js');
	echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js");

	//SLICK CAROUSEL
	echo $this->Html->script('/components/slick-carousel/slick/slick.min.js');
	echo $this->Html->script('//code.jquery.com/jquery-migrate-1.2.1.min.js');

	//STICKY KIT
	echo $this->Html->script('/components/sticky-kit/jquery.sticky-kit.min.js');
	
	//FOUNDATION
	echo $this->Html->script('/components/foundation/js/foundation/foundation.js');
	echo $this->Html->script('/components/foundation/js/foundation/foundation.offcanvas.js');

	echo $this->Html->script('/components/medium-editor/dist/js/medium-editor.min.js');//, array('inline' => false));
	echo $this->Html->script('/components/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.all.min.js');
	echo $this->Html->script('quest_attachments'); 

	echo $this->Html->script('/components/sidr/jquery.sidr.min.js');
?>


	<!-- FullPage Login -->
	<script type="text/javascript">

		$(document).ready(function() {

		  $('#left-menu').sidr({
		    name: 'sidr-left',
		    side: 'right', // By default
		    method: 'open',
		    source: "#demo-content"
		  });

		  $('#right-menu').sidr({
		    name: 'sidr-right',
		    side: 'right',
		    method: 'open',
		    source: "#demo-content1"
		  });
		});

		//OFF-CANVAS
		$(document)
			.foundation({
				offcanvas : {
					close_on_click: false,
					open_method: 'overlap'
				}
			});

		$(document)
			.on('open.fndtn.offcanvas', '[data-offcanvas]', function() {
				$('.off-canvas-wrap .missions-content').addClass('blur-strong').addClass('opacity-05');
	    		$('div.missions-submenu').removeClass("hidden"); //Show submenu
	    		//$('.right-small').css("right",$('.right-off-canvas-menu').width());
	    		$('.right-small').css("transform",'translate3d(-'+$('.right-off-canvas-menu').width()+'px, 0, 0)'); //Off-canvas buttons go to the left
			});

		$(document)
			.on('close.fndtn.offcanvas', '[data-offcanvas]', function() {
				$('.off-canvas-wrap .missions-content').removeClass('blur-strong').removeClass('opacity-05');
				$('div.missions-submenu').addClass("hidden"); //Hide submenu
				//$('.right-small').css("right","0");
				$('.right-small').css("transform",'translate3d(0, 0, 0)'); //Off-canvas buttons go to the left
			});

		$(document).ready(function() {
			//Creates carousel
			$('.missions-carousel').slick({
			  slidesToShow: 1,
			  variableHeight: true,
			  responsive: true,
			  lazyLoad: 'progressive',
			  arrows: true,
			  onAfterChange: function(slider,index){
			  	$('#page-number').html(index+1);
			  }
			});

			//Changes the position of the arrows
			$('#slickPrevArrow').append($('.slick-prev'));
			$('#slickNextArrow').append($('.slick-next'));

			//Adds margin so that the menu won't be on top of the container
			$('#missions-body').css("margin-top",$('#missions-menu').height());
			$('.missions-submenu').css("top",$('#missions-menu').height());


			//MULTIPLE OFFCANVAS
			$(".right-off-canvas-toggle").click(function(){
				//Show right offcanvas
				$(".right-off-canvas-menu").addClass("hidden");
        		$("." + $(this).data("tabname")).removeClass("hidden");
			});

			//SUBMIT EVIDENCE BUTTON
			$(".submit-evidence.button").click(function(){				
				var evidence = $(".evidence-quest-" + $(this).data("quest-id"));
				if ($(".evidence-quest-" + $(this).data("quest-id")).hasClass("hidden")) {
        			$(".evidence-quest-" + $(this).data("quest-id")).removeClass("hidden");
				} else {
					$(".evidence-quest-" + $(this).data("quest-id")).addClass("hidden");
				}
			});
			/*
			//http://blog.jonathanargentiero.com/?p=335
			//Using lazy load with foundation interchange
			function lazyInterchange(selector){
			       if($(selector).attr('data-lazy')){
			                $(selector).attr('data-interchange',$(selector).attr('data-lazy'));
			                $(document).foundation('reflow');
			                $(document).foundation('interchange', 'reflow');
			                $(selector).removeAttr('data-lazy');
			        }
			}

			lazyInterchange($('#my_element'));
			*/
		});

		//Sticky navigation bar, respecting parent element
		//$(window).ready(function() {
			//$(".sticky").stick_in_parent();
			/*var offset_top = $(window).height() * 0.9;
			$("#navigationBar").css("top",offset_top+"px");
			$("#navigationBar").stick_in_parent({ parent: 'section', offset_top: offset_top })
	        .on("sticky_kit:stick", function(e) {
	        	//alert("STICKY");
	            $(e.target)
	            .css("top",0+"px")
	            //.css("margin-top","0")
	            //.velocity("transition.slideDownIn", { duration: 200 })
	            .on("sticky_kit:unstick", function(e) {
	            	//alert("UNSTICK");
	            	$(e.target)
	            	.css("top",offset_top+"px");
	            });
	        });

	        $(".sticky_column").stick_in_parent();*/
		//});

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

		jQuery('#evidenceButton').click(function() {

			var MyDiv = document.getElementById('evidenceTitle');
			var MyDiv1 = document.getElementById('evidenceContent');

	        $('#EvidenceTitle').val(MyDiv.innerHTML);
	        $('#EvidenceContent').val(MyDiv1.innerHTML);

	    });
	</script>
