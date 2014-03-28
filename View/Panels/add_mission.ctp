<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $username[0]; ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#"><?= __('Settings') ?></a>
				<ul class="dropdown">
					<li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $userid)); ?></li>
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $userid)); ?></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>


<section class="evoke margin top-2">
	<div class="row evoke max-width">
		<div class="large-12 columns">
			<h1><?= __('Creating Mission')?><?php if(isset($id) && !is_null($id)) : echo ': ' . $mission['Mission']['title']; endif;?></h1>
			<dl class="tabs" data-tab>
				<dd class="<?php echo $mission_tag ?>"><a href="#mission"><?= __('Mission Data') ?></a></dd>
				<dd class="<?php echo $phases_tag ?>"><a href="#phases"><?= __('Phases') ?></a></dd>
				<dd class="<?php echo $dossier_tag ?>"><a href="#dossier"><?= __('Mission Dossier') ?></a></dd>
				<dd class="<?php echo $badges_tag ?>"><a href="#badges"><?= __('Badges') ?></a></dd>
				<dd class="<?php echo $points_tag ?>"><a href="#points"><?= __('Points') ?></a></dd>
			</dl>
			<div class="tabs-content">
				<div class="content <?php echo $mission_tag ?> content large-10 columns" id="mission">
					<div class="form">

						<?php 
							if(isset($id) && !is_null($id)) {
								echo $this->Form->create('Mission', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_mission', $id
 							   		),
									'enctype' => 'multipart/form-data'					
								));
							} else {
								echo $this->Form->create('Mission', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_mission'
 							   		),
 							   		'enctype' => 'multipart/form-data'
								));
							} 
						?>
						<fieldset>
							<?php
								if(isset($id) && !is_null($id)) {
									echo '<legend>' . __('Edit Mission') .'</legend>'; 
									echo $this->Form->input('title', array('value' => $mission['Mission']['title'], 'label' => __('Title')));
									echo $this->Form->input('description', array('value' => $mission['Mission']['description'], 'label' => __('Description')));
									if(!is_null($mission_img)) :
										echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission_img[0]['Attachment']['dir'].'/thumb_'.$mission_img[0]['Attachment']['attachment'] . '"/>';
										echo '<div class="input file"><label for="Attachment0Attachment">Change Image</label><input type="file" name="data[Attachment][0][attachment]" id="Attachment0Attachment"></div>';
									else :
										echo '<div class="input file"><label for="Attachment0Attachment">Image</label><input type="file" name="data[Attachment][0][attachment]" id="Attachment0Attachment"></div>';
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
								} else {
									echo '<legend>'. __('Add a Mission') . '</legend>'; 
									echo $this->Form->input('title', array('label' => __('Title')));
									echo $this->Form->input('description', array('label' => __('Description')));
									echo '<div class="input file"><label for="Attachment0Attachment">Image</label><input type="file" name="data[Attachment][0][attachment]" id="Attachment0Attachment"></div>';
									echo $this->Form->hidden('form_type', array('value' => 'mission'));
									echo $this->Form->input('MissionIssue.issue_id', array(
            							'options' => $issues
            						));
            						echo $this->Form->input('organization_id', array(
											'label' => __('Created by'),
											'options' => $organizations
									));
								}
							?>
						</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Save and continue') ?>
						</button>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
				<div class="content <?php echo $phases_tag ?> large-10 columns" id="phases">
					<div class="phases form">
						<?php echo $this->Form->create('Phase', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_phase', $id)
									)
								); ?>
							<fieldset>
								<legend><?php echo __('Add a Phase'); ?></legend>
							<?php
								echo $this->Form->input('name', array('label' => __('Name')));
								echo $this->Form->input('description', array('label' => __('Description')));
								echo $this->Form->hidden('mission_id', array('value' => $id));
								echo $this->Form->hidden('form_type', array('value' => 'phase'));
								echo $this->Form->input('position');
							?>
							</fieldset>
							<button class="button small" type="submit">
								<?php echo __('Add') ?>
							</button>
							<?php echo $this->Form->end(); ?>
							<button class="button secondary small">
								<?php echo $this->Html->Link(__('Back'), array('controller' => 'panels', 'action' => 'add_mission', $id, 'mission')); ?>
							</button>
					</div>
					<?php 
					foreach ($phases as $phase) { ?>

							<table class="large-8 columns">
								<thead>
									<tr>
										<td>
											<?php echo __('Phase') . ': ' . $phase['Phase']['name'];?>
										</td>
										<td>
											<!-- lightbox to add quest to certain phase -->
				  							<a href="#" data-reveal-id="myModalQuest-<?php echo $phase['Phase']['id']; ?>" data-reveal><?php echo __('Add a Quest');?></a> | <?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'delete_phase', $id, $phase['Phase']['id'], 'add_mission'));?>
										</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="2">
											<!-- list the already existing quests under this phase -->
											<?php 
												foreach ($phase['Quest'] as $quest) { 
													echo $this->Html->Link('['.$quest['title'].'] ', array('controller' => 'panels', 'action' => 'quest', $phase['Phase']['id'], $id, $quest['id']));
												}	
											?>
										</td>
									</tr>
								</tbody>
							</table>

							<!-- Lightbox for adding quest to phase form -->
							<div id="myModalQuest-<?php echo $phase['Phase']['id']; ?>" class="reveal-modal tiny" data-reveal>
								<?php 
									echo $this->element('add_quest', array('phase_id' => $phase['Phase']['id'], 'mission_id' => $id));
								?>
								<a class="close-reveal-modal">&#215;</a>
							</div>


					<?php }?>

				</div>
				<div class="content <?php echo $dossier_tag ?>" id="dossier">
					<h4>
						<?= __('Create a dossier by adding files that might be useful for agents to complete this mission!') ?>

					</h4>
				</div>
				<div class="content <?php echo $badges_tag ?>" id="badges">
					<p>
						badges related to the mission
					</p>
				</div>
				<div class="content <?php echo $points_tag ?>" id="points">
					<p>
						Point distribution for the mission
					</p>
				</div>
			</div>
			<!-- encerrar tudo -->
			<?php echo $this->Html->Link(__('Return to Admin Panel'), array('controller' => 'panels', 'action' => 'index'), array( 'class' => 'button small')); ?>	
		</div>
	</div>
</section>