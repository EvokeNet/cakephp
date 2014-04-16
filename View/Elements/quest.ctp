<div class = "evoke quests content">
<h2><?php echo $q['Quest']['title'];?></h2>
<p><?php echo urldecode($q['Quest']['description']);?></p>
<?php 
	if($q['Quest']['type'] == 1) {
		//it's, actually, a questionnaire
		$my_questionnaire = null;
		//debug($questionnaires);
		foreach($questionnaires as $questionnaire){
			if($questionnaire['Questionnaire']['quest_id'] == $q['Quest']['id']) {
				$my_questionnaire = $questionnaire;
				break;
			}
		}

		//start form to respond
		echo $this->Form->create('UserAnswer', array(
 							   		'url' => array(
 							   			'controller' => 'UserAnswers',
 							   			'action' => 'add', $q['Quest']['mission_id'])
									)
								); 
	

		foreach ($my_questionnaire['Question'] as $question) {
			if($question['type'] == 'essay'){
				//check to see if user had already answered it
				$my_answer = null;
				foreach ($previous_answers as $previous) {
					if($previous['UserAnswer']['question_id'] == $question['id']) {
						$my_answer = $previous;
						break;
					}
				}
				//if so, show him his previous answer
				if($my_answer) {
					echo $this->Form->input($question['id'].'][description', array('label' => $question['description'], 'value' => $my_answer['UserAnswer']['description'], 'required' => true, 'type' => 'textarea'));
				} else {
					//else, just show him a text area with the question description as the label
					echo $this->Form->input($question['id'].'][description', array('label' => $question['description'], 'required' => true));
				}
				echo $this->Form->hidden($question['id'].'][question_id', array('value' => $question['id']));
			}
			if($question['type'] == 'single-choice'){
				//check to see if user had already answered it
				$my_answer = null;
				foreach ($previous_answers as $previous) {
					if($previous['UserAnswer']['question_id'] == $question['id']) {
						$my_answer = $previous;
						break;
					}
				}

				//show him the question description followed by radio buttons
				$possible_answers = array();
				foreach ($answers as $a) {
					if($a['Answer']['question_id'] == $question['id']) {
						$possible_answers[$a['Answer']['id']] = $a['Answer']['description'];
					}
				}

				//check to see if he already answered that, if so, check the coresponding radio
				if($my_answer) {
					echo $this->Form->input($question['id'].'][answer_id', array('type' => 'radio', 'options' => $possible_answers, 'default' => $my_answer['UserAnswer']['answer_id'], 'legend' => $question['description'], 'required' => true));
				} else {
					echo $this->Form->input($question['id'].'][answer_id', array('type' => 'radio', 'options' => $possible_answers, 'legend' => $question['description'], 'required' => true));
				}
				echo $this->Form->hidden($question['id'].'][question_id', array('value' => $question['id']));
			}
			if($question['type'] == 'multiple-choice'){
				//check to see if user had already answered it
				$my_answer = null;
				foreach ($previous_answers as $previous) {
					if($previous['UserAnswer']['question_id'] == $question['id']) {
						$my_answer[$previous['UserAnswer']['answer_id']] = $previous['UserAnswer']['answer_id'];
					}
				}

				//show him the question description followed by checkboxes
				$possible_answers = array();
				foreach ($answers as $a) {
					if($a['Answer']['question_id'] == $question['id']) {
						$possible_answers[$a['Answer']['id']] = $a['Answer']['description'];
					}
				}

				echo $this->Form->hidden($question['id'].'][question_id', array('value' => $question['id']));
				//check to see if he already answered that, if so, check the coresponding radio
				if($my_answer) {
					echo $this->Form->input($question['id'].'][answer_id', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $possible_answers, 'selected' => $my_answer, 'legend' => '', 'label' => '', 'before' => '<fieldset>' . $question['description'], 'after' => '</fieldset>', 'required' => true));	
				} else {
					echo $this->Form->input($question['id'].'][answer_id', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $possible_answers, 'legend' => '', 'label' => '', 'before' => '<fieldset>' . $question['description'], 'after' => '</fieldset>', 'required' => true));
				}
				
			}
		}
		?>
			<button class="button small" type="submit">
				<?php echo __('Save answers')?>
			</button>
		<?php
			echo $this->Form->end();
	} else {
		//not a questionnaire, check if there are attachments to show
		echo '<div>';
		foreach ($attachments as $attachment) {
			if($attachment['Attachment']['attachment']):
				echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$attachment['Attachment']['dir'].'/thumb_'.$attachment['Attachment']['attachment'] . '"/>';
				echo '<span>  </span>';
			endif;
		}
		echo '</div>';

		echo '<br>';

		//check the correct type of quest!
		//its a normal evidence type quest
		if($q['Quest']['type'] == 2) { 
			echo '<a href = "'. $this->Html->url(array('controller' => 'evidences', 'action' => 'add', $mission['Mission']['id'], $missionPhase['Phase']['id'], $q['Quest']['id'])) . '" class = "button">' . __('Add Discussion') . '</a>';
		}

		//its a group type of quest
		if($q['Quest']['type'] == 3) { 
			echo '<a href = "'. $this->Html->url(array('controller' => 'groups', 'action' => 'index', $mission['Mission']['id'], $q['Quest']['id'])) .'" class = "button">' . __('Join/Create a group!') . '</a>';
		}

		//its an evokation type of quest
		if($q['Quest']['type'] == 4) { 
			echo '<a href = "'. $this->Html->url(array('controller' => 'evidences', 'action' => 'add', $mission['Mission']['id'], $missionPhase['Phase']['id'], $q['Quest']['id'], true)) . '" class = "button">' . __('Add Evokation') . '</a>';
		}

	}
?>			  
</div>