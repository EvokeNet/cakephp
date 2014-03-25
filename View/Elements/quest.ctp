<h2><?php echo $q['Quest']['title'];?></h2>
<p class="lead"><?php echo $q['Quest']['description'];?></p>
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
 							   			'action' => 'add')
									)
								); 
	

		foreach ($my_questionnaire['Question'] as $question) {
			if($question['type'] == 'essay'){
				//just show him a text area with the question description as the label
				echo $this->Form->input($question['id'].'][description', array('label' => $question['description']));
			}
			if($question['type'] == 'single-choice'){
				//show him the question description followed by radio buttons
				$possible_answers = array();
				foreach ($answers as $a) {
					if($a['Answer']['question_id'] == $question['id']) {
						$possible_answers[$a['Answer']['id']] = $a['Answer']['description'];
					}
				}
				echo $this->Form->input($question['id'].'][answer_id', array('type' => 'radio', 'options' => $possible_answers, 'legend' => $question['description']));
			}
			if($question['type'] == 'multiple-choice'){
				//show him the question description followed by checkboxes
				$possible_answers = array();
				foreach ($answers as $a) {
					if($a['Answer']['question_id'] == $question['id']) {
						$possible_answers[$a['Answer']['id']] = $a['Answer']['description'];
					}
				}
				echo $this->Form->input($question['id'].'][][answer_id', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $possible_answers, 'legend' => '', 'label' => '', 'before' => '<fieldset>' . $question['description'], 'after' => '</fieldset>'));
			}
		}
		?>
			<button class="button small" type="submit">
				<?php echo __('Save answers')?>
			</button>
		<?php
			echo $this->Form->end();
	}
?>
<!-- <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
			  