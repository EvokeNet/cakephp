<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();

	/* Image header */
	// $this->start('image_header');
	// echo $this->element('image_header',array('imgHeaderTitle' => __('Generating your agent profile'), 'imgSrc' => ($this->webroot.'img/header-registering.jpg')));
	// $this->end();
?>
	<div class="row standard-width">
	  <div class="small-12 columns form-evoke-style">
		
        <div class="evoke row">
		  <div class="large-6 small-centered columns form-evoke-style">

			<div class = "gray-block block-green-border" style = "margin-top: 12%" id = "matchingInfo">
				<h3 class = "margin-top-1em text-center font-green font-weight-bold margin-bottom-1em"><?= __("About You") ?></h3>

				<p class = "text-center"><?= __('Congratulations, you have ventured further than most by answering this call.  <br><br>
				Now, itÃ¢â‚¬â„¢s time to find out what type of Evoke agent are you? What do you know? What are the strengths, passions, and abilities you will bring to the Evoke network? <br><br>
				Answer the following and find out what type of Super Hero is hiding inside you!') ?> </p>

				<div class = "margin-top-2em text-center"><a href="#" data-reveal-id="questionsModal" class="radius button" id = "matchingStart"><?= __("Start Identification") ?></a></div>

			</div>
		</div>

		<?php
			//NO QUESTIONS: Show alert
			if (count($matching_questions) < 1): ?>
				<div data-alert="" class="alert-box radius">
					<?= __('There are no matching questions available at this moment.') ?>
					<a href="" class="close">Ãƒâ€”</a>
				</div>
			<?php
			else:

				

				$counter = 1;
				$total_questions = count($matching_questions);
				$hidden = '';
				?>
				<div id="questionsModal" class = "hidden margin-top-1em">
					<!-- TITLE -->
					<!--<div class="row">
						<h2 class="text-glow"><?= __('Assessment questionare:') ?></h2>
					</div>-->
					<!-- PROGRESS BAR -->
                    
                    <div class="row">
                    <div class="large-1 columns"></div>
                    <div class="large-4 large-offset-7 columns">
      
					<ul class="timeline" id="timeline" style = "margin-top:30px">
                        <li class="li complete" id = "circle-1">
                        <div class="status">
                        </div>
                        </li>
                        <li class="li" id = "circle-2">
                        <div class="status">
                        </div>
                        </li>
                        <li class="li" id = "circle-3">
                        <div class="status">
                        </div>
                        </li>
                        <li class="li" id = "circle-4">
                        <div class="status">
                        </div>
                        </li>
                        <li class="li" id = "circle-5">
                        <div class="status">
                        </div>
                        </li>
                        <li class="li" id = "circle-6">
                        <div class="status">
                        </div>
                        </li>
                        <li class="li" id = "circle-7">
                        <div class="status">
                        </div>
                        </li>
                        <li class="li" id = "circle-8">
                        <div class="status-last">
                        </div>
                        </li>
                        </ul>
                    <!-- QUESTIONS -->
                    <!-- <span class="left text-glow uppercase padding right-2"><?= __('Questions') ?></span> -->

                    <!-- POINTS -->
                    <div class="right" style = "display:none">
                        <span id="questionCounter"><?= $counter?></span><?= '/' ?><span id="totalQuestions"><?= $total_questions ?></span>
                    </div>

                    <!-- PROGRESS BAR -->
                    <div class="progress level-bar radius" style = "display:none">
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
                        
                        <h3 class = "margin-top-1em text-center font-green font-weight-bold margin-bottom-15em"><?= sprintf(__('Scenario %s'), $counter) ?></h3>
                        
						<!--<span>
							<p class="text-color-highlight"><?= $question['description'] ?></p>
						</span>-->
                        
                        <div class = "gray-block block-green-border margin-bottom-2em" id = "matchingInfo">
                            <p class="text-color-highlight margin-bottom-15em"><?= $question['description'] ?></p>
                        </div>
                                    
						<?php
						if ($question['type'] == 'essay'){
							//show text area
							echo $this->Form->input('matching_answer]['.$question['id'].'][description', array('textarea','required' => true, 'label' => false));
						}
						else if ($question['type'] == 'single-choice'){
							//show radio buttons
							// echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('type' => 'radio',
							// 	'options' => $matching_question['MatchingAnswer'], 
							// 	'required' => true, 
							// 	'fieldset' => false, 
							// 	'legend' => false, 
							// 	'separator' => '<br />',
							// 	'after' => '<small class="error">'.__('Required field.').'</small>'
							// ));
                            
                            foreach($matching_question['MatchingAnswer'] as $key => $m):

                                echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('type' => 'radio',
                                    'options' => $m,
                                    'label' => array('class' => "question-block block-green-border margin-bottom-1em", 'id' => "matching_answer_".$key."0"),
                                    'required' => true,
                                    'fieldset' => false,
                                    'legend' => false,
                                    'id' => 'matching_answer_'.$key,
                                    'style' => 'display:none',
                                    'div' => 'margin-bottom-1em',
                                    'after' => '<small class="error">'.__('Required field.').'</small>'
                                ));

                            endforeach;
                                            
						}
						else if($question['type'] == 'multiple-choice'){ 
							//show checkboxes
							// echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('multiple' => 'checkbox',
							// 	'options' => $matching_question['MatchingAnswer'], 
							// 	'required' => true, 
							// 	'fieldset' => false, 
							// 	'label' => false,
							// 	'separator' => '<br />',
							// 	'after' => '<small class="error">'.__('Required field.').'</small>'
							// ));
                        ?>
                        
                        <ul>
                            <?php foreach($matching_question['MatchingAnswer'] as $key => $m): ?>
                                <li class = "gray-block block-green-border margin-bottom-1em" id = "<?php echo $key; ?>">
                                    <?= $m ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php //show checkboxes
                        echo $this->Form->input('matching_answer]['.$question['id'].'][matching_answer_id', array('multiple' => 'checkbox',
                            'options' => $matching_question['MatchingAnswer'],
                            'required' => true,
                            'fieldset' => false,
                            'label' => false,
                            'div' => 'gray-block block-green-border',
                            'separator' => '<br />',
                            'after' => '<small class="error">'.__('Required field.').'</small>'
                        )); ?>
                            
                        <?php
						}
						else if($question['type'] == 'order') {
							//show list of fields to drag and drop in order
							?>
							<ul id="sortable" class="sortable no-marker margins-0"><?php
                                foreach ($matching_question['MatchingAnswer'] as $mqIndex => $answer): ?>
                                    <li class="ui-state-default gray-block block-green-border margin-bottom-15em" data-sort="<?= $mqIndex ?>">
                                        <?= $answer ?>
                                    </li> <?php
                                endforeach; ?>
							</ul> 
                            
                            <?php
							$count = 1;
							foreach ($matching_question['MatchingAnswer'] as $mqIndex => $answer): ?>
								<input type="hidden" data-answer-id="<?= $mqIndex ?>" name="data[orderAnswer][<?= $question['id'] ?>][<?= $mqIndex ?>]" value="<?= $count ?>">
							<?php
								$count++;
							endforeach; 
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