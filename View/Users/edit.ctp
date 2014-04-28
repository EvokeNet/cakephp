<?php 
	if(isset($user['User']['biography'])){
		$this->extend('/Common/topbar');
		$this->start('menu');
		echo $this->element('header', array('user' => $user));
		$this->end(); 
	}
?>
<section class="evoke background-green">
	<?php 
		if(isset($user['User']['biography'])){
			echo $this->element('menu', array('user' => $user));
		}
	?>
	<div class="row full-width">
		<div class="small-9 small-centered columns">

			<div class="row full-width">

			  <div class="small-3 medium-3 large-3 columns evoke no-padding">
			  <div class = "evoke edit-agent-tag">
			  		<div class = "evoke text-align">
			  			<h1><?= strtoupper(__('Evoke Account')) ?></h1>
			  			<?php if(empty($user_photo)) :?>
			  				<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" style = "margin: 10%; width: 40%;"/>
			  			<?php else : ?>
			  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$user_photo['Attachment']['dir'].'/thumb_'.$user_photo['Attachment']['attachment'] ?>" style = "margin: 10%; width: 40%;"/>
			  			<?php endif; ?>
		  			</div>
		  			<div id="uploader" class = "evoke text-align">
			  			<i id="imageUpload" class="fa fa-upload fa-5x"></i>
		  			</div>

		  			<div class = "evoke border-bottom"></div>

			  		<div class = "evoke text-align dashboard agent info">
			  			<h5><?php echo __('Points');?>&nbsp;&nbsp;<div><?= $userPoints ?></div></h5>
				  		<h5><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<div><?= $userLevel ?></div></h5>
				  	</div>

				  	<div class = "evoke border-bottom"></div>

					<img src = "<?= $this->webroot.'img/circuit.png' ?>" width="100%" />
				</div>
			  </div>

			  <div class="small-9 medium-9 large-9 columns evoke no-padding">
			  	<div class="evoke edit-bg users form">
					<?php echo $this->Form->create('User', array('name' => 'editUser', 'enctype' => 'multipart/form-data')); ?>
						<?php
							//echo $sumMyPoints;
							echo $this->Form->input('id');
							echo $this->Form->input('name', array('label' => __('Name'), 'class' => 'evoke'));
							if($user['User']['facebook_id'] == '' || $user['User']['facebook_id'] == null) {
								echo $this->Form->input('username', array('label' => __('Username')));
							}
							echo $this->Form->input('email', array('type' => 'email', 'required' => true));
							echo '<div class="input file" style="display:none"><label for="Attachment0Attachment">Image</label><input type="file" name="data[Attachment][0][attachment]" id="Attachment0Attachment"></div>';
							echo $this->Form->input('birthdate', array('type' => 'date', 'required' => true, 
								'dateFormat' => 'MDY',
						        'minYear'       => date('Y') - 100,
						        'maxYear'       => date('Y') - 20,
					        ));
							echo $this->Form->input('sex', array('type' => 'radio', 'options' => array(__('male'), __('female')), 'legend' => '', 'before' => '<label for = "UserSex">'.__('Sex').'</label>'));
							echo $this->Form->input('biography', array('required' => true, 'label' => __('Biography')));
							echo $this->Form->input('facebook');
							echo $this->Form->input('twitter');
							echo $this->Form->input('instagram');
							echo $this->Form->input('website', array('label' => __('Website')));
							echo $this->Form->input('blog');
							echo $this->Form->input('UserIssue.issue_id', array('class' => 'edit-user-issues', 'type' => 'select', 'multiple' => 'checkbox', 'selected' => $selectedIssues));
						?>
					<div class = "evoke text-align"><button type="submit" class= "evoke button general submit-button-margin margin top-2"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Save and proceed to your dashboard')) ?></button> </div>
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