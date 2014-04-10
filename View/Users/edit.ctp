<section>
<div class="row">
	<div class="small-6 large-centered columns">
		<div class="users form">
		<?php echo $this->Form->create('User', array('name' => 'editUser')); ?>
			<fieldset>
				<legend><?php echo __('Edit Profile'); ?></legend>
			<?php
				//echo $sumMyPoints;
				echo $this->Form->input('id');
				echo $this->Form->input('name', array('label' => __('Name')));
				echo $this->Form->input('username', array('label' => __('Username')));
				echo $this->Form->input('email', array('type' => 'email', 'required' => true));
				echo $this->Form->input('birthdate', array('type' => 'date', 'required' => true, 'label' => __('Birthdate')));
				echo $this->Form->input('sex', array('type' => 'radio', 'options' => array(__('male'), __('female')), 'legend' => '', 'before' => '<label for = "UserSex">'.__('Sex').'</label>'));
				echo $this->Form->input('biography', array('required' => true, 'label' => __('Biography')));
				echo $this->Form->input('facebook');
				echo $this->Form->input('twitter');
				echo $this->Form->input('instagram');
				echo $this->Form->input('website', array('label' => __('Website')));
				echo $this->Form->input('blog');
				//echo $this->Form->input('UserIssue.issue_id', array('class' => 'edit-user-issues', 'type' => 'select', 'multiple' => 'checkbox', 'selected' => $selectedIssues));
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Save Changes')); ?>
		</div>
	</div>
</div>
</section>
