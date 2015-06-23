<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Generating your agent profile', 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>
	<div class="row standard-width">
	  <div class="medium-6 columns form-evoke-style">
	  	<h3 class="margin bottom-1"><?= __('About you') ?></h3>
	  	<?php
			
	  		
			//NO QUESTIONS: Show alert
			if (count($matching_questions) < 1): ?>
				<div data-alert="" class="alert-box radius">
					<?= __('There are no matching questions available at this moment.') ?>
					<a href="" class="close">Ã—</a>
				</div>
			<?php
			else:

				//start form to respond
				echo $this->Form->create('UserMatchingAnswer', array('data-abide')); 
				echo $this->Form->hidden('user_id', array('value' => $user_id));

				$counter = 0;
				foreach ($matching_questions as $key => $matching_question) {
					$question = $matching_question['MatchingQuestion'];
					?>

					<!-- QUESTION DESCRIPTION -->
					<div class="field-<?= $counter ?>">
						<br />
						<label>
							<p class="text-color-highlight"><?= $question['description'] ?></p>
						</label>
						<?php

						//QUESTION ID
						echo $this->Form->hidden('matching_question_id', array('value' => $question['id']));

						if ($question['type'] == 'essay'){
							//show him a text area with the question description as the label
							echo $this->Form->input('matching_answer]['.$question['id'].'][description', array('textarea','required' => true, 'label' => false));
						}
						if ($question['type'] == 'single-choice'){
							//show him the question description followed by radio buttons
							echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('type' => 'radio',
								'options' => $matching_question['MatchingAnswer'], 
								'required' => true, 
								'fieldset' => false, 
								'legend' => false, 
								'separator' => '<br />',
								'after' => '<small class="error">'.__('Required field.').'</small>'
							));
						}
						if($question['type'] == 'multiple-choice'){
							//show him the question description followed by radio buttons
							echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('multiple' => 'checkbox',
								'options' => $matching_question['MatchingAnswer'], 
								'required' => true, 
								'fieldset' => false, 
								'label' => false,
								'separator' => '<br />',
								'after' => '<small class="error">'.__('Required field.').'</small>'
							));
						}
						?>
					</div> <?php
				}
		  		?>

				<div class="text-center">
					<button class="submit small"><?php echo __('Submit'); ?></button>
				</div>

			<?php 
			endif; ?>
			
	  </div>
	  <div class="medium-6 columns">
	  	<h3 class="margin bottom-1"><?= __('Check the items that interest you the most') ?></h3>
	  	<?php
	  		//NO ISSUES: Show alert
			if (!$issues): ?>
				<div data-alert="" class="alert-box radius">
					<?= __('There are no matching interests available at this moment.') ?>
					<a href="" class="close">Ã—</a>
				</div>
			<?php
			//HAS ISSUES AND QUESTIONS (has a form that can be sent)
			elseif(count($matching_questions) > 0):
				$counter = 0;
				echo $this->Form->input('UserIssue.issue_id', array('class' => 'edit-user-issues form-evoke-style', 'type' => 'select', 'multiple' => 'checkbox', 'label' => false));
				echo $this->Form->end();
			endif; ?>
	  </div>
	</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/matching.js', array('inline' => false));
?>