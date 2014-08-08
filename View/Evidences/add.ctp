<?php

	echo $this->Html->css(
		array(
			'/components/medium-editor/dist/css/medium-editor.css',
			'/components/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.css',
		)
	);

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

				<?php echo $this->Form->create('Evidence', array('enctype' => 'multipart/form-data')); ?>
					<?php //echo __('Edit Evidence'); ?>

					<?php
						// echo $this->Form->input('id');
						echo $this->Form->hidden('title');
						echo $this->Form->hidden('content');
						echo $this->Form->hidden('user_id', array('value' => $user['User']['id']));
						echo $this->Form->hidden('quest_id', array('value' => $quest_id));
						echo $this->Form->hidden('mission_id', array('value' => $mission_id));
						echo $this->Form->hidden('phase_id', array('value' => $phase_id));

						echo '<div class = "editableTitle" id = "evidenceTitle"></div>';
						echo '<div class = "editableContent" id = "evidenceContent"></div>';

						echo "<label>".__('Attachments'). "</label>";
						echo '<button id="newFile" class="button general">'.__('+ File').'</button>';
			            echo '<div id="fileInputHolder">';
			            echo "<ul>";
			            // $k = 0;
			            // foreach ($attachments as $media) {
			            //     echo "<li>";
			            //     echo '<div class="input file" id="prev-'. $k .'"><label id="label-'. $k .'" for="Attachment'. $k .'Attachment">'. $media['Attachment']['attachment'] .'</label>';
			                
			            //     echo '<input type="hidden" name="data[Attachment][Old]['. $k .'][id]" id="Attachmentprev-'. $k .'Id" value="NO-'. $media['Attachment']['id'] .'">';
			            //     echo '<img id="img-'. $k .'"src="' . $this->webroot.'files/attachment/attachment/'.$media['Attachment']['dir'].'/thumb_'.$media['Attachment']['attachment'] . '"/>';

			            //     echo '<button class="button tiny alert" id="-'. $k .'">delete</button></div>';

			            //     $k++;
			            // }
			            echo "</ul>";
			            echo '</div>';
					?>
				<?php //echo $this->Form->end(__('Save Evidence')); ?>
				<div class = "evoke titles-right"><button type="submit" id = "evidenceButton" class= "evoke button general submit-button-margin"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Save Evidence')) ?></button></div>
				</div>
				</div>
			</div>
		</div>

		<div class="small-2 medium-2 large-2 columns evidence dossier">
			
		</div>

	</div>
</section>

<script src="http://localhost:8000/socket.io/socket.io.js"></script>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	echo $this->Html->script('/components/medium-editor/dist/js/medium-editor.min.js');//, array('inline' => false));
	echo $this->Html->script('/components/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.all.min.js');//, array('inline' => false));
	//echo $this->Html->script('menu_height', array('inline' => false));
	//echo $this->Html->script('medium');
	//echo $this->Html->script('quest_attachments'); 
?>

<script type="text/javascript">

	//socket io client
	  var socket = io.connect('http://localhost:8000');

	  //on connetion, updates connection state and sends subscribe request
	  // socket.on('connect', function(data){
	  //   setStatus('connected');
	  //   socket.emit('subscribe', {channel:'notif'});
	  //   socket.emit('subscribe', {channel:'notifs'});
	  // });

	  // //when reconnection is attempted, updates status 
	  // socket.on('reconnecting', function(data){
	  //   setStatus('reconnecting');
	  // });

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

	var id = '';

	//retrive likes number
    socket.on('return_evidence_id', function (data) {
    	id = data;
    	console.log(id);
  	});

	function autosave() {
		var MyDiv = document.getElementById('evidenceTitle');
		var MyDiv1 = document.getElementById('evidenceContent');

        // $('#EvidenceTitle').val(MyDiv.innerHTML);
        // $('#EvidenceContent').val(MyDiv1.innerHTML);

		var data = {
			ititle:MyDiv.innerHTML, 
			icontent:MyDiv1.innerHTML, 
			user_id:"<?= $user['User']['id'] ?>", 
			quest_id:"<?= $quest_id ?>",
			mission_id:"<?= $mission_id ?>",
			phase_id:"<?= $phase_id ?>",
			iid:id
		};

		console.log(decodeURIComponent(MyDiv.innerHTML));
		socket.emit('autosave_evidence', data); //Places the counter when the page is reloaded
	}

	setInterval(autosave, 5 * 1000);

	//function autosave() {
	  //   jQuery('#EvidenceAddForm').submit(function() {

	  //   	var editor = new MediumEditor('.editableContent', {
			//     buttons: [
			//     	'bold',
			//         'italic',
			//         'underline',
			//         'header1',
			//         'header2',
			//         'orderedlist',
			//         'unorderedlist',
			//         'anchor',
			//         'quote',
			//         'superscript',
			//         'subscript',
			//         'strikethrough',
			//     ],
			//     checkLinkFormat: true,
			//     cleanPastedHTML: true,
			//     placeholder: "<?= __('Write here your Evidence') ?>",
			//     targetBlank: true,
			//     // images: true,
			//     // imagesUploadScript: "{{ URL::to('upload') }}",
			//     // addons: {
			//     //   images: {},
			//     //   embeds: {}
			//     // }
		 //  	});

			// var json = editor.serialize();

			// var MyDiv1 = document.getElementById('HAHAHA');

	  //       var formData = $("textarea#EvidenceContent").serializeArray();
	  //       formData.push({name: "data[Evidence][content]", value: MyDiv1.innerHTML});
	  //       ops = '';

	  //       jQuery.ajax({
	  //           url: "",
	  //           data: formData,
	  //           type: 'POST',
	  //           success: function(data){
	  //               //alert('yay');
	  //           }// end successful POST function
	  //       });

			//alert(MyDiv1.innerHTML);

			// $.ajax({
			// 	type: 'POST',
			// 	dataType: 'html',
			// 	data: "{'data[Evidence][content]='" + MyDiv1.innerHTML +"'}",// "data[Evidence][content]=" + JSON.stringify(json),//{data[Evidence][content] : JSON.stringfy(json)},
			// 	url: "",
			// 	success: function (data) {},
			// 	error: function () {}
			// });

	    // }); // end setting up the autosave on every form on the page
	//}// end function autosave()
	 
	// set the autosave interval (60 seconds * 1000 milliseconds per second)
	//setInterval(autosave, 5 * 1000);

	// var MyDiv1 = document.getElementById('HAHAHA');

 //  	$.ajax({
	// 	type: 'POST',
	// 	data: "{'data[Evidence][content]=" + MyDiv1.innerHTML +"}",// "data[Evidence][content]=" + JSON.stringify(json),//{data[Evidence][content] : JSON.stringfy(json)},
	// 	url: "",
	// 	success: function (data) {},
	// 	error: function () {}
	// });

</script>
