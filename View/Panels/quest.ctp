<?php 
	if(!isset($origin) || $origin != 'edit_mission') $origin = 'add_mission';
	echo $this->Form->create('Quest', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'edit_quest', $mission_id, $me['Quest']['id'], $origin
                                    ),
									'enctype' => 'multipart/form-data'
								)); ?>
	<fieldset>
		<legend><?php echo __('Edit Quest'); ?></legend>
	<?php
		echo $this->Form->input('title', array('value' => $me['Quest']['title']));
		echo $this->Media->ckeditor('description', array('value' => $me['Quest']['description']));
        echo $this->Form->input('todo_list', array('value' => $me['Quest']['todo_list']));
        echo $this->Form->input('points', array('value' => $me['Quest']['points']));


        echo '<fieldset><legend> ' .__('Define Quest Power Points') . '</legend>';
        foreach ($powerpoints as $power) {
            $previous = 0;
            foreach ($mypp as $pp) {
                if($pp['QuestPowerPoint']['power_points_id'] == $power['PowerPoint']['id'] && $pp['QuestPowerPoint']['quest_id'] == $me['Quest']['id'])
                    $previous = $pp['QuestPowerPoint']['quantity'];
            }
            echo $this->Form->input('Power.' . $power['PowerPoint']['id'] . '.quantity', array(
                'label' => $power['PowerPoint']['name'],
                'value' => $previous
            ));
        }
        echo '</fieldset>';

        echo $this->Form->radio('mandatory', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => $me['Quest']['mandatory']));//
		echo $this->Form->hidden('mission_id', array('value' => $mission_id));
		echo $this->Form->hidden('phase_id', array('value' => $phase_id));
        echo $this->Form->hidden('type', array('value' => $me['Quest']['type']));
		if($me['Quest']['type'] == 1) {
			//present the already registered questions of this questionnaire
			$my_questionnaire = null;
			foreach ($questionnaires as $questionnaire) {
				if($questionnaire['Questionnaire']['quest_id'] == $me['Quest']['id']){
					//debug($questionnaire);
					$my_questionnaire = $questionnaire;
					break;
				}
			}
			if($my_questionnaire) {
	?>
	<!-- questionnaire form -->
	<p><b><?php echo __('Questionnaire:'); ?></b></p>
    <div id="survey-forms">
    	<?php 
    		//iterate questions of the questionnaire displaying its description in the form..
    		$k = 0;
    		foreach ($my_questionnaire['Question'] as $question) { ?>
    			
    			<div class="survey-question">
    				<label for="title-<?php echo $k; ?>">Enunciado</label>
    				<input class="input-block-level" id="title-<?php echo $k; ?>" name="data[Questions][<?php echo $k; ?>][description]" type="text" value="<?php echo $question['description']; ?>">
    				<input name="data[Questions][<?php echo $k; ?>][type]" type="hidden" value="<?php echo $question['type']; ?>">
    				<br>
    					<!-- iterates possible answers if question type isnt essay -->
    					<?php 
    						if($question['type'] != 'essay') {
    							if($question['type'] == 'single-choice') $cssClass = 'radio-prototype';
    							else $cssClass = 'checkbox-prototype';
    							foreach ($answers as $answer) {
    								if($answer['Answer']['question_id'] == $question['id']) {
    									//show all the pre-defined answers
    									?>
    									<div class="<?php echo $cssClass; ?>">
    										<input name="data[Questions][<?php echo $k; ?>][Answer][][description]" placeholder="Opção" type="text" value="<?php echo $answer['Answer']['description']; ?>">
    									</div>

    									<?php
    								}
    							}
    						}
    					?>

    				<button class="btn btn-danger btn-remove" id="<?php echo $k?>" type="button">
    					<i class="icon-trash"></i>
    				</button>
    			</div>

    	<?php
    			$k++;
    		}
    	?>
    </div>

    <div class="spacer20"></div>
    <div class="btn-group">
        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
            <i class="icon-plus"></i>
            <?php echo __('Add a question') ?>
            <i class="icon-caret-down"></i>
        </a>

        <ul class="dropdown-menu">
            <li>
            	<a href="#" id="essay-question" class="btn-create-question">
                    <i class="icon-text-height"></i>
                    <?php echo __('Essay'); ?>
                </a>
            </li>
            <!--<li>
                <a href="#" id="likert-scale-question" class="btn-create-question">
                    <i class="icon-sort-by-attributes"></i>
                    <?php echo __('1 to 5 scale'); ?>
                </a>
            </li>-->
            <li>
                <a href="#" id="single-choice-question" class="btn-create-question">
                    <i class="icon-circle-blank"></i>
                    <?php echo __('Single choice'); ?>
                </a>
            </li>
            <li>
                <a href="#" id="multiple-choice-question" class="btn-create-question">
                    <i class="icon-check-empty"></i>
                    <?php echo __('Multiple choice'); ?>
                </a>
            </li>
        </ul>
    </div>

    <div class="spacer40"></div>
	<!--fim de teste -->

	<?php 
			}
		} else {
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
        }
	?>
	</fieldset>
	<button class="button tiny" type="submit">
		<?php echo __('Save Quest')?>
	</button>
	<?php echo $this->Form->end(); ?>
	<button class="button alert small">
		<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'delete_quest', $mission_id, $me['Quest']['id'], $origin));?>
	</button>

    <?php echo $this->Html->script('survey'); ?>
    <?php echo $this->Html->script('quest_attachments'); ?>

    <!-- necessary function to add remove the already existing questions -->
    <script type="text/javascript">

        <?php
            $i = 0;
            for($i=0; $i<$k;$i++) {
        
                echo "$('#". $i ."').click(function() {
                        $('#". $i ."').parent('div.survey-question').remove();
                    });";

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