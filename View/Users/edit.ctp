<section>
<div class="row">
	<div class="small-6 large-centered columns">
		<div class="users form">
		<?php echo $this->Form->create('User', array('name' => 'editUser')); ?>
			<fieldset>
				<legend><?php echo __('Edit User'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('name');
				echo $this->Form->input('username');
				echo $this->Form->input('password');
				echo $this->Form->input('birthdate', array('type' => 'date', 'required' => true));
				//echo $this->Form->input('sex');
				echo $this->Form->input('sex', array(
					'type' => 'select',
				    'options' => array('male', 'female'),
				));
				echo $this->Form->input('biography', array('required' => true));
				echo $this->Form->input('facebook');
				echo $this->Form->input('twitter');
				echo $this->Form->input('instagram');
				echo $this->Form->input('website');
				echo $this->Form->input('blog');
				//echo $this->Form->hidden('UserIssue.user_id', array('value' => $user['User']['id']));
				echo $this->Form->input('UserIssue.issue_id', array('class' => 'edit-user-issues', 'type' => 'select', 'multiple' => 'checkbox', 'selected' => $selectedIssues));
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		<?php //echo $this->element('add_issue', array('user_id' => $user['User']['id'], 'issues' => $issues));?>
		</div>
	</div>
</div>
</section>
