<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $userid)); ?>"><?= strtoupper(__('Evoke')) ?></a></h1>
		</li>
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
		
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="evoke right">

			<li class = "name">
				<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $userid)); ?>" class = "evoke top-bar-name"><?= $username[0] ?></a></h3>
			</li>

			<li class="evoke divider"></li>

			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>

			<li class="evoke divider"></li>
			
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $userid)); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>

		</ul>
		
		<ul class="evoke left">
			<li class="name">
				<?php if(isset($id) && !is_null($id)) : ?>
					<h3><a href="#" class="evoke top-bar-name"><?php echo sprintf(__("Evoke's Mission Panel")) . ': ' . $mission['Mission']['title'];?></a></h3>
				<?php else :?>
					<h3><a href="#" class="evoke top-bar-name"><?php echo sprintf(__("Evoke's Mission Panel"));?></a></h3>
				<?php endif; ?>
			</li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>


<section class="evoke margin top-2">
	<div class="row evoke max-width">
		<div class="small-12 medium-12 large-12 columns">
			<!-- <h1><?= __('Creating Mission')?><?php if(isset($id) && !is_null($id)) : echo ': ' . $mission['Mission']['title']; endif;?></h1> -->
			<dl class="tabs" data-tab>
				<dd class="<?php echo $mission_tag ?>"><a href="#mission"><?= __('Mission Data') ?></a></dd>
				<?php if(isset($id) && !is_null($id)) : ?>
					<dd class="<?php echo $phases_tag ?>"><a href="#phases"><?= __('Phases') ?></a></dd>
					<dd class="<?php echo $dossier_tag ?>"><a href="#dossier"><?= __('Mission Dossier') ?></a></dd>
					<dd class="<?php echo $badges_tag ?>"><a href="#badges"><?= __('Badges') ?></a></dd>
					<dd class="<?php echo $points_tag ?>"><a href="#points"><?= __('Points') ?></a></dd>
				<?php endif; ?>
			</dl>
			<div class="tabs-content">
				<div class="content <?php echo $mission_tag ?> large-10 columns" id="mission">
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
									echo $this->Form->input('title', array('value' => $mission['Mission']['title'], 'label' => __('Title'), 'required' => true));
									echo $this->Form->input('description', array('value' => $mission['Mission']['description'], 'label' => __('Description'), 'required' => true));
									echo $this->Form->radio(__('Basic Training'), array(0 => 'No', 1=>'Yes'), array('required' => true, 'default'=>$mission['Mission']['basic_training']));
									if(!is_null($mission_img) && !empty($mission_img)) :
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
									echo $this->Form->input('title', array('label' => __('Title'), 'required' => true));
									echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
									echo $this->Form->radio('basic_training', array(0 => 'No', 1=>'Yes'), array('required' => true, 'default'=> 0));
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
					<div class="small-9 medium-9 large-9 columns">
						<?php if(empty($phases)) :
							echo '<h4>' . __('Your mission will not be accessible until it has at least one phase.') . '</h4>';
						else :
							foreach ($phases as $phase) : ?>
							<table class="table table-hovered table-bordered table-condensed">
								<thead>
									<tr>
										<td>
											<?php echo $phase['Phase']['name']. ': ';?>
										</td>
										<td style="text-align:right">
											<!-- lightbox to add quest to certain phase -->
					  						<a href="#" data-reveal-id="myModalQuest" onclick="document.getElementById('phase').setAttribute('value', '<?php echo $phase['Phase']['id']; ?>')" data-reveal><?php echo __('Add a Quest');?></a> | <?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'delete_phase', $id, $phase['Phase']['id'], 'add_mission'));?>
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
							<br>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="small-9 medium-9 large-9 columns">
						<button class="button small" href="#" data-reveal-id="myModalPhase" data-reveal><?php echo __('Add a Phase');?></button>
						<!-- <button class="button secondary small">
							<?php echo $this->Html->Link(__('Back'), array('controller' => 'panels', 'action' => 'add_mission', $id, 'mission')); ?>
						</button> -->		
					</div>
					<div id="myModalPhase" class="phases form reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('Phase', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_phase', $id)
									)
								); ?>
							<fieldset>
								<legend><?php echo __('Add a Phase'); ?></legend>
							<?php
								echo $this->Form->input('name', array('label' => __('Name'), 'required' => true));
								echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
								echo $this->Form->input('points', array('label' => __('Points'), 'required' => true));
								echo $this->Form->hidden('mission_id', array('value' => $id));
								echo $this->Form->hidden('form_type', array('value' => 'phase'));
								echo $this->Form->radio('type', array(0 => 'Discussion', 1 => 'Project'), array('required' => true));
								echo $this->Form->radio('show_dossier', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => 1));
								echo $this->Form->input('position', array('required' => true));
							?>
							</fieldset>
							<button class="button small" type="submit">
								<?php echo __('Add') ?>
							</button>
							<?php echo $this->Form->end(); ?>
							<a class="close-reveal-modal">&#215;</a>
					</div>

					<!-- Lightbox for adding quest to phase form -->
					<div id="myModalQuest" class="reveal-modal tiny" data-reveal>
						<?php 
							echo $this->element('add_quest', array('mission_id' => $id, 'powerpoints' => $powerpoints));
						?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				</div>
				<div class="content <?php echo $dossier_tag ?>" id="dossier">
					<h4>
						<?= __('Create a dossier by adding files that might be useful for agents to complete this mission!') ?>
					</h4>
					<?php 
						if(!empty($dossier) && !is_null($dossier)) {
						
							echo $this->Form->create('Dossier', array(
	 						   		'url' => array(
	 						   			'controller' => 'panels',
	 						   			'action' => 'dossier', $id, $dossier['Dossier']['id'] 
	 						   		),
	 						   		'enctype' => 'multipart/form-data'
							));
						} else {
							echo $this->Form->create('Dossier', array(
	 						   		'url' => array(
	 						   			'controller' => 'panels',
	 						   			'action' => 'dossier', $id
	 						   		),
	 						   		'enctype' => 'multipart/form-data'
							));
						}
						echo $this->Form->hidden('mission_id', array('value' => $id));
						if(!empty($dossier) && !is_null($dossier)) {
							echo $this->Form->hidden('id', array('value' => $dossier['Dossier']['id']));
						}

						echo "<label>".__('Attachments'). "</label>";
			            echo '<div id="fileInputHolderD">';
			            echo "<ul>";

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
			<?php 
				if((empty($phases) || is_null($phases)) && isset($id) && !is_null($id)):?>
					<button class="button small" href="#" data-reveal-id="myModalExit" data-reveal><?php echo __('Return to Admin Panel');?></button>
					<div id="myModalExit" class="reveal-modal tiny" data-reveal>
						<h4><?= __('Are you sure you want to exit to Admin Panel?') ?></h4>
						<p><?= __('Your mission has no Phase and, therefore, will not be displayed to other agents. Please add a Phase to your mission!') ?></p>
						<br><br>
						<?= $this->Html->Link(__('Stay in this page'), array('controller' => 'panels', 'action' => 'add_mission', $id), array( 'class' => 'button small')); ?>
						<?= $this->Html->Link(__('Exit anyway'), array('controller' => 'panels', 'action' => 'index', 'missions'), array( 'class' => 'button small alert')); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				<?php else :
					echo $this->Html->Link(__('Return to Admin Panel'), array('controller' => 'panels', 'action' => 'index', 'missions'), array( 'class' => 'button small')); 
				endif; ?>
		</div>
	</div>
</section>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	echo $this->Html->script('dossier_attachments'); 
?>

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
        ?>
    </script>