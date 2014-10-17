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

			echo $this->Session->flash();

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

	  	<a href="#" data-reveal-id="myModalAddPhase"><i class="fa fa-plus fa-lg"></i></a>

	  	<div id="myModalAddPhase" class="phases form reveal-modal tiny" data-reveal>
			<?php echo $this->Form->create('Phase', array(
		   		'url' => array(
		   			'controller' => 'phases',
		   			'action' => 'add'
				))); ?>
				
			<?php echo __('Add Phase'); 

				echo $this->Form->input('id');

				echo $this->Form->input('Phase.name.eng', array('label' => __('English Title')));

				echo $this->Form->input('Phase.name.spa', array('label' => __('Spanish Title')));

				echo $this->Form->input('Phase.description.eng', array('label' => __('English Description'), 'required' => true));
				
				echo $this->Form->input('Phase.description.spa', array('label' => __('Spanish Description')));

				// echo $this->Form->input('name', array('label' => __('Name'), 'value' => $phase['Phase']['name'], 'required' => true));
				// echo $this->Form->input('name_es', array('label' => __('Spanish Name'), 'value' => $phase['Phase']['name_es'], 'required' => true));
				// echo $this->Form->input('description', array('label' => __('Description'), 'value' => $phase['Phase']['description'], 'required' => true));
				// echo $this->Form->input('description_es', array('label' => __('Spanish Description'), 'value' => $phase['Phase']['description_es'], 'required' => true));
				echo $this->Form->input('points', array('label' => __('Points'), 'required' => true));
				echo $this->Form->radio('type', array(0 => 'Discussion', 1 => 'Project'), array('required' => true));
				echo $this->Form->radio('show_dossier', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => 1));
				// echo $this->Form->hidden('mission_id', array('value' => $mission['Mission']['id']));
				echo $this->Form->input('position', array('required' => true));
			
				echo $this->Form->end(array('label' => 'Save Changes', 'class' => 'button general')); ?>

			<a class="close-reveal-modal">&#215;</a>
		</div>

	  	<ul class="small-block-grid-3">
		    <?php 

				foreach ($phases as $phase): ?>
				<li>	
					<table class="order-table-nots paginated" id = "ntsTable">
						<thead>
							<tr>
								<th width="25"><input type="checkbox" onclick="checkAll('ntsTable', 'nts')" name="chk[]" id="nts" /></th>
								<th><?= $phase['Phase']['name'] ?></th>
								<th width="25"><a href="#" data-reveal-id="myModalAddQuest<?= $phase['Phase']['id'] ?>"><i class="fa fa-plus fa-lg"></i></a></th>
					      		<th width="25"><a href="#" data-reveal-id="myModalEditPhase-<?= $phase['Phase']['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></th>
					      		<th width="25"><a href="<?php echo $this->Html->url(array('controller'=>'phases', 'action' => 'delete', $phase['Phase']['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></th><!-- Button to add new notification -->
							</tr>

							<div id="myModalAddQuest<?= $phase['Phase']['id'] ?>" class="reveal-modal tiny" data-reveal>
									<?php echo $this->Form->create('Quest', array(
								   		'url' => array(
								   			'controller' => 'quests',
								   			'action' => 'panel_add'
					   				))); 

				   						echo __('Add a Quest');

										echo $this->Form->input('Quest.title.eng');
								        echo $this->Form->input('Quest.title.spa', array('label' => __('Spanish Title')));
								        /*echo $this->Form->input('id');
								        debug($newQuest);
										echo $this->Media->ckeditor('content', array('label' => __('Description'), 'value' => $newQuest['Quest']['description']));*/
								        echo $this->Form->input('Quest.description.eng');
								        echo $this->Form->input('Quest.description.spa', array('label' => __('Spanish Description')));

								        echo $this->Form->input('points', array('required' => true));

								        echo '<fieldset><legend> ' .__('Define Quest Power Points') . '</legend>';
								        foreach ($powerpoints as $power) {
								            echo $this->Form->input('Power.' . $power['PowerPoint']['id'] . '.quantity', array(
								                'label' => $power['PowerPoint']['name'],
								                'value' => 0
								            ));
								        }
								        echo '</fieldset>';

								        echo $this->Form->radio('mandatory', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => 1));//
										echo $this->Form->radio('type', array(1 => 'Questionnaire', 2 => 'Evidence', 3 => 'Group', 4 => 'Evokation'), array('id' => 'questtype', 'required' => true));//
										echo $this->Form->hidden('mission_id', array('value' => $mission['Mission']['id']));
										echo $this->Form->hidden('phase_id', array('value' => $phase['Phase']['id']));
									?>

									<!-- div of the questionnaire -->
									<div id="questionnaire" style="display:none">
									    <p><b><?php echo __('Questionnaire:'); ?></b></p>
									        <div id="survey-forms"></div>

									        <div class="spacer20"></div>
									        <div class="btn-group">
									            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
									                <i class="icon-plus"></i>
									                <?php echo __('Add a question') ?>
									                <i class="icon-caret-down"></i>
									            </a>

									            <ul class="dropdown-menu">
									                <li>
									                	<a href="#" id="essay-question" class="btn-create-question">
									                        <i class="icon-text-height"></i>
									                        <?php echo __('Essay'); ?>
									                    </a>
									                </li>
									                <!--<li>
									                    <a href="#" id="likert-scale-question" class="btn-create-question">
									                        <i class="icon-sort-by-attributes"></i>
									                        <?php echo __('1 to 5 scale'); ?>
									                    </a>
									                </li>-->
									                <li>
									                    <a href="#" id="single-choice-question" class="btn-create-question">
									                        <i class="icon-circle-blank"></i>
									                        <?php echo __('Single choice'); ?>
									                    </a>
									                </li>
									                <li>
									                    <a href="#" id="multiple-choice-question" class="btn-create-question">
									                        <i class="icon-check-empty"></i>
									                        <?php echo __('Multiple choice'); ?>
									                    </a>
									                </li>
									            </ul>
									        </div>

									        <div class="spacer40"></div>
									</div>
									<div id="media" style="display:none">
									    <div id="fileInputHolder"></div>
									    <button id="newFile" class="button tiny">
									        + File
									    </button>
									</div>
									<button class="button small" type="submit">
										<?php echo __('Add Quest')?>
									</button>
									<?php echo $this->Form->end(); ?>
									<a class="close-reveal-modal">&#215;</a>
							</div>

							<div id="myModalEditPhase-<?= $phase['Phase']['id'] ?>" class="phases form reveal-modal tiny" data-reveal>
								<?php echo $this->Form->create('Phase', array(
							   		'url' => array(
							   			'controller' => 'phases',
							   			'action' => 'edit', 
							   			$phase['Phase']['id']
				   				))); ?>
									
								<?php echo __('Edit Phase'); 

									echo $this->Form->hidden('id', array('value' => $phase['Phase']['id']));

									echo $this->Form->input('Phase.name.eng', array('value' => $phase['phaseName'][0]['content'], 'label' => __('English Title')));

									echo $this->Form->input('Phase.name.spa', array('value' => $phase['phaseName'][1]['content'], 'label' => __('Spanish Title')));

									echo $this->Form->input('Phase.description.eng', array('value' => $phase['phaseDescription'][0]['content'], 'label' => __('English Description')));
									
									echo $this->Form->input('Phase.description.spa', array('value' => $phase['phaseDescription'][1]['content'], 'label' => __('Spanish Description')));

									// echo $this->Form->input('name', array('label' => __('Name'), 'value' => $phase['Phase']['name'], 'required' => true));
									// echo $this->Form->input('name_es', array('label' => __('Spanish Name'), 'value' => $phase['Phase']['name_es'], 'required' => true));
									// echo $this->Form->input('description', array('label' => __('Description'), 'value' => $phase['Phase']['description'], 'required' => true));
									// echo $this->Form->input('description_es', array('label' => __('Spanish Description'), 'value' => $phase['Phase']['description_es'], 'required' => true));
									echo $this->Form->input('points', array('label' => __('Points'), 'value' => $phase['Phase']['points'], 'required' => true));
									echo $this->Form->radio('type', array(0 => 'Discussion', 1 => 'Project'), array('value' => $phase['Phase']['type'], 'required' => true));
									echo $this->Form->radio('show_dossier', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => 1, 'value' => $phase['Phase']['show_dossier']));
									echo $this->Form->hidden('mission_id', array('value' => $mission['Mission']['id']));
									echo $this->Form->input('position', array('value' => $phase['Phase']['position'], 'required' => true));
								
									echo $this->Form->end(array('label' => 'Save Changes', 'class' => 'button general')); ?>

								<a class="close-reveal-modal">&#215;</a>
							</div>

						</thead>
						<tbody>
							<?php foreach ($phase['Quest'] as $quest): ?>
						  		<tr>
						  		  <td><input type="checkbox" name="chkbox[]"></td>
							      <td><?= $quest['title'] ?></td>
							      <td></td>
							      <td><a href="#" data-reveal-id="myModalEditQuest<?= $quest['id'] ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
							      <td><a href="<?php echo $this->Html->url(array('controller'=>'quests', 'action' => 'delete', $quest['id'])); ?>"><i class="fa fa-times fa-lg"></i></a></td>
							    </tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</li>
			<?php endforeach; ?>
		</ul>
	  </div>
	  <div class="content" id="panel3">
	    
		<dl class="tabs" data-tab>
			<dd class="active"><a href="#Links"><?= __('Dossier Links') ?></a></dd>
			<dd><a href="#Videos"><?= __('Dossier Videos') ?></a></dd>
			<dd><a href="#DAtachments"><?= __('Dossier Attachments') ?></a></dd>
		</dl>
		<div class="tabs-content ">
			<div class="content active" id="Links">
				<button class="button general" href="#" data-reveal-id="myModalDossierLink" data-reveal><?php echo __('Add a Link');?></button>
				<div id="myModalDossierLink" class="form reveal-modal tiny" data-reveal>
					<?php echo $this->Form->create('NewDossierLink', array(
							   		'url' => array(
							   			'controller' => 'panels',
							   			'action' => 'dossierLinks', $id, 'edit_mission')
								)
							); ?>
						<fieldset>
							<legend><?php echo __('Add a Link'); ?></legend>
						<?php
							echo $this->Form->input('title', array('label' => __('Title'), 'required' => true));
							echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
							echo $this->Form->input('link', array('label' => __('Link'), 'required' => true));
							echo $this->Form->hidden('mission_id', array('value' => $id));
							echo $this->Form->input('language', array('type'=>'select', 'options' => array('en' => 'English', 'es' => 'Spanish'),'selected' => 'en'));
						?>
						</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
				</div>

				<h3><?= __('Dossier Link') ?></h3>
				<?php 
					echo $this->Form->create('DossierLink', array(
						   		'url' => array(
						   			'controller' => 'panels',
						   			'action' => 'dossierLinks', $id, 'edit_mission' 
						   		)
					));
					$jLink = 0;
					foreach ($dossier_links as $link) {
						echo '<div id="linkContent-'.$link['DossierLink']['id'].'">';
						echo $this->Form->hidden('DossierLink.'.$link['DossierLink']['id'].'.id', array('value' => $link['DossierLink']['id']));
						echo $this->Form->hidden('DossierLink.'.$link['DossierLink']['id'].'.mission_id', array('value' => $link['DossierLink']['mission_id']));
						echo $this->Form->input('DossierLink.'.$link['DossierLink']['id'].'.title', array('value' => $link['DossierLink']['title']));
						echo $this->Form->input('DossierLink.'.$link['DossierLink']['id'].'.description', array('value' => $link['DossierLink']['description'], 'type'=>'textarea'));
						echo $this->Form->input('DossierLink.'.$link['DossierLink']['id'].'.link', array('value' => $link['DossierLink']['link']));
						echo $this->Form->input('DossierLink.'.$link['DossierLink']['id'].'.language', array('type'=>'select', 'options' => array('en' => 'English', 'es' => 'Spanish'),'selected' => $link['DossierLink']['language']));
						
						echo '<button class="button tiny alert" id="deleteLink-'.$link['DossierLink']['id'].'">delete</button>';
						
						echo '</div>';
						$jLink++;
					}

					echo '<button class="button small" type="submit">'. __('Save links') . '</button>';
					echo $this->Form->end();
				?>
			</div>
			<div class="content" id="Videos">
				<button class="button small" href="#" data-reveal-id="myModalDossierVideo" data-reveal><?php echo __('Add a Video');?></button>
				<div id="myModalDossierVideo" class="form reveal-modal tiny" data-reveal>
					<?php echo $this->Form->create('NewDossierVideo', array(
							   		'url' => array(
							   			'controller' => 'panels',
							   			'action' => 'dossierVideos', $id, 'edit_mission')
								)
							); ?>
						<fieldset>
							<legend><?php echo __('Add a Video'); ?></legend>
						<?php
							echo $this->Form->input('title', array('label' => __('Title'), 'required' => true));
							echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
							echo $this->Form->input('video_link', array('label' => __('Video embed link'), 'required' => true));
							echo $this->Form->hidden('mission_id', array('value' => $id));
							echo $this->Form->input('language', array('type'=>'select', 'options' => array('en' => 'English', 'es' => 'Spanish'),'selected' => 'en'));
						?>
						</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
				</div>
				<?php
					echo $this->Form->create('DossierVideo', array(
						   		'url' => array(
						   			'controller' => 'panels',
						   			'action' => 'dossierVideos', $id, 'edit_mission' 
						   		)
					));
					$jVideo = 0;
						foreach ($dossier_videos as $video) {
							echo '<div id="videoContent-'.$video['DossierVideo']['id'].'">';
							echo '<fieldset>';
							echo '<legend>'.__('Dossier Video').'</legend>';
							echo $this->Form->hidden('DossierVideo.'.$video['DossierVideo']['id'].'.id', array('value' => $video['DossierVideo']['id']));
							echo $this->Form->hidden('DossierVideo.'.$video['DossierVideo']['id'].'.mission_id', array('value' => $video['DossierVideo']['mission_id']));
							echo $this->Form->input('DossierVideo.'.$video['DossierVideo']['id'].'.title', array('value' => $video['DossierVideo']['title']));
							echo $this->Form->input('DossierVideo.'.$video['DossierVideo']['id'].'.description', array('value' => $video['DossierVideo']['description'], 'type'=>'textarea'));
							echo $this->Form->input('DossierVideo.'.$video['DossierVideo']['id'].'.video_link', array('value' => $video['DossierVideo']['video_link']));
							echo $this->Form->input('DossierVideo.'.$video['DossierVideo']['id'].'.language', array('type'=>'select', 'options' => array('en' => 'English', 'es' => 'Spanish'),'selected' => $video['DossierVideo']['language']));
							
							echo '<button class="button tiny alert" id="deleteVideo-'.$video['DossierVideo']['id'].'">delete</button>';
							echo '</fieldset>';
							echo '</div>';

							$jVideo++;
						}

						echo '<button class="button small" type="submit">'. __('Save videos') . '</button>';
						echo $this->Form->end();
					?>
			</div>
			<div class="content" id="DAtachments">
				<h4>
					<?= __('Create a dossier by adding files that might be useful for agents to complete this mission!') ?>
				</h4>
				<?php 
					if(!empty($dossier) && !is_null($dossier)) {
						echo $this->Form->create('Dossier', array(
							   		'url' => array(
							   			'controller' => 'panels',
							   			'action' => 'dossier', $id, $dossier['Dossier']['id'], 'edit_mission' 
							   		),
							   		'enctype' => 'multipart/form-data'
						));
					} else {
						echo $this->Form->create('Dossier', array(
							   		'url' => array(
							   			'controller' => 'panels',
							   			'action' => 'dossier', $id, null, 'edit_mission'
							   		),
							   		'enctype' => 'multipart/form-data'
						));
					}
					echo $this->Form->hidden('mission_id', array('value' => $id));
					echo $this->Form->hidden('language', array('value' => $language));
					if(!empty($dossier) && !is_null($dossier)) {
						echo $this->Form->hidden('id', array('value' => $dossier['Dossier']['id']));
					}

					echo "<label>".__('Attachments'). "</label>";
		            echo '<div id="fileInputHolderD">';
		            echo "<ul>";

		            $k = 0;
		            if(!is_null($dossier) && !empty($dossier)) {
						$k = 0;
						foreach ($dossier_files as $file) {
			                echo "<li>";
			                echo '<div class="input file" id="prev-'. $k .'"><label id="label-'. $k .'" for="Attachment'. $k .'Attachment">'. $file['Attachment']['attachment'] .'</label>';
			                
			                echo '<input type="hidden" name="data[Attachment][Old]['. $k .'][id]" id="Attachmentprev-'. $k .'Id" value="NO-'. $file['Attachment']['id'] .'">';
			                echo '<img id="img-'. $k .'"src="' . $this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/thumb_'.$file['Attachment']['attachment'] . '"/>';

			                echo '<button class="button tiny alert" id="-'. $k .'">delete</button></div>';

			                $k++;
			            }
					} else {
						echo "nothing yet..";
					}

		            echo "</ul>";
		            echo '</div>';
		            echo '<button href="#" id="newFileD" class="button tiny">+ File</button>';
		            echo '<br><br>';

		            echo '<button class="button small" type="submit">'. __('Save dossier') . '</button>';
					echo $this->Form->end();
				?>
			</div>
		</div>

	  </div>
	  <div class="content" id="panel4">
	    
	    <div class="row">
			<div class="small-8 medium-8 large-8 columns">
				<dl class="tabs" data-tab>
					<dd class="active"><a href="#novel_launcher"><?= __('Graphic novel launcher') ?></a></dd>
					<dd><a href="#novel_en"><?= __('English graphic novel') ?></a></dd>
					<dd><a href="#novel_es"><?= __('Spanish graphic novel') ?></a></dd>
				</dl>
				<div class="tabs-content">
					<div class="content active" id="novel_launcher">
						<h3></h3>
						<div class = "default-content">
							<?php 
								echo $this->Form->create('Launcher', array(
			 					   		'url' => array(
			 					   			'controller' => 'panels',
			 					   			'action' => 'novelLauncher', $id
			 					   		),
			 					   		'enctype' => 'multipart/form-data'
								));
								$tmp = 0;
								foreach ($phases as $phase) {
									echo 'Phase '.$phase['Phase']['name']. ' '.__('launcher');
								
									if(isset($launchers[$phase['Phase']['id']])) {
										echo $this->Form->hidden($tmp.'.id', array('value' => $launchers[$phase['Phase']['id']]['id']));
										echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$launchers[$phase['Phase']['id']]['image_dir'].'/thumb_'.$launchers[$phase['Phase']['id']]['image_name'] . '"/>';
									}

									echo $this->Form->hidden($tmp.'.phase_id', array('value' => $phase['Phase']['id']));

									echo '<div class="input file"><label for="Launcher'.$tmp.'Attachment0Attachment">Set Launcher Image</label><input type="file" name="data[Launcher]['.$tmp.'][Attachment][0][attachment]" id="Launcher'.$tmp.'Attachment0Attachment"></div><div class = "bottom-border margin bottom"></div>';

									$tmp++;
								}

								echo '<button class="button general" type="submit">'. __('Save Launchers') . '</button>';

								echo $this->Form->end();
							?>
						</div>
					</div>
					<div class="content" id="novel_en">
						<?php 
							echo $this->Form->create('Novel', array(
		 					   		'url' => array(
		 					   			'controller' => 'panels',
		 					   			'action' => 'novel', $id, 'edit_mission'
		 					   		),
		 					   		'enctype' => 'multipart/form-data'
							));

							echo '<ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">';
							$kn = 0;
							foreach ($novels_en as $ne => $novel) {
								echo '<li>';
								echo '<div id="content' .$kn.'">';
								echo '<fieldset><legend>Page preview</legend>';
								echo $this->Form->hidden($kn.'.mission_id', array('value' => $id));
								echo $this->Form->hidden($kn.'.language', array('value' => 'en'));
								echo $this->Form->hidden($kn.'.id', array('value' => $novel['Novel']['id']));
								echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$novel['Novel']['page_dir'].'/thumb_'.$novel['Novel']['page_attachment'] . '"/>';
								echo '<div style="float:right">';
								echo $this->Form->input($kn.'.page', array('value' => $novel['Novel']['page'], 'label' => __('Page number')));			
								echo '</div>';

								echo '<div class="input file"><label for="Novel'.$kn.'Attachment0Attachment">Change Page Image</label><input type="file" name="data[Novel]['.$kn.'][Attachment][0][attachment]" id="Novel'.$kn.'Attachment0Attachment"></div>';
								echo '<button class="button alert medium-12 small-12 large-12 columns" id="Delete'. $kn .'">delete</button>';
								echo '</fieldset></div>';
								$kn++;
								echo '</li>';
							}

							echo '</ul>';
							echo '<div id="newEn"></div>';
							
							echo '<button href="#" id="newFileNovelEn" class="button medium-12 small-12 large-12 columns">New Page</button>';

							echo '<br><br>';

							echo '<button class="button small" type="submit">'. __('Save Novels') . '</button>';

							echo $this->Form->end();
						?>
					</div>
					<div class="content" id="novel_es">
						<?php 
			
							echo $this->Form->create('Novel', array(
	 					   		'url' => array(
	 					   			'controller' => 'panels',
	 					   			'action' => 'novel', $id, 'edit_mission'
	 					   		),
	 					   		'enctype' => 'multipart/form-data'
							));
							
							echo '<ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">';
							foreach ($novels_es as $nes => $novel) {
								echo '<li>';
								echo '<div id="content' .$kn.'">';
								echo '<fieldset><legend>Page preview</legend>';
								echo $this->Form->hidden($kn.'.mission_id', array('value' => $id));
								echo $this->Form->hidden($kn.'.language', array('value' => 'es'));
								echo $this->Form->hidden($kn.'.id', array('value' => $novel['Novel']['id']));
								echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$novel['Novel']['page_dir'].'/thumb_'.$novel['Novel']['page_attachment'] . '"/>';
								echo '<div style="float:right">';
								echo $this->Form->input($kn.'.page', array('value' => $novel['Novel']['page'], 'label' => __('Page number')));
								echo '</div>';
								echo '<div class="input file"><label for="Novel'.$kn.'Attachment0Attachment">Change Page Image</label><input type="file" name="data[Novel]['.$kn.'][Attachment][0][attachment]" id="Novel'.$kn.'Attachment0Attachment"></div>';
								echo '<button class="button alert medium-12 small-12 large-12 columns" id="Delete'. $kn .'">delete</button>';
								
								echo '</fieldset></div>';
								$kn++;
								echo '</li>';
							}

							echo '</ul>';
							echo '<div id="newEs"></div>';
							echo '<button href="#" id="newFileNovelEn" class="button medium-12 small-12 large-12 columns">New Page</button>';
							

				            echo '<br><br>';

				            echo '<button class="button small" type="submit">'. __('Save Novels') . '</button>';

							echo $this->Form->end();
						?>
					</div>
				</div>

			</div>
		</div>
					
	  </div>
	</div>
  </div>
</div>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');
	echo $this->Html->script('survey'); 
	echo $this->Html->script('quest_attachments');
?>