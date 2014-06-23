<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default background-gray">

	<?php echo $this->Session->flash(); ?>
	
	<div class="row full-width-alternate padding top-1">

		<div class="small-3 medium-3 large-3 columns evidence dossier">
			<div class = "content-block box-padding ">

			<i class="fa fa-file-text fa-2x"></i><h2><?= __('Mission Dossier: Files')?></h2>
				    <ul>
					  	<?php 
							foreach ($dossier_files as $file):
								if($file['Attachment']['language']!=$lang) continue;
								$type = explode('/', $file['Attachment']['type']);
								if($type[0] == 'application'): 
									$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

								<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

								<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
								<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
								  <!-- <h2>Awesome. I have it.</h2>
								  <p class="lead">Your couch.  It is mine.</p>
								  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
								  	<object data="<?= $path ?>" type="application/pdf" width="100%" height="100%" style = "height:900px">

									  <p>It appears you don't have a PDF plugin for this browser.
									  No biggie... you can <a href="myfile.pdf">click here to
									  download the PDF file.</a></p>
									  
									</object>
								  <a class="close-reveal-modal">&#215;</a> 
								</div>
						<?php endif; endforeach; ?>
					</ul>

					<i class="fa fa-link fa-2x"></i><h2><?= __('Mission Dossier: Links')?></h2>
					<ul>
						<?php foreach($links as $link): ?>
							<li>
								<a href = "//<?= $link['DossierLink']['link'] ?>" target="_blank"><?= $link['DossierLink']['title'] ?></a>&nbsp;-&nbsp;
								<?= $link['DossierLink']['description'] ?>
							</li>
						<?php endforeach; ?>
					</ul>

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

					<i class="fa fa-video-camera fa-2x"></i><h2><?= __('Mission Dossier: Videos')?></h2>
				    <ul>
					  	<?php 
							foreach ($dossier_files as $file):
								if($file['Attachment']['language']!=$lang) continue;
								//echo $file['Attachment']['attachment'];
								//echo $file['Attachment']['type'];
								$type = explode('/', $file['Attachment']['type']);
								if($type[0] == 'video'): 
									$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

								<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

								<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
								<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
								  <!-- <h2>Awesome. I have it.</h2>
								  <p class="lead">Your couch.  It is mine.</p>
								  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
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
		</div>

		<div class="small-7 medium-7 large-7 columns maincolumn">
				
			<h1 class = "white"><?= $q['Quest']['title'] ?></h1>
			<h6 class = "white"><?= $q['Quest']['description'] ?></h6>

			<div class="evidences form">

				<div class = "evoke evidence-body edit">

				<div class = "padding30">
				<?php echo $this->Form->create('Evidence', array('enctype' => 'multipart/form-data', 'onsubmit' => "return check_form()")); ?>
					<?php //echo __('Edit Evidence'); ?>

					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('title', array('label' => __('Title'), 'required' => true));
						//echo $this->Form->input('content');
						echo $this->Form->hidden('user_id');
						//echo $this->Form->input('quest_id', array('empty' => true));
						echo $this->Form->hidden('mission_id');
						echo $this->Form->hidden('phase_id');
						echo $this->Media->ckeditor('content', array('label' => __('Content')));
						//echo $this->Media->iframe('Evidence', $this->request->data['Evidence']['id']);

						echo "<label>".__('Attachments'). "</label>";
			            echo '<div id="fileInputHolder">';
			            echo "<ul>";
			            $k = 0;
			            foreach ($attachments as $media) {
			                echo "<li>";
			                echo '<div class="input file" id="prev-'. $k .'"><label id="label-'. $k .'" for="Attachment'. $k .'Attachment">'. $media['Attachment']['attachment'] .'</label>';
			                
			                echo '<input type="hidden" name="data[Attachment][Old]['. $k .'][id]" id="Attachmentprev-'. $k .'Id" value="NO-'. $media['Attachment']['id'] .'">';
			                echo '<img id="img-'. $k .'"src="' . $this->webroot.'files/attachment/attachment/'.$media['Attachment']['dir'].'/thumb_'.$media['Attachment']['attachment'] . '"/>';

			                echo '<button class="button tiny alert" id="-'. $k .'">delete</button></div>';

			                $k++;
			            }
			            echo "</ul>";
			            echo '</div>';
			            echo '<button id="newFile" class="button tiny">+ File</button>';
					?>
				<?php //echo $this->Form->end(__('Save Evidence')); ?>
				<div class = "evoke titles-right"><button type="submit" id = "evidenceButton" class= "evoke button general submit-button-margin"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Save Evidence')) ?></button></div>
				</div>
				</div>
			</div>
		</div>

		<div class="small-2 medium-2 large-2 columns evidence dossier">
			<div class = "content-block">
			<?php
				$availablePP = array();
				foreach ($q['QuestPowerPoint'] as $questPP) {
					if(isset($allPowerPoints[$questPP['power_points_id']])) {
						$availablePP[] = $allPowerPoints[$questPP['power_points_id']];
					}
				}
				//debug($availablePP);
				if(!empty($availablePP)) { ?>
					
					<h2 class = "white"><?= __('Powers related to this quest: ') ?></h2>
				
				<div class = "box-padding">
					<?php
						$lastElement = end($availablePP);
						foreach ($availablePP as $powerpoint) {
							echo '<span data-tooltip data-options="disable_for_touch:true" class="has-tip tip-top radius white" title="';
							echo __('Needed to get the following badges: ');
							foreach ($powerpoint['BadgePowerPoint'] as $badgePowerPoint) {
								if(isset($allBadges[$badgePowerPoint['badge_id']])) {
									echo $allBadges[$badgePowerPoint['badge_id']]['Badge']['name'] . ' ';
								}
							}
							echo '">'. $powerpoint['PowerPoint']['name'] .'</span>';
							if($powerpoint != $lastElement) {
								echo ', ';
							}

						}
					}

					?>
				</div>
			</div>
		</div>

	</div>
</section>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('quest_attachments'); 
?>

<script type="text/javascript">

	//var editor = CKEDITOR.editor.replace('EvidenceContent');

	function autosave() {
	    jQuery('form').each(function() {

	    	var ops = $('.cke_wysiwyg_frame').contents().find('.cke_editable').html();

	        var formData = $("textarea#EvidenceContent").serializeArray();
	        formData.push({name: "data[Evidence][content]", value: ops});
	        ops = '';

	        jQuery.ajax({
	            url: "<?= $me['Evidence']['id'] ?>",
	            data: 'navigation=save&autosave=true&'+jQuery(this).serialize(),
	            type: 'POST',
	            success: function(data){
	                if(data && data == 'success') {
	                	$("textarea#EvidenceContent").val(ops);
	                    // Save successfully completed, no need to do anything
	                } else{
	                    // Save failed, report the error if you desire
	                    // ....
	                }
	            }// end successful POST function
	        }); // end jQuery ajax call

	        jQuery.ajax({
	            url: "<?= $me['Evidence']['id'] ?>",
	            data: formData,
	            type: 'POST',
	            success: function(data){
	                if(data && data == 'success') {
	                	$("textarea#EvidenceContent").val(ops);
	                    // Save successfully completed, no need to do anything
	                } else{
	                    // Save failed, report the error if you desire
	                    // ....
	                }
	            }// end successful POST function
	        });

     		// 	$.post("<?= $me['Evidence']['id'] ?>", formData, function(data){
			  //   if(data != ""){
			  //     //do stuff
			  //   }else{
			  //     //no data
			  //   }
		  	// });

	    }); // end setting up the autosave on every form on the page
	}// end function autosave()
	 
	// set the autosave interval (60 seconds * 1000 milliseconds per second)
	setInterval(autosave, 60 * 1000);


    <?php
        $i = 0;
        for($i=0; $i<$k;$i++) {
    
            echo "$('#-". $i ."').click(function() {
                    var attId = $('#Attachmentprev-". $i ."Id').val().replace('NO-', '');
                    $('#img-". $i ."').remove();
                    $('#label-". $i ."').remove();
                    $('#Attachmentprev-". $i ."Id').val(attId);
                    $('#-". $i ."').remove();
                    return false;
                });";                
    }?>

</script>
