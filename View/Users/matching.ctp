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
				echo $this->Form->create('UserMatchingAnswer', array(
					'data-abide'
				));
		  		echo $this->Form->hidden('user_id', array('value' => $user_id));

		  		$counter = 0;
				foreach($matching_questions as $m):
					echo $this->Form->hidden('matching_question_id.', array('multiple' => true, 'value' => $m['MatchingQuestion']['id']));
					?>
					<div class="field-<?= $counter ?>">
						<label><?php
						echo $this->Form->input('matching_answer.', array('multiple' => true, 'required',
							'label' => array(
					            'text' => $m['MatchingQuestion']['matching_question'],
					            'class' => 'text-color-highlight'
					        ),
					        'after' => '<small class="error">'.__('Required field.').'</small>')); ?>
						</label>
						
  					</div><?php
					$counter++;
				endforeach; ?>

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

	/* Script */
	$this->start('script'); ?>
	<script type="text/javascript">
		//Checkbox glows when selected
		$("input[type=checkbox]").on( "click", function(){
			if ($(this).hasClass('img-glow-small')) {
				$(this).removeClass('img-glow-small');
				$("label[for='"+$(this).attr("id")+"']").removeClass('text-glow');
			}
			else {
				$(this).addClass('img-glow-small');
				$("label[for='"+$(this).attr("id")+"']").addClass('text-glow');
			}
		});
	</script> <?php
	$this->end(); ?>