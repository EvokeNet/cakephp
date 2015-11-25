<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Generating your agent profile'), 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	$this->end();
?>
	<div class="row standard-width">
	  <div class="small-12 columns form-evoke-style">
		<div class="margin all-5 top-1 text-center">
			<h3 class="text-color-highlight "><?= __('About you') ?></h3>

			<p><?= __('Congratulations, you have ventured further than most by answering this call.') ?> </p>
			<p><?= __('Now, it\'s time to fine out what type of Evoke agent are you.  Do you know?  What are the strengths, passions, and abilities you will bring to the Evoke network?') ?></p>
			<p><?= __('Answer the following and find out what type of Super Hero is hiding inside you...') ?></p>
			<p><a href="#" data-reveal-id="questionsModal" class="radius button">Start</a></p>
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

				

				$counter = 1;
				$total_questions = count($matching_questions);
				$hidden = '';
				?>
				<div id="questionsModal" class="reveal-modal" data-reveal aria-labelledby="ModalTitle" aria-hidden="true" role="dialog" data-options="close_on_background_click:false; close_on_esc:false">
					<!-- TITLE -->
					<div class="row">
						<h2 class="text-glow"><?= __('Assessment questionare:') ?></h2>
					</div>
					<!-- PROGRESS BAR -->
					<div class="row collapse text-right padding top-2">
						<div class="row">
							<!-- QUESTIONS -->
							<span class="left text-glow uppercase padding right-2"><?= __('Questions') ?></span>

							<!-- POINTS -->
							<div class="right">
								<span id="questionCounter"><?= $counter?></span><?= '/' ?><span id="totalQuestions"><?= $total_questions ?></span>
							</div>
						</div>
						<div class="row margin top-05">
							<!-- PROGRESS BAR -->
							<div class="progress level-bar radius">
								<span class="meter" style="width: <?= floatval($counter - 1) / $total_questions * 100?>%"></span>
							</div>
						</div>
					</div>
					<?php
						//start form to respond
						echo $this->Form->create('UserMatchingAnswer', array('data-abide', 'id'=>'questionsForm')); 
						echo $this->Form->hidden('user_id', array('value' => $user_id));
						foreach ($matching_questions as $key => $matching_question) {
							$question = $matching_question['MatchingQuestion'];
							if($counter > 1){
								$hidden = 'hidden';
							}
					?>

					<!-- QUESTION DESCRIPTION -->
					
					<div class="field-<?= $counter ?> <?= $hidden ?>">
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
							//show list of fields to drag and drop in order
							?>
							<ul id="sortable-question-<?= $question['id'] ?>" class="sortable no-marker margins-0"><?php
							foreach ($matching_question['MatchingAnswer'] as $answer): ?>
								<li class="background-color-light-dark padding all-05 margin bottom-05">
									<?= $answer ?>
								</li> <?php
							endforeach; ?>
							</ul> <?php
						}

						if( $total_questions == $counter ){
							?>
							<div class="text-right">
								<?php 

								echo $this->Form->input('submit', array('type' => 'submit', 'class' => 'radius button', 'value' => __('Submit'), 'label' => false));
								echo $this->Form->end();

								?>
							</div>
							<?php
						}else{
							?>
							<div class="text-right">
								<a href="#" class="radius button nextQuestion">Next</a>
							</div>
							<?php
						}

						?>

					</div> 
					
					<?php
					$counter++;
				}
				?>
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