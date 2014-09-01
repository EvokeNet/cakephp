<?php

	echo $this->Html->css(
		array(
			'evoke-new',
			'panels-new'
		)
	);

?>

<div class="sticky">
	<nav class="top-bar" data-topbar data-options="sticky_on: large">
	  <ul class="title-area">
	    <li class="name">
	      <h1><a href="#">My Site</a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right">
	      <li class="active"><a href="#">Right Button Active</a></li>
	      <li class="has-dropdown">
	        <a href="#">Right Button Dropdown</a>
	        <ul class="dropdown">
	          <li><a href="#">First link in dropdown</a></li>
	        </ul>
	      </li>
	    </ul>

	    <!-- Left Nav Section -->
	    <ul class="left">
	      <li><a href="#">Left Nav Button</a></li>
	    </ul>
	  </section>
	</nav>
</div>

<div class="row row-full-width">
  <div class="large-2 columns padding-left-0">
  	<div class = "menu-column">
  		<dl class="tabs vertical" data-tab style = "width:100%">
		  <dd class="active"><a href="#panel1"><?= __('Edit Mission') ?></a></dd>
		  <dd><a href="#panel2"><?= __('Phases') ?></a></dd>
		  <dd><a href="#panel3"><?= __('Dossier') ?></a></dd>
		  <dd><a href="#panel4"><?= __('Graphic Novel') ?></a></dd>
		</dl>
	</div>
  </div>
  <div class="large-10 columns">
  	<div class="tabs-content">
	  <div class="content active" id="panel1">
	    <h3><?= __('Edit Mission') ?></h3>
		<?php 
			echo $this->Form->create('Mission', array(
		   		'url' => array(
		   			'controller' => 'panels',
		   			'action' => 'edit_mission', 
		   			$mission['Mission']['id']
		   		),
		   		'enctype' => 'multipart/form-data'
			));
		?>

		<?php

			//debug($mission);
			// debug($mission['missionTitle']);
			// debug($mission['missionDescription'][0]['content']);

			echo $this->Form->input('Mission.title.eng', array('value' => $mission['missionTitle'][0]['content'], 'label' => __('English Title'), 'required' => true));
			
			echo $this->Form->input('Mission.title.spa', array('value' => $mission['missionTitle'][1]['content'], 'label' => __('Spanish Title')));

			echo $this->Form->input('Mission.description.eng', array('value' => $mission['missionDescription'][0]['content'], 'label' => __('English Description'), 'required' => true));
			
			echo $this->Form->input('Mission.description.spa', array('value' => $mission['missionDescription'][1]['content'], 'label' => __('Spanish Description')));

			// echo $this->Form->input('title', array('value' => $mission['Mission']['title'], 'label' => __('Title'), 'required' => true));
			// echo $this->Form->input('title_es', array('value' => $mission['Mission']['title_es'], 'label' => __('Spanish Title')));
			// echo $this->Form->input('description', array('value' => $mission['Mission']['description'], 'label' => __('Description'), 'required' => true));
			// echo $this->Form->input('description_es', array('value' => $mission['Mission']['description_es'], 'label' => __('Spanish Description')));

			echo $this->Form->input('video_link', array('value' => $mission['Mission']['video_link_es'], 'label' => __('Video Link')));
			echo $this->Form->input('video_link_es', array('value' => $mission['Mission']['video_link_es'], 'label' => __('Spanish Video Link')));
			echo $this->Form->radio('basic_training', array(0 => 'No', 1=>'Yes'), array('required' => true, 'default'=> $mission['Mission']['basic_training']));
			if(!is_null($mission['Mission']['image_dir'])) :
				echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission['Mission']['image_dir'].'/thumb_'.$mission['Mission']['image_attachment'] . '"/>';
				echo '<div class="input file"><label for="AttachmentImgAttachment">Change Image</label><input type="file" name="data[Attachment][Img][attachment]" id="AttachmentImgAttachment"></div>';
			else :
				echo '<div class="input file"><label for="AttachmentImgAttachment">Image</label><input type="file" name="data[Attachment][Img][attachment]" id="AttachmentImgAttachment"></div>';
			endif;
			if(!is_null($mission['Mission']['cover_dir'])) :
				echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/thumb_'.$mission['Mission']['cover_attachment'] . '"/>';
				echo '<div class="input file"><label for="AttachmentCoverAttachment">Change Cover</label><input type="file" name="data[Attachment][Cover][attachment]" id="AttachmentCoverAttachment"></div>';
			else :
				echo '<div class="input file"><label for="AttachmentCoverAttachment">Cover</label><input type="file" name="data[Attachment][Cover][attachment]" id="AttachmentCoverAttachment"></div>';
			endif;
			

			echo $this->Form->hidden('form_type', array('value' => 'mission'));
			if(isset($mission['MissionIssue'][0]['issue_id'])) {
				echo $this->Form->input('MissionIssue.issue_id', array(
					'label' => __('Issue'),
					'options' => $issues,
					'value' => $mission['MissionIssue'][0]['issue_id'] //as we are, for now, restricting the amount of issues per mission to 1
				));
			} else {
				echo $this->Form->input('MissionIssue.issue_id', array(
					'label' => __('Issue'),
					'options' => $issues,
					'value' => $mission['MissionIssue']['issue_id'] //as we are, for now, restricting the amount of issues per mission to 1
				));
			}
			echo $this->Form->input('organization_id', array(
						'label' => __('Created by'),
						'options' => $organizations,
						'value' => $mission['Mission']['organization_id']
			));
		?>
		
		<button class="button small" type="submit">
			<?php echo __('Save and continue') ?>
		</button>
		<?php echo $this->Form->end(); ?>

	  </div>
	  <div class="content" id="panel2">
	    <p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
	  </div>
	  <div class="content" id="panel3">
	    <p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
	  </div>
	  <div class="content" id="panel4">
	    <p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
	  </div>
	</div>
  </div>
</div>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');
?>