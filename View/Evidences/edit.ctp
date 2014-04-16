<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background-gray padding top-2">

	<?php echo $this->Session->flash(); ?>
	
	<div class="row">
		<div class="small-11 small-centered columns">
			
			<div class="evidences form">

			<div class = "evoke evidence-body edit">

			<?php echo $this->Form->create('Evidence', array('enctype' => 'multipart/form-data')); ?>
				<?php echo __('Edit Evidence'); ?>

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
			<div class = "evoke titles-right"><button type="submit" class= "evoke button general submit-button-margin"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Save Evidence')) ?></button></div>
			</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->Html->script('quest_attachments'); ?>
<script type="text/javascript">

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
