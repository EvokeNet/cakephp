<!-- QUEST DESCRIPTION -->
<div class="row">

	<!-- REWARDS -->
	<div class="right padding all-2">
		<h5 class="text-center">REWARDS</h5>
		<p class="text-center">
			<img class="vertical-align-middle" src="<?= $this->webroot.'img/badge1.png' ?>" alt="Quests" />
			<img class="vertical-align-middle" src="<?= $this->webroot.'img/badge2.png' ?>" alt="Quests" />
			<img class="vertical-align-middle" src="<?= $this->webroot.'img/badge3.png' ?>" alt="Quests" />
		</p>
		<h5 class="text-color-highlight text-center uppercase">+40 points</h5>
	</div>

	<h1 class="text-glow">QUEST X</h1>
	<p>As Evoke agents, we analyze and then act. Take action to increase someone's food security near you. What is the most critical problem in your community? Identify what you are most passionate about and take action. Remember: Food security isn't about a single meal. It's about long-term solutions. Think creatively. Use your imagination. Here are some ideas to get you started.</p>
	<p>(i) Help someone cultivate their home garden;</p>
	<p>(ii) Volunteer at a local community garden or food bank; </p>
	<p>(iii) Hold an “urban farming” meeting with friends -- or start a “urban farming” club -- to learn how to grow your own food. </p>
	<p>... what else can you do? Be creative! Share why you chose this action and what impact you hope to have. Post evidence of your effort as text, a video, or photo.</p>

</div>

<!-- QUEST FORM -->
<div class="form-evoke-style">
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'register'))); ?>

	<div class="medium-6 columns">
		<?php
			echo $this->Form->input('title', array('required' => true, 'label' => __('Title'), 'errorMessage' => __('Please enter a title'), 'error' => array(
		        'attributes' => array('wrap' => 'div', 'class' => 'alert-box alert radius')
		    )));
			echo $this->Form->input('evidence_content', array('type' => 'textarea', 'required' => true, 'label' => __('Your evidence')));
		?>
	</div>
</div>