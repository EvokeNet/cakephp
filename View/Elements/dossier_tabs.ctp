<!-- TABS DOSSIER -->
<dl class="tabs tabs-style-image-and-text small-block-grid-4 full-width background-color-dark-opacity-05" id="dossierTabs" data-tab>
	<dd class="active">
		<a href="#dossierTabLinks" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-link fa-2x text-color-gray"></span>
			<?= __('Links') ?>
		</a>
	</dd>
	<dd>
		<a href="#dossierTabVideos" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-film5 fa-2x text-color-gray"></span>
			<?= __('Videos') ?>
		</a>
	</dd>
	<dd>
		<a href="#dossierTabTexts" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-file3 fa-2x text-color-gray"></span>
			<?= __('Texts') ?>
		</a>
	</dd>
	<dd>
		<a href="#dossierTabPictures" class="testeGabi text-glow-on-hover">
			<span class="icon-brankic icon-picture fa-2x text-color-gray"></span>
			<?= __('Pictures') ?>
		</a>
	</dd>
</dl>

<!-- TABS DOSSIER CONTENT -->
<div class="tabs-content full-width full-height background-color-standard-opacity-07 tabDossierContent">
	<!-- LINKS -->
	<div class="content active background-color-standard-opacity-07" id="dossierTabLinks"> <?php
		//NO LINKS
		if (count($links) <= 0): ?>
			<div data-alert="" class="alert-box radius">
				<?= __('There are no links available at this moment.') ?>
				<a href="" class="close">x</a>
			</div> <?php
		endif;
		?>

		<ul class="no-marker">
			<?php foreach($links as $link): ?>
				<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
					<span data-tooltip aria-haspopup="true" class="has-tip" title="<?= $link['DossierLink']['description'] ?>">
						<a href="<?= $link['DossierLink']['link'] ?>" class="text-glow-on-hover text-color-highlight" target="_blank">
							<?= $link['DossierLink']['title'] ?>
						</a>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<!-- VIDEOS -->
	<div class="content background-color-standard-opacity-07" id="dossierTabVideos"> <?php
		//NO VIDEOS
		if ((count($dossier_files) <= 0) && (count($video_links) <= 0)): ?>
			<div data-alert="" class="alert-box radius">
				<?= __('There are no videos available at this moment.') ?>
				<a href="" class="close">x</a>
			</div> <?php
		endif;
		?>
		<ul class="no-marker">
			<?php 
				foreach ($dossier_files as $file):
					$type = explode('/', $file['Attachment']['type']);

					if ($type[0] == 'video'): 
						$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

						<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
							<?= $file['Attachment']['attachment']?>
							<p class="text-center margin top-05 bottom-0 left-05 right-05"><?= $file['Attachment']['name']?></p>
						</li><?php
					endif;
				endforeach;
			?>
			<?php foreach ($video_links as $link): ?>
					<li class="padding left-1 right-1 top-05 bottom-05 border-bottom-divisor background-color-light-dark-on-hover border-left-highlight-on-hover">
						<div id="frame-<?= $link['DossierVideo']['id']?>" class="flex-video-new">
						        <iframe id="iframe-<?= $link['DossierVideo']['id']?>" width="420" height="315" src="<?= $link['DossierVideo']['video_link'] ?>" frameborder="0" allowfullscreen></iframe>
						</div>
						
						<p class="text-center margin top-05 bottom-0 left-05 right-05"><?= $link['DossierVideo']['title']?></p>
					</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<!-- TEXTS -->
	<div class="content background-color-standard-opacity-07" id="dossierTabTexts"> <?php
		//NO TEXTS
		if (count($dossier_files) <= 0): ?>
			<div data-alert="" class="alert-box radius">
				<?= __('There are no texts available at this moment.') ?>
				<a href="" class="close">x</a>
			</div> <?php
		endif;
		?>

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

	<!-- PICTURES -->
	<div class="content background-color-standard-opacity-07" id="dossierTabPictures"> <?php
		//NO PICTURES
		if (count($dossier_files) <= 0): ?>
			<div data-alert="" class="alert-box radius">
				<?= __('There are no pictures available at this moment.') ?>
				<a href="" class="close">x</a>
			</div> <?php
		endif;
		?>

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
</div>