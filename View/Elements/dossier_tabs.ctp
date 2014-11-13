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
	<div class="content active background-color-standard-opacity-07" id="dossierTabTexts">
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
	<div class="content background-color-standard-opacity-07" id="dossierTabLinks">
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
	<div class="content background-color-standard-opacity-07" id="dossierTabPictures">
		<ul class="no-marker">
			<?php 
				foreach ($dossier_files as $file):
					$type = explode('/', $file['Attachment']['type']);
					if($type[0] == 'image'): 
						$thumb_img_path = $this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/vga_'.$file['Attachment']['attachment'];
						$full_img_path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment']; ?>

						<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
							<a href="<?= $full_img_path ?>" data-reveal-id="dossierPicture<?= $file['Attachment']['id']?>">
								<img src="<?= $thumb_img_path?>" alt="<?= $file['Attachment']['name']?>" />
							</a>
							<p class="text-center margin top-05 bottom-0 left-05 right-05"><?= $file['Attachment']['name']?></p>
						</li>

						<div id="dossierPicture<?= $file['Attachment']['id']?>" class="reveal-modal small" data-reveal>
							<img src="<?= $full_img_path?>" alt="<?= $file['Attachment']['name']?>" />
							<a class="close-reveal-modal">&#215;</a>
						</div><?php 
					endif;
				endforeach;
			?>
		</ul>
	</div>

	<!-- VIDEOS -->
	<div class="content background-color-standard-opacity-07" id="dossierTabVideos">
		<ul class="no-marker">
			<?php 
				foreach ($dossier_files as $file):
					$type = explode('/', $file['Attachment']['type']);

					if ($type[0] == 'video'): 
						$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

						<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
							<?= $file['Attachment']['attachment']?>

							<a href="<?= $path ?>" data-reveal-id="dossierVideo<?= $file['Attachment']['id']?>" data-reveal>
								<p class="text-center margin top-05 bottom-0 left-05 right-05"><?= $file['Attachment']['name']?></p>
							</a>
						</li>

						<div id="dossierVideo<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
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
						<div id="frame-<?= $link['DossierVideo']['id']?>" class="flex-video-new">
						        <iframe id="iframe-<?= $link['DossierVideo']['id']?>" width="420" height="315" src="//<?= $link['DossierVideo']['video_link'] ?>" frameborder="0" allowfullscreen></iframe>
						</div>
						<a href="#" data-reveal-id="dossierVideoLink<?= $link['DossierVideo']['id']?>" data-reveal>
							<p class="text-center margin top-05 bottom-0 left-05 right-05"><?= $file['DossierVideo']['title']?></p>
						</a>
					</li>

					<div id="dossierVideoLink<?= $link['DossierVideo']['id']?>" class="reveal-modal large" data-reveal>
					  	<div id="frame-<?= $link['DossierVideo']['id']?>" class="flex-video-new">
						        <iframe id="iframe-<?= $link['DossierVideo']['id']?>" width="420" height="315" src="//<?= $link['DossierVideo']['video_link'] ?>" frameborder="0" allowfullscreen></iframe>
						</div>
						<a class="close-reveal-modal">&#215;</a> 
					</div>
 
			<?php endforeach; ?>
		</ul>
	</div>
</div>