<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Agent <?php echo $username[0]; ?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">Sign out</a></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><a href="#">Dashboard</a></li>
		</ul>
	</section>
</nav>

<?php $this->end();?>

<section class="evoke margin top-2">
	<div class="row evoke max-width">
		<div class="large-12 columns">
			<h1>Creating Mission: <?php if(isset($id) && !is_null($id)) : echo $mission['Mission']['title']; endif;?></h1>
			<dl class="tabs" data-tab>
				<dd class="<?php echo $mission_tag ?>"><a href="#mission">Mission form</a></dd>
				<dd class="<?php echo $phases_tag ?>"><a href="#phases">Phases</a></dd>
				<dd class="<?php echo $badges_tag ?>"><a href="#badges">Badges</a></dd>
				<dd class="<?php echo $points_tag ?>"><a href="#points">Points</a></dd>
			</dl>
			<div class="tabs-content">
				<div class="content active content large-10 columns" id="mission">
					<div class="form">

						<?php 
							if(isset($id) && !is_null($id)) {
								echo $this->Form->create('Mission', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_mission', $id)
									)
								);
							} else {
								echo $this->Form->create('Mission', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_mission')
									)
								);
							} 
						?>
						<fieldset>
							<?php
								if(isset($id) && !is_null($id)) {
									echo '<legend> Edit Mission </legend>'; 
									echo $this->Form->input('title', array('value' => $mission['Mission']['title']));
									echo $this->Form->input('description', array('value' => $mission['Mission']['description']));
									echo $this->Form->input('image');
									echo $this->Form->hidden('form_type', array('value' => 'mission'));
									if(isset($mission['MissionIssue'][0]['issue_id'])) {
										echo $this->Form->input('MissionIssue.issue_id', array(
            								'options' => $issues,
            								'value' => $mission['MissionIssue'][0]['issue_id'] //as we are, for now, restricting the amount of issues per mission to 1
            							));
									} else {
										echo $this->Form->input('MissionIssue.issue_id', array(
            								'options' => $issues,
            								'value' => $mission['MissionIssue']['issue_id'] //as we are, for now, restricting the amount of issues per mission to 1
            							));
									}
								} else {
									echo '<legend> Add Mission </legend>'; 
									echo $this->Form->input('title');
									echo $this->Form->input('description');
									echo $this->Form->input('image');
									echo $this->Form->hidden('form_type', array('value' => 'mission'));
									echo $this->Form->input('MissionIssue.issue_id', array(
            							'options' => $issues
            						));
								}
							?>
						</fieldset>
						<?php echo $this->Form->end('save & next >>'); ?>
					</div>
				</div>
				<div class="content large-10 columns" id="phases">
					<div class="phases form">
						<?php echo $this->Form->create('Phase', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_phase', $id)
									)
								); ?>
							<fieldset>
								<legend><?php echo __('Add Phase'); ?></legend>
							<?php
								echo $this->Form->input('name');
								echo $this->Form->input('description');
								echo $this->Form->hidden('mission_id', array('value' => $id));
								echo $this->Form->hidden('form_type', array('value' => 'phase'));
								echo $this->Form->input('position');
							?>
							</fieldset>
						<?php 
							echo $this->Form->end(__('save & next >>')); 
							echo $this->Form->submit('<< back');

						?>
					</div>

					<table>
						<?php foreach ($phases as $phase) { ?>
							<tr>
								<td>
									<?php echo $phase['Phase']['name']; ?>
								</td>
							</tr>
						<?php }?>
					</table>

				</div>
				<div class="content" id="badges">
					<p>
						badges related to the mission
					</p>
				</div>
				<div class="content" id="points">
					<p>
						Point distribution for the mission
					</p>
				</div>
			</div>
			<!-- encerrar tudo -->
			<?php echo $this->Form->submit('save & quit'); ?>
		</div>
	</div>
</section>
