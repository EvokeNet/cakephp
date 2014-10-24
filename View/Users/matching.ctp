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

<div class="standard-width">
	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'matching_results')); ?>">
		<img src="<?= $this->webroot.'img/mockup-3-matching-questions.jpg' ?>" class="full-width" />
	</a>
</div>
	
	<div class="row full-width">
	  <div class="medium-6 columns">
	  	<h2><?= __('Matching') ?></h2>
	  	<?php
			echo $this->Form->create('UserMatchingAnswer', array(
			    'url' => array('controller' => 'UserMatchingAnswers', 'action' => 'add')
			));
	  		echo $this->Form->hidden('user_id', array('value' => $user_id));
	  		
	  		foreach($matching_questions as $m):
			  	echo $this->Form->hidden('matching_question_id.', array('multiple' => true, 'value' => $m['MatchingQuestion']['id']));
				echo $this->Form->input('matching_answer.', array('multiple' => true, 'placeholder' => $m['MatchingQuestion']['matching_question'], 'label' => false));
			endforeach;

			// foreach($matching_questions as $key => $m):
			//   	echo $this->Form->hidden($key.'.matching_question_id', array('multiple' => true, 'value' => $m['MatchingQuestion']['id']));
			// 	echo $this->Form->input($key.'.matching_answer', array('multiple' => true, 'placeholder' => $m['MatchingQuestion']['matching_question'], 'label' => false));
			// endforeach;

			echo $this->Form->end(__('Submit'));
		?>
	  </div>
	  <div class="medium-6 columns">
	  	<h2><?= __('Check the items most interesting to you') ?></h2>
	  	<?php
			if($issues):
				echo $this->Form->input('UserIssue.issue_id', array('class' => 'edit-user-issues', 'type' => 'select', 'multiple' => 'checkbox', 'selected' => $selectedIssues, 'label' => false));
			endif;
		?>
	  </div>
	</div>

<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>