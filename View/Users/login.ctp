<?php
	//CSS overriding fullpage.js plugin
	$cssBaseUrl = Configure::read('App.cssBaseUrl');
	echo $this->Html->css('fullpage.css');

	$this->extend('/Common/login-topbar');
	$this->start('menu');
	$this->end(); 
?>

	<div class="evoke login fullpage">
		<div class="section">
	    	<div class="row full-width missions-carousel">
	    		<!-- MISSAO 1 -->
			    <div class="evoke slide background-cover" data-interchange="
		    			[<?= $this->webroot.'/img/mission_1_NameMission-default.png' ?>, (default)], 
		    			[<?= $this->webroot.'/img/mission_1_NameMission-medium.png' ?>, (medium)],
		    			[<?= $this->webroot.'/img/mission_1_NameMission-large.png' ?>, (large)]">
					<noscript><img src="<?= $this->webroot.'/img/mission_1_NameMission-medium.png' ?>" alt="<?php echo __('Mission 1 - Name'); ?>"></noscript>

					<div class="table full-width full-height"><div class="table-cell vertical-align-bottom">
						<div class="evoke padding top-1 bottom-1 left-5 right-5 background-color-dark-opacity-05">
							<h2 class="text-color-important">Mission 1</h2>
							<p>Our grid works on almost any device and has support for nesting, source ordering, offsets and device presentation. Frankly, it's a little too easy. In no time, you'll be creating complex layouts like this.</p>
						</div></div>
					</div>
		    	</div>
		    	

		    	<!-- MISSAO 2 -->
		    	
		    	<div class="evoke slide background-cover" data-interchange="
		    			[<?= $this->webroot.'/img/mission_1_NameMission-default.png' ?>, (default)], 
		    			[<?= $this->webroot.'/img/mission_1_NameMission-medium.png' ?>, (medium)],
		    			[<?= $this->webroot.'/img/mission_1_NameMission-large.png' ?>, (large)]">

		    	<!-- 
		    	<div class="slide">
		    		<img data-interchange="
		    			[<?= $this->webroot.'/img/mission_1_NameMission-default.png' ?>, (default)], 
		    			[<?= $this->webroot.'/img/mission_1_NameMission-medium.png' ?>, (medium)],
		    			[<?= $this->webroot.'/img/mission_1_NameMission-large.png' ?>, (large)]">
					<noscript><img src="<?= $this->webroot.'/img/mission_1_NameMission-medium.png' ?>" alt="<?php echo __('Mission 2 - Name'); ?>"></noscript>-->

					<noscript><img src="<?= $this->webroot.'/img/mission_1_NameMission-medium.png' ?>" alt="<?php echo __('Mission 2 - Name'); ?>"></noscript>

					<div class="table full-width full-height"><div class="table-cell vertical-align-bottom">
						<div class="evoke padding top-1 bottom-1 left-5 right-5 background-color-dark-opacity-05">
							<h2 class="text-color-important">Mission 2</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at tristique mauris, in tempor nulla. Praesent malesuada, mi et aliquam luctus, nisi enim mollis lacus, et vehicula libero sem in metus. Fusce cursus orci id laoreet rutrum. Etiam sapien arcu, porttitor scelerisque metus vel, egestas vulputate velit. Phasellus risus augue, feugiat vitae accumsan non, vulputate sagittis nisi. Vivamus consequat rhoncus tincidunt. Suspendisse auctor sapien a nisl hendrerit lobortis. Nam consectetur sem erat. Sed at dapibus nibh, non pellentesque magna. Nullam quis viverra ex.</p>
						</div>
					</div></div>
		    	</div>
	    	</div>
	    </div>
	    
	    <div class="section evoke login gradient-on-top padding top-2">
		    <div id="teste3"></div>
	    	<div class="row standard-width">
		    	<h1 class="text-color-important text-center"><?php echo __('What is Evoke?'); ?></h1>
		    	<h2 class="text-color-important text-center">Titulo 2</h2>
		    	<h3 class="text-color-important text-center">Titulo 3</h3>
				Our grid works on almost any device and has support for nesting, source ordering, offsets and device presentation. Frankly, it's a little too easy. In no time, you'll be creating complex layouts like this.
				Need a head start on some of your designs or some extra inspiration to see the full potential of a responsive front-end framework? Check out a list of our Foundation resources!<br />
				Our grid works on almost any device and has support for nesting, source ordering, offsets and device presentation. Frankly, it's a little too easy. In no time, you'll be creating complex layouts like this.<br />
				Need a head start on some of your designs or some extra inspiration to see the full potential of a responsive front-end framework? Check out a list of our Foundation resources!<br />
				Our grid works on almost any device and has support for nesting, source ordering, offsets and device presentation. Frankly, it's a little too easy. In no time, you'll be creating complex layouts like this.<br />
				Need a head start on some of your designs or some extra inspiration to see the full potential of a responsive front-end framework? Check out a list of our Foundation resources!<br />
				Our grid works on almost any device and has support for nesting, source ordering, offsets and device presentation. Frankly, it's a little too easy. In no time, you'll be creating complex layouts like this.
				Need a head start on some of your designs or some extra inspiration to see the full potential of a responsive front-end framework? Check out a list of our Foundation resources!<br />Our grid works on almost any device and has support for nesting, source ordering, offsets and device presentation. Frankly, it's a little too easy. In no time, you'll be creating complex layouts like this.<br />
				Need a head start on some of your designs or some extra inspiration to see the full potential of a responsive front-end framework? Check out a list of our Foundation resources!
			</div>
	    </div>
	    <div class="section evoke login gradient-on-top padding top-2">
	    	<div class="row standard-width">
		    	<h2 class="text-color-important text-center"><?php echo __('Why was Evoke created?'); ?></h2>
		    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at tristique mauris, in tempor nulla. Praesent malesuada, mi et aliquam luctus, nisi enim mollis lacus, et vehicula libero sem in metus. Fusce cursus orci id laoreet rutrum. Etiam sapien arcu, porttitor scelerisque metus vel, egestas vulputate velit. Phasellus risus augue, feugiat vitae accumsan non, vulputate sagittis nisi. Vivamus consequat rhoncus tincidunt. Suspendisse auctor sapien a nisl hendrerit lobortis. Nam consectetur sem erat. Sed at dapibus nibh, non pellentesque magna. Nullam quis viverra ex.
				<br />
				Nunc sed scelerisque nunc. Mauris a pulvinar velit. Vivamus eu metus sed risus dignissim pharetra eget in urna. Proin elementum ultricies ligula eu tempor. Donec in dui vel nulla viverra venenatis ac aliquam nulla. Pellentesque at iaculis massa. Proin faucibus congue porta. Mauris sit amet ante nec justo dignissim tincidunt. Donec nec faucibus diam. Praesent elementum erat metus, pharetra consectetur libero volutpat rhoncus. Aliquam sed egestas nibh. Aenean nisi lorem, facilisis eget scelerisque ac, pellentesque et quam.
				<br />
				Etiam malesuada libero in viverra consequat. Aenean et lacinia nunc. Phasellus sed sapien velit. Curabitur in enim feugiat, lacinia nulla ac, hendrerit lacus. Aenean sapien elit, fermentum quis luctus in, pulvinar eget orci. Suspendisse sed enim non quam malesuada sagittis. Duis scelerisque pretium lobortis. Sed lectus lorem, ultrices sit amet odio a, tristique tincidunt ipsum. Pellentesque blandit ut arcu in ullamcorper. Suspendisse congue, turpis ut tincidunt sollicitudin, dui neque aliquet mi, posuere molestie dolor lacus at arcu. Nulla vitae lectus pellentesque, blandit diam quis, maximus sapien.
				<br />
				Pellentesque porttitor felis mauris, quis dignissim eros eleifend sed. Pellentesque ornare et elit non tristique. Aenean finibus magna mi. Cras varius sed lacus sit amet finibus. Nullam bibendum velit odio. Proin vestibulum ex eu ante ultrices finibus. Quisque ultrices ante eros, vitae rutrum nisl rutrum et. Aenean sed est ultricies, facilisis metus eu, condimentum neque. Vestibulum vehicula nec lectus sed ornare. Pellentesque condimentum nec metus sit amet rutrum.
				<p>
				Morbi ex ex, efficitur vitae leo vel, suscipit fringilla sem. Nunc malesuada dignissim sapien in fermentum. Sed sodales rutrum est sit amet iaculis. Aliquam in cursus tellus, at mollis tortor. Nullam id tortor at metus aliquam molestie. Fusce nec justo vestibulum, imperdiet urna vitae, blandit tortor. Mauris laoreet hendrerit ex. Donec sit amet sem lorem. Proin posuere ac tellus id tempor. Donec scelerisque turpis risus, vulputate bibendum tellus mattis nec. Nulla aliquet diam eget ipsum sodales venenatis. Ut eu sem sollicitudin, varius velit vitae, sodales justo.
				</p><p>
				Praesent eget diam sapien. Curabitur non rhoncus ante. Maecenas nec nisl vestibulum, vulputate turpis et, lacinia ante. Vivamus commodo sapien non arcu ultrices sagittis. Phasellus diam tortor, gravida vitae lorem et, ullamcorper malesuada velit. Sed massa odio, rhoncus sit amet tellus id, ultrices feugiat sapien. Morbi accumsan est elit, sit amet semper massa laoreet suscipit. Morbi tincidunt ante a nisl hendrerit tempus. Quisque at pellentesque diam, nec venenatis enim. Vestibulum pulvinar lacus vel metus aliquet malesuada varius a nunc.
				</p><p>
				Phasellus facilisis suscipit lacus. Vestibulum tincidunt libero vel justo aliquam convallis. Nunc sodales risus eu venenatis tincidunt. Phasellus ut ipsum at diam convallis condimentum ut nec sem. Aliquam in odio nec urna commodo mattis consequat quis ipsum. In pulvinar, risus eu convallis mattis, lacus nulla tempus mauris, non semper nibh lacus vel ligula. Phasellus luctus dui at massa venenatis consequat. Donec consectetur nunc et dolor sollicitudin facilisis. Integer tristique diam at cursus suscipit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce nec euismod urna. Pellentesque sed ullamcorper diam. Morbi non massa aliquet, facilisis sem sed, lacinia tellus. Nunc sed gravida est, in iaculis diam.
				</p>
			</div>
	    </div>
	    <div class="section evoke gradient-on-top padding top-2">
	    	<div class="row standard-width full-height centering-block table padding top-5">
		    	<h2 class="text-color-important text-center"><?php echo __('Gameplay'); ?></h2>

				<div class="evoke small-block-grid-5 tabs-style-linetriangle centered-block">
					<ul id="tabs-gameplay" class="tabs" data-tab role="tablist">
						<li class="tab-title active" role="presentational">
							<a href="#panelMissions" role="tab" aria-selected="true" controls="panelMissions">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active hidden border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-missions.png' ?>" alt="<?php echo __('Missions'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow"
										src="<?= $this->webroot.'img/thumb-missions.jpg' ?>" alt="<?php echo __('Missions'); ?>" />
								</div>
								<h5 class="text-color-important text-glow"><?php echo __('Missions'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelQuests" role="tab" aria-selected="false" controls="panelQuests">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-quests.png' ?>" alt="<?php echo __('Quests'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-quests.jpg' ?>" alt="<?php echo __('Quests'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Quests'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelEvidences" role="tab" aria-selected="true" controls="panelEvidences">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-evidences.png' ?>" alt="<?php echo __('Evidences'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-evidences.jpg' ?>" alt="<?php echo __('Evidences'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Evidences'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelBadges" role="tab" aria-selected="false" controls="panelBadges">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-badges.png' ?>" alt="<?php echo __('Badges'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-badges.jpg' ?>" alt="<?php echo __('Badges'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Badges'); ?></h5>
							</a>
						</li>
						<li class="tab-title" role="presentational">
							<a href="#panelPower" role="tab" aria-selected="false" controls="panelPower">
								<div class="tab-image centered-block img-circular">
									<img class="evoke img-circular vertical-align-middle not-active border-width-02 border-style-solid border-color-highlight padding all-1"
										src="<?= $this->webroot.'img/icon-powers.png' ?>" alt="<?php echo __('Powers'); ?>" />
									<img class="evoke img-circular vertical-align-middle active img-glow hidden"
										src="<?= $this->webroot.'img/thumb-powers.jpg' ?>" alt="<?php echo __('Powers'); ?>" />
								</div>
								<h5 class="text-color-important"><?php echo __('Powers'); ?></h5>
							</a>
						</li>
					</ul>
				</div>
				<div class="tabs-content text-left padding top-2">
					<section role="tabpanel" aria-hidden="false" class="content active" id="panelMissions">
						<p>Morbi ex ex, efficitur vitae leo vel, suscipit fringilla sem. Nunc malesuada dignissim sapien in fermentum. Sed sodales rutrum est sit amet iaculis. Aliquam in cursus tellus, at mollis tortor. Nullam id tortor at metus aliquam molestie. Fusce nec justo vestibulum, imperdiet urna vitae, blandit tortor. Mauris laoreet hendrerit ex. Donec sit amet sem lorem. Proin posuere ac tellus id tempor. Donec scelerisque turpis risus, vulputate bibendum tellus mattis nec. Nulla aliquet diam eget ipsum sodales venenatis. Ut eu sem sollicitudin, varius velit vitae, sodales justo.</p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelQuests">
						<p>Etiam malesuada libero in viverra consequat. Aenean et lacinia nunc. Phasellus sed sapien velit. Curabitur in enim feugiat, lacinia nulla ac, hendrerit lacus. Aenean sapien elit, fermentum quis luctus in, pulvinar eget orci. Suspendisse sed enim non quam malesuada sagittis. Duis scelerisque pretium lobortis. Sed lectus lorem, ultrices sit amet odio a, tristique tincidunt ipsum. Pellentesque blandit ut arcu in ullamcorper. Suspendisse congue, turpis ut tincidunt sollicitudin, dui neque aliquet mi, posuere molestie dolor lacus at arcu. Nulla vitae lectus pellentesque, blandit diam quis, maximus sapien.</p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelEvidences">
						<p>Praesent eget diam sapien. Curabitur non rhoncus ante. Maecenas nec nisl vestibulum, vulputate turpis et, lacinia ante. Vivamus commodo sapien non arcu ultrices sagittis. Phasellus diam tortor, gravida vitae lorem et, ullamcorper malesuada velit. Sed massa odio, rhoncus sit amet tellus id, ultrices feugiat sapien. Morbi accumsan est elit, sit amet semper massa laoreet suscipit. Morbi tincidunt ante a nisl hendrerit tempus. Quisque at pellentesque diam, nec venenatis enim. Vestibulum pulvinar lacus vel metus aliquet malesuada varius a nunc.</p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelBadges">
						<p>Phasellus facilisis suscipit lacus. Vestibulum tincidunt libero vel justo aliquam convallis. Nunc sodales risus eu venenatis tincidunt. Phasellus ut ipsum at diam convallis condimentum ut nec sem. Aliquam in odio nec urna commodo mattis consequat quis ipsum. In pulvinar, risus eu convallis mattis, lacus nulla tempus mauris, non semper nibh lacus vel ligula. Phasellus luctus dui at massa venenatis consequat. Donec consectetur nunc et dolor sollicitudin facilisis. Integer tristique diam at cursus suscipit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce nec euismod urna. Pellentesque sed ullamcorper diam. Morbi non massa aliquet, facilisis sem sed, lacinia tellus. Nunc sed gravida est, in iaculis diam.</p>
					</section>
					<section role="tabpanel" aria-hidden="true" class="content" id="panelPower">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at tristique mauris, in tempor nulla. Praesent malesuada, mi et aliquam luctus, nisi enim mollis lacus, et vehicula libero sem in metus. Fusce cursus orci id laoreet rutrum. Etiam sapien arcu, porttitor scelerisque metus vel, egestas vulputate velit. Phasellus risus augue, feugiat vitae accumsan non, vulputate sagittis nisi. Vivamus consequat rhoncus tincidunt. Suspendisse auctor sapien a nisl hendrerit lobortis. Nam consectetur sem erat. Sed at dapibus nibh, non pellentesque magna. Nullam quis viverra ex.</p>
					</section>
				</div>
			</div>
	    </div>
	    <div class="section evoke gradient-on-top padding top-2">
	    	<div class="row standard-width">
	    		<h2 class="text-color-important text-center"><?php echo __('Who is behind Evoke?'); ?></h2>
		    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at tristique mauris, in tempor nulla. Praesent malesuada, mi et aliquam luctus, nisi enim mollis lacus, et vehicula libero sem in metus. Fusce cursus orci id laoreet rutrum. Etiam sapien arcu, porttitor scelerisque metus vel, egestas vulputate velit. Phasellus risus augue, feugiat vitae accumsan non, vulputate sagittis nisi. Vivamus consequat rhoncus tincidunt. Suspendisse auctor sapien a nisl hendrerit lobortis. Nam consectetur sem erat. Sed at dapibus nibh, non pellentesque magna. Nullam quis viverra ex.
		    </div>
	    </div>
	    <div class="section evoke gradient-on-top padding top-2">
	    	<div class="row standard-width">
	    		<h2 class="text-color-important text-center"><?php echo __('How to become an agent?'); ?></h2>
		    	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at tristique mauris, in tempor nulla. Praesent malesuada, mi et aliquam luctus, nisi enim mollis lacus, et vehicula libero sem in metus. Fusce cursus orci id laoreet rutrum. Etiam sapien arcu, porttitor scelerisque metus vel, egestas vulputate velit. Phasellus risus augue, feugiat vitae accumsan non, vulputate sagittis nisi. Vivamus consequat rhoncus tincidunt. Suspendisse auctor sapien a nisl hendrerit lobortis. Nam consectetur sem erat. Sed at dapibus nibh, non pellentesque magna. Nullam quis viverra ex.
		    </div>
	    </div>
	</div>



<?php 
		echo $this->Html->script('/components/jquery/dist/jquery.min.js');
		echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js");
?>

	<!-- GamePlay tabs -->
	<script type="text/javascript">
		$(document).ready(function () {
			/* Show special image only in the tab that is active */
			$('#tabs-gameplay li').click(function() {
				//Hide thumb and glow in all others
				$('li img.active').addClass("hidden");
				$('li img.not-active').removeClass("hidden");
				$('li h5').removeClass("text-glow");
				//Show in this one
				$(this).find('img.not-active').addClass("hidden");
				$(this).find('img.active').removeClass("hidden");
				$(this).find('h5').addClass("text-glow");

			}).mouseover(function() {
				$(this).find('img.not-active').addClass("hidden");
				$(this).find('img.active').removeClass("hidden");
			}).mouseout(function() {
				if (!$(this).hasClass("active")) {
					$(this).find('img.active').addClass("hidden");
					$(this).find('img.not-active').removeClass("hidden");
				}
			});
		});
	</script>