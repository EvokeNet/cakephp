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
	  <div class="small-12 columns form-evoke-style">
		<div class="margin all-5 top-1 text-center">
			<h3 class="text-color-highlight "><?= __('About you') ?></h3>

			<p><?= __('Congratulations, you have ventured further than most by answering this call.') ?> </p>
			<p><?= __('Now, it\'s time to fine out what type of Evoke agent are you.  Do you know?  What are the strengths, passions, and abilities you will bring to the Evoke network?') ?></p>
			<p><?= __('Answer the following and find out what type of Super Hero is hiding inside you...') ?></p>
		</div>

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
						if ($question['type'] == 'essay'){
							//show text area
							echo $this->Form->input('matching_answer]['.$question['id'].'][description', array('textarea','required' => true, 'label' => false));
						}
						else if ($question['type'] == 'single-choice'){
							//show radio buttons
							echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('type' => 'radio',
								'options' => $matching_question['MatchingAnswer'], 
								'required' => true, 
								'fieldset' => false, 
								'legend' => false, 
								'separator' => '<br />',
								'after' => '<small class="error">'.__('Required field.').'</small>'
							));
						}
						else if($question['type'] == 'multiple-choice'){
							//show checkboxes
							echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('multiple' => 'checkbox',
								'options' => $matching_question['MatchingAnswer'], 
								'required' => true, 
								'fieldset' => false, 
								'label' => false,
								'separator' => '<br />',
								'after' => '<small class="error">'.__('Required field.').'</small>'
							));
						}
						else if($question['type'] == 'order') {
							//show list of empty fields to put the order
							?>
							<ul id="sortable" class="no-marker margins-0"><?php
							foreach ($matching_question['MatchingAnswer'] as $answer): ?>
								<li class="background-color-light-dark padding all-05 margin bottom-05">
									<?= $answer ?>
								</li> <?php
							endforeach; ?>
							</ul> <?php
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
	</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/matching.js', array('inline' => false));
?>