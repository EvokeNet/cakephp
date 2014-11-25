<!-- EVIDENCE FORM -->
<div class="form-evoke-style">
	<?php
	//EDIT
	if (isset($evidence)) {
		echo $this->Form->create('Evidence', array('url' => array('controller' => 'evidences', 'action' => 'edit', $evidence['id'])));
	}
	//CREATE
	else {
		echo $this->Form->create('Evidence', array('url' => array('controller' => 'evidences', 'action' => 'add')));

		$evidence['title'] = "";
		$evidence['content'] = "";
	}
	?>
	

	<div class="row full-width">
		<?php
			echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'value' => $evidence['title'], 'class' => 'radius', 'errorMessage' => __('Please enter a title'), 'error' => array(
				'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
			)));
		?>

		<?php
			if (!isset($content_class)) {
				$content_class = 'radius';
			}
			echo $this->Form->input('content', array('label' => __('Edit your evidence:'), 'type' => 'textarea', 'class' => $content_class, 'value' => $evidence['content'], 'id' => 'evidenceContentForm'));
		?>

		<?php
			if (!isset($button_class)) {
				$button_class = 'button thin right margin top-05 text-center text-glow-on-hover';
			}
			?>
			<button class="<?= $button_class ?>" type="submit">

				<?php if (isset($button_icon) && ($button_icon)): ?>
					<i class="fa fa-floppy-o fa-2x"></i><br />
				<?php endif;?>
				
				<?= __('Post') ?>
			</button>

		<?php 
	    echo $this->Form->end();
	    ?>
	</div>
</div>

<!-- EVIDENCE ATTACHMENTS -->
<div class="content-block box-padding ">
	<!-- FILES -->
	<i class="fa fa-file-text fa-2x"></i>
	<h2><?= __('Mission Dossier: Files')?></h2>
	<ul>
		<?php 
			foreach ($dossier_files as $file):
				if($file['Attachment']['language']!=$lang) continue;
					$type = explode('/', $file['Attachment']['type']);
					if($type[0] == 'application'): 
						$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

					<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

					<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
					  	<object data="<?= $path ?>" type="application/pdf" width="100%" height="100%" style = "height:900px">

						  <p>It appears you don't have a PDF plugin for this browser.
						  No biggie... you can <a href="myfile.pdf">click here to
						  download the PDF file.</a></p>
						  
						</object>
					  <a class="close-reveal-modal">&#215;</a> 
					</div>
			<?php endif; 
			endforeach; 
		?>
	</ul>

	<!-- LINKS -->
	<i class="fa fa-link fa-2x"></i><h2><?= __('Mission Dossier: Links')?></h2>
	<ul>
		<?php foreach($links as $link): ?>
			<li>
				<a href = "//<?= $link['DossierLink']['link'] ?>" target="_blank"><?= $link['DossierLink']['title'] ?></a>&nbsp;-&nbsp;
				<?= $link['DossierLink']['description'] ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<!-- PICTURES -->
	<i class="fa fa-picture-o fa-2x"></i><h2><?= __('Mission Dossier: Pictures')?></h2>

    <ul class="small-block-grid-4">
	  	<?php 
			foreach ($dossier_files as $file):
				if($file['Attachment']['language']!=$lang) continue;
				$type = explode('/', $file['Attachment']['type']);
				if($type[0] == 'image'): 
					$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

				<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><img src = "<?= $path?>"/></a></li>

				<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
				<div id="<?= $file['Attachment']['id']?>" class="reveal-modal small" data-reveal>
				  <img src = "<?= $path?>"/>
				  <a class="close-reveal-modal">&#215;</a> 
				</div>

		<?php endif; endforeach; ?>
	</ul>

	<!-- VIDEOS -->
	<i class="fa fa-video-camera fa-2x"></i><h2><?= __('Mission Dossier: Videos')?></h2>
    <ul>
	  	<?php 
			foreach ($dossier_files as $file):
				if($file['Attachment']['language']!=$lang) continue;
				$type = explode('/', $file['Attachment']['type']);
				if($type[0] == 'video'): 
					$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

				<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

				<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
				  	<div class="flex-video">
					        <iframe width="420" height="315" src="<?= $path ?>" frameborder="0" allowfullscreen></iframe>
					</div>
				  <a class="close-reveal-modal">&#215;</a> 
				</div>

		<?php endif; endforeach; ?>

		<?php foreach ($video_links as $link): ?>

				<li><a href="#" data-reveal-id="video-<?= $link['DossierVideo']['id']?>" data-reveal><?= $link['DossierVideo']['title']?></a></li>

				<div id="video-<?= $link['DossierVideo']['id']?>" class="reveal-modal large" data-reveal>
				  	<div id="frame-<?= $link['DossierVideo']['id']?>" class="flex-video-new">
					        <iframe id="iframe-<?= $link['DossierVideo']['id']?>" width="420" height="315" src="//<?= $link['DossierVideo']['video_link'] ?>" frameborder="0" allowfullscreen></iframe>
					</div>
					<a class="close-reveal-modal">&#215;</a> 
				</div>

		<?php endforeach; ?>

	</ul>
</div>

<?php
	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evidences/evidence_form.js', array('inline' => false));
?>