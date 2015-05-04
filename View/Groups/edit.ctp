<section class="evoke background-green padding top-2">
	<div class="row full-width">
		<div class="small-9 small-centered columns">

			<div class="row full-width">

			  <div class="small-3 medium-3 large-3 columns evoke no-padding">
			  <div class = "evoke edit-agent-tag">
			  		<div class = "evoke text-align">
			  			<h1><?= $group['Group']['title'] ?></h1>
			  			<?php if(empty($group_img)) :?>
			  				<img src="https://graph.facebook.com//picture?type=large" style = "margin: 10%; width: 40%;"/>
			  			<?php else : ?>
			  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$group_img['Attachment']['dir'].'/thumb_'.$group_img['Attachment']['attachment'] ?>" style = "margin: 10%; width: 40%;"/>
			  			<?php endif; ?>
		  			</div>
		  			<div id="uploader" class = "evoke text-align">
			  			<i id="imageUpload" class="fa fa-upload fa-5x"></i>
		  			</div>

				  	<div class = "evoke border-bottom"></div>

					<img src = "<?= $this->webroot.'img/circuit.png' ?>" width="100%" />
				</div>
			  </div>

			  <div class="small-9 medium-9 large-9 columns evoke no-padding">
			  	<div class="evoke edit-bg users form">
					<?php echo $this->Form->create('Group', array('enctype' => 'multipart/form-data')); ?>
						<?php
							//echo $sumMyPoints;
							echo $this->Form->hidden('id', array('value' => $group['Group']['id']));
							echo $this->Form->input('title', array(
								'value' => $group['Group']['title'],
								'required' => true
							));
							echo '<div class="input file" style="display:none"><label for="Attachment0Attachment">Image</label><input type="file" name="data[Attachment][0][attachment]" id="Attachment0Attachment"></div>';
							echo $this->Form->input('description', array('required' => true, 'value' => $group['Group']['description'], 'type' => 'textarea'));
							// echo $this->Form->input('facebook');
							// echo $this->Form->input('twitter');
							// echo $this->Form->input('instagram');
							// echo $this->Form->input('website', array('label' => __('Website')));
							// echo $this->Form->input('blog');
							
						?>
					<div class = "evoke text-align"><button type="submit" class= "evoke button general submit-button-margin margin top-2"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Save group information')) ?></button> </div>
				</div>
			  </div>

			</div>
		</div>
	</div>
</section>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	//echo $this->Html->script('/components/foundation/js/foundation.min.js');
	//echo $this->Html->script('/components/foundation/js/foundation.min.js', array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
?>
<script type="text/javascript" charset="utf-8">
	$("#imageUpload").css( 'cursor', 'pointer' );

	$("#imageUpload").click(function() {
	    $("#Attachment0Attachment").click();
	});
	$('#Attachment0Attachment').change(function() {
		$('#path').remove();
		var str = $('#Attachment0Attachment').val();
		str = str.substring(str.lastIndexOf("\\") + 1);
	    $('#uploader').append('<div id="path"><small>'+ str+'</small></div>');
	});
</script>