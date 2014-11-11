<!-- TABS DOSSIER -->
<dl class="tabs tabs-style-image-and-text small-block-grid-4 full-width background-color-dark-opacity-05" id="dossierTabs" data-tab>
	<dd class="active">
		<a href="#dossierTabTexts" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-file3 fa-2x text-color-gray"></span>
			<?= __('Texts') ?>
		</a>
	</dd>
	<dd>
		<a href="#dossierTabLinks" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-link fa-2x text-color-gray"></span>
			<?= __('Links') ?>
		</a>
	</dd>
	<dd>
		<a href="#dossierTabPictures" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-picture fa-2x text-color-gray"></span>
			<?= __('Pictures') ?>
		</a>
	</dd>
	<dd>
		<a href="#dossierTabVideos" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-film5 fa-2x text-color-gray"></span>
			<?= __('Videos') ?>
		</a>
	</dd>
</dl>

<!-- TABS DOSSIER CONTENT -->
<div class="tabs-content full-width full-height background-color-standard-opacity-07 tabDossierContent">
	<!-- TEXTS -->
	<div class="content active" id="dossierTabTexts">
		<ul class="no-marker">
		  	<?php 
				foreach ($dossier_files as $file):
					$type = explode('/', $file['Attachment']['type']);
					if($type[0] == 'application'): 
						$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

						<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
							<a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a>
						</li>

						<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
						  	<object data="<?= $path ?>" type="application/pdf" width="100%" height="100%" style = "height:900px">
						  		<?= __("It looks like your browser can't open this file. Try downloading it instead.") ?>
						  	</object>
						  <a class="close-reveal-modal">&#215;</a> 
						</div><?php
					endif;
				endforeach; 
			?>
		</ul>
	</div>

	<!-- LINKS -->
	<div class="content" id="dossierTabLinks">
		<ul class="no-marker">
			<?php foreach($links as $link): ?>
				<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
					<a href = "//<?= $link['DossierLink']['link'] ?>" target="_blank"><?= $link['DossierLink']['title'] ?></a>&nbsp;-&nbsp;
					<?= $link['DossierLink']['description'] ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<!-- PICTURES -->
	<div class="content" id="dossierTabPictures">
		<ul class="no-marker">
			<?php 
				foreach ($dossier_files as $file):
					$type = explode('/', $file['Attachment']['type']);
					if($type[0] == 'image'): 
						$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

						<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
							<a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><img src = "<?= $path?>"/></a>
						</li>

						<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
						<div id="<?= $file['Attachment']['id']?>" class="reveal-modal small" data-reveal>
						  <img src = "<?= $path?>"/>
						  <a class="close-reveal-modal">&#215;</a> 
						</div><?php 
					endif;
				endforeach;
			?>
		</ul>
	</div>

	<!-- VIDEOS -->
	<div class="content" id="dossierTabVideos">
		<ul class="no-marker">
			<?php 
				foreach ($dossier_files as $file):
					$type = explode('/', $file['Attachment']['type']);

					if ($type[0] == 'video'): 
						$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

						<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
							<a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a>
						</li>

						<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
						  	<div class="flex-video">
							        <iframe width="420" height="315" src="<?= $path ?>" frameborder="0" allowfullscreen></iframe>
							</div>
						  <a class="close-reveal-modal">&#215;</a> 
						</div><?php
					endif;
				endforeach;
			?>
			<?php foreach ($video_links as $link): ?>
					<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
						<a href="#" data-reveal-id="video-<?= $link['DossierVideo']['id']?>" data-reveal><?= $link['DossierVideo']['title']?></a>
					</li>

					<div id="video-<?= $link['DossierVideo']['id']?>" class="reveal-modal large" data-reveal>
					  	<div id="frame-<?= $link['DossierVideo']['id']?>" class="flex-video-new">
						        <iframe id="iframe-<?= $link['DossierVideo']['id']?>" width="420" height="315" src="//<?= $link['DossierVideo']['video_link'] ?>" frameborder="0" allowfullscreen></iframe>
						</div>
						<a class="close-reveal-modal">&#215;</a> 
					</div>

			<?php endforeach; ?>
		</ul>
	</div>
</div>