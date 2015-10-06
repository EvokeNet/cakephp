<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<div class="evoke panels contain-to-grid top-bar-background panels-bg">
  <nav class="top-bar row full-width-alternate margin top-05" data-topbar>
    <ul class="title-area">
	    <li class="name">
	      <h1><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><?= ('Evoke') ?></a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right top-bar-background">

	      <li class="active">
	      	<a href="#">
	      		<?php if($user['User']['photo_attachment'] == null) : ?>
					<?php if($user['User']['facebook_id'] == null) : ?>
						<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"   class = "evoke top-bar icon"/>
					<?php else : ?>	
						<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
					<?php endif; ?>
					
	  			<?php else : ?>
	  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
	  			<?php endif; ?>		
	      	</a>
      	  </li>

	      <li class="has-dropdown">
	        <a href="#">
	        	<?php if(isset($user['User'])) :?>
					<span><?= $user['User']['name'] ?></span>
				<?php else :?>
					<span><?= __('Unidentified Agent, please login') ?></span>
				<?php endif; ?>
	        </a>
	        <ul class="dropdown">
	          	<?php if(isset($user['User'])) :?>
					<li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $user['User']['id'])) ?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<?= __('See profile') ?></a></li>
	          		<li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'logout')) ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;<?= __('Sign Out') ?></a></li>
				<?php else :?>
					 <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login')) ?>"><?= __('Log in') ?></a></li>
				<?php endif; ?>

	        </ul>
	      </li>

	      <li class="evoke divider"></li>

	      <li class="has-dropdown">
	        <a href="#"><?= __('Language') ?></a>
	        <ul class="dropdown">
	          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?= __('English') ?></a></li>
	          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?= __('Spanish') ?></a></li>
	        </ul>
	      </li>

	    </ul>
	  </section>
  </nav>
</div>

<?php $this->end(); ?>

<section>

	<div class="evoke row full-width-alternate admin-panel-bg">

	  <div class="small-1 columns no-padding">

	  	<div class = "evoke menu-bg sidebar menucolumn" style = "height: 1500px; background-color:#1f232a">
		  	<dl class="panels tabs vertical" data-tab>

				<dd class="<?php echo $mission_tag ?>" style = "text-align:center"><a href="#mission"><i class="fa fa-clipboard" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Mission Data')) ?></a></dd>

				<?php if(isset($id) && !is_null($id)) : ?>

					<dd class="<?php echo $phases_tag ?>" style = "text-align:center"><a href="#phases"><i class="fa fa-list-alt" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Phases')) ?></a></dd>

					<dd class="<?php echo $dossier_tag ?>" style = "text-align:center"><a href="#dossier"><i class="fa fa-file-text-o" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Mission Dossier')) ?></a></dd>

					<dd class="<?php echo $novel_tag ?>" style = "text-align:center"><a href="#graphic"><i class="fa fa-picture-o" style = "width:100%; margin-bottom:10px"></i><?= strtoupper(__('Graphic Novel')) ?></a></dd>

				<?php endif; ?>

			</dl>

		</div>

	  </div>

	  <div class="small-11 columns no-padding">

	  	<div class="panels tabs-content vertical">

		  	<?php 
				if((empty($phases) || is_null($phases)) && isset($id) && !is_null($id)):?>
					<button class="button general" href="#" data-reveal-id="myModalExit" data-reveal><?php echo __('Return to Admin Panel');?></button>
					<div id="myModalExit" class="reveal-modal tiny" data-reveal>
						<h4><?= __('Are you sure you want to exit to Admin Panel?') ?></h4>
						<p><?= __('Your mission has no Phase and, therefore, will not be displayed to other agents. Please add a Phase to your mission!') ?></p>
						<br><br>
						<?= $this->Html->Link(__('Stay in this page'), array('controller' => 'panels', 'action' => 'add_mission', $id), array( 'class' => 'button small')); ?>
						<?= $this->Html->Link(__('Exit anyway'), array('controller' => 'panels', 'action' => 'index', 'missions'), array( 'class' => 'button small alert')); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				<?php else : ?>

					<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'index', 'missions')); ?>" class = "button general margin top-2 left"><?= strtoupper(__('Return to Admin Index')) ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-reply" style = "float:right; margin-top:5px"></i></a>
			
			<?php endif; ?>

				<div class="content <?php echo $mission_tag ?> content large-10 columns" id="mission">
					
					<div class="form default-content margin top">

						<h3><?= __('Edit Mission') ?></h3>
						<?php 
							echo $this->Form->create('Mission', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'edit_mission', $id
 							   		),
 							   		'enctype' => 'multipart/form-data'
							));
						?>

						<?php
							echo $this->Form->input('Mission.title.eng', array('value' => $mission['missionTitle'][0]['content'], 'label' => __('English Title'), 'required' => true));
							
							echo $this->Form->input('Mission.title.spa', array('value' => $mission['missionTitle'][1]['content'], 'label' => __('Spanish Title')));

							echo $this->Form->input('Mission.description.eng', array('value' => $mission['missionDescription'][0]['content'], 'label' => __('English Description'), 'required' => true));
							
							echo $this->Form->input('Mission.description.spa', array('value' => $mission['missionDescription'][1]['content'], 'label' => __('Spanish Description')));

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
				</div>

				<div class="content <?php echo $phases_tag ?> large-10 columns margin top" id="phases">
					
					<a class="button general" href="#" data-reveal-id="myModalPhase" data-reveal><?php echo __('Add a Phase');?></a>

					<div id="myModalPhase" class="phases form reveal-modal tiny" data-reveal>
						<?php 
							echo $this->Form->create('Phase', array(
						   		'url' => array(
						   			'controller' => 'panels',
						   			'action' => 'add_phase', 
						   			$id
						   		))); 
				   		?>
						<?php echo __('Add a Phase'); ?>
						<?php
							echo $this->Form->input('Phase.name.eng', array('label' => __('English Title'), 'required' => true));
							echo $this->Form->input('Phase.name.spa', array('label' => __('Spanish Title')));
							echo $this->Form->input('Phase.description.eng', array('label' => __('English Description'), 'required' => true));
							echo $this->Form->input('Phase.description.spa', array('label' => __('Spanish Description')));

							echo $this->Form->input('points', array('label' => __('Points'), 'required' => true));
							echo $this->Form->hidden('mission_id', array('value' => $id));
							echo $this->Form->radio('type', array($phase_types_array), array('required' => true));
							echo $this->Form->radio('show_dossier', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => 1));
							echo $this->Form->hidden('form_type', array('value' => 'phase'));
							echo $this->Form->input('position', array('required' => true));
						?>
							
						<button class="button small" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>

					<?php if(empty($phases)) :
							echo '<h4>' . __('Your mission will not be accessible until it has at least one phase.') . '</h4>';
						else :
							foreach ($phases as $phase) : ?>
							<table class="table table-hovered table-bordered table-condensed">
								<thead>
									<tr class="sort">
										<th>
											<?= $phase['Phase']['name'] ?>
										</th>
										<th style="text-align:right">
					  						<a href="#" data-reveal-id="myModalPhase" data-reveal><i class="fa fa-plus"></i></a>&nbsp;&nbsp;
					  						<a href="#" data-reveal-id="myModalEditPhase-<?= $phase['Phase']['id'] ?>" data-reveal><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
					  						<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'delete_phase', $id, $phase['Phase']['id'], 'add_mission'), array('id' => 'deletePhases'. $phase['Phase']['id'], 'style' => 'display:none'));?>

    										<a href="#" onclick="document.getElementById('deletePhases<?php echo $phase['Phase']['id']; ?>').click();" ><i class="fa fa-times-circle"></i></a>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach ($phase['Quest'] as $quest): ?>
											
										<tr>
											<td colspan="2">
											<?php echo $this->Html->Link($quest['title'], array('controller' => 'panels', 'action' => 'quest', $phase['Phase']['id'], $id, $quest['id']), array('class' => 'name')); ?>
											</td>
										</tr>
										
									<?php endforeach; ?>

									<tr>
										<td colspan="2">
											<a href="#" class = "button general" data-reveal-id="myModalQuest" onclick="document.getElementById('phase').setAttribute('value', '<?php echo $phase['Phase']['id']; ?>')" data-reveal><?php echo __('Add a Quest');?></a> 
										</td>
									</tr>
								</tbody>
							</table>
							<br>

							<div id="myModalEditPhase-<?= $phase['Phase']['id'] ?>" class="phases form reveal-modal tiny" data-reveal>
								
								<?php echo $this->Form->create('Phase', array(
	 							   		'url' => array(
	 							   			'controller' => 'panels',
	 							   			'action' => 'edit_phase', 
	 							   			$phase['Phase']['id'],
	 							   			$id
						   		))); ?>
									
								<?php echo __('Edit Phase'); ?>

								<?php
									
									echo $this->Form->input('Phase.name.eng', array('value' => $phase['phaseName'][0]['content'], 'label' => __('English Title'), 'required' => true));

									echo $this->Form->input('Phase.name.spa', array('value' => $phase['phaseName'][1]['content'], 'label' => __('Spanish Title')));

									echo $this->Form->input('Phase.description.eng', array('value' => $phase['phaseDescription'][0]['content'], 'label' => __('English Description'), 'required' => true));
									
									echo $this->Form->input('Phase.description.spa', array('value' => $phase['phaseDescription'][1]['content'], 'label' => __('Spanish Description')));

									echo $this->Form->input('points', array('label' => __('Points'), 'value' => $phase['Phase']['points'], 'required' => true));
									echo $this->Form->hidden('mission_id', array('value' => $id));
									echo $this->Form->radio('type', array($phase_types_array), array('value' => $phase['Phase']['type'], 'required' => true));
									echo $this->Form->radio('show_dossier', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => 1, 'value' => $phase['Phase']['show_dossier']));
									echo $this->Form->hidden('form_type', array('value' => 'phase'));
									echo $this->Form->input('position', array('value' => $phase['Phase']['position'], 'required' => true));
								?>

								<?php echo $this->Form->end(array('label' => 'Save Changes', 'class' => 'button general')); ?>
								<a class="close-reveal-modal">&#215;</a>
							</div>

					<?php endforeach; ?>
					<?php endif; ?>

					<!-- Lightbox for adding quest to phase form -->
					<div id="myModalQuest" class="reveal-modal tiny" data-reveal>
						<?php 
							echo $this->element('add_quest', array('mission_id' => $id, 'origin' => 'edit_mission'));
						?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				</div>
				<div class="content <?php echo $dossier_tag ?> statistics margin top-2" id="dossier">
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
				<div class="content <?php echo $novel_tag ?> statistics" id="graphic">
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

</section>
    <!-- necessary function to add remove the already existing questions -->
    <script type="text/javascript">
    	<?php 
        	$i = 0;
	        for($i=0; $i<$k;$i++) {
	            echo "$('#-". $i ."').click(function() {
	                var attId = $('#Attachmentprev-". $i ."Id').val().replace('NO-', '');
	                $('#img-". $i ."').remove();
	                $('#label-". $i ."').remove();
	                $('#Attachmentprev-". $i ."Id').val(attId);
	                $('#-". $i ."').remove();
	                return false;
	        	    });";
        	}

        	foreach ($dossier_links as $link) {
        		echo "$('#deleteLink-". $link['DossierLink']['id'] ."').click(function() {
	                	$('#linkContent-".$link['DossierLink']['id']."').hide();
	                	$('#linkContent-".$link['DossierLink']['id']."').append('". '<input name="data[DossierLink]['.$link['DossierLink']['id'].'][delete]" value="1" >' . "');
	                	return false;
	        	    });";
        	}

        	foreach ($dossier_videos as $video) {
        		echo "$('#deleteVideo-". $video['DossierVideo']['id'] ."').click(function() {
	                	$('#videoContent-".$video['DossierVideo']['id']."').hide();
	                	$('#videoContent-".$video['DossierVideo']['id']."').append('". '<input name="data[DossierVideo]['.$video['DossierVideo']['id'].'][delete]" value="1" >' . "');
	                	return false;
	        	    });";
        	}

        	$i = 0;
	        for($i=0; $i<$kn;$i++) {
	            echo "$('#Delete". $i ."').click(function() {
	                	$('#content".$i."').hide();
	                	$('#content".$i."').append('". '<input name="data[Novel]['. $i.'][delete]" value="1" >' . "');
	                	return false;
	        	    });";
        	}

        	echo 'var prox = '. $i.';';
        ?>

        $("#newFileNovelEn").click(function() {
	        $('#newEn').append('<div id="content'+prox+'"> <input type="hidden" name="data[Novel]['+prox+'][mission_id]" value="<?=$id?>" id="Novel'+prox+'MissionId"><input type="hidden" name="data[Novel]['+prox+'][language]" value="en" id="Novel'+prox+'Language"><div class="input number"><label for="Novel'+prox+'Page">Page number</label><input name="data[Novel]['+prox+'][page]" type="number" id="Novel'+prox+'Page"></div><div class="input file"><label for="Novel'+prox+'Attachment0Attachment">Image</label><input type="file" name="data[Novel]['+prox+'][Attachment][0][attachment]" id="Novel'+prox+'Attachment0Attachment"></div></div>');
	        prox++;
	        return false;
	    });

        $("#newFileNovelEs").click(function() {
	        $('#newEs').append('<div id="content'+prox+'"> <input type="hidden" name="data[Novel]['+prox+'][mission_id]" value="<?=$id?>" id="Novel'+prox+'MissionId"><input type="hidden" name="data[Novel]['+prox+'][language]" value="es" id="Novel'+prox+'Language"><div class="input number"><label for="Novel'+prox+'Page">Page number</label><input name="data[Novel]['+prox+'][page]" type="number" id="Novel'+prox+'Page"></div><div class="input file"><label for="Novel'+prox+'Attachment0Attachment">Image</label><input type="file" name="data[Novel]['+prox+'][Attachment][0][attachment]" id="Novel'+prox+'Attachment0Attachment"></div></div>');
	        prox++;
	        return false;
	    });

    </script>