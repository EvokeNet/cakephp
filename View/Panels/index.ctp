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
			<li><a href="#">Admin Panel</a></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>


<dl class="tabs" data-tab>
	<dd class="active"><a href="#organizations">Organizations</a></dd>
	<dd><a href="#missions">Missions</a></dd>
	<dd><a href="#levels">Levels</a></dd>
	<dd><a href="#badges">Badges</a></dd>
	<dd><a href="#estatistics">Estatistics</a></dd>
</dl>
<div class="tabs-content">
	<div class="content active" id="organizations">
		<p>
			<?php echo $this->Html->Link('+ organizations', array('controller' => 'organizations', 'action' => 'add'), array( 'class' => 'button'));?>

			<table>				
				<?php foreach ($organizations as $organization) { ?>
					<tr>
						<td><?php echo $this->Html->Link($organization['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['Organization']['id'])); ?></td>
						<td><?php echo $this->Html->Link('edit', array('controller' => 'organizations', 'action' => 'edit', $organization['Organization']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink('delete', array('controller' => 'organizations', 'action' => 'delete', $organization['Organization']['id']), array( 'class' => 'button tiny alert')); ?></td>
					</tr>
				<?php }	?>
			</table>
		</p>
	</div>
	<div class="content" id="missions">
		<form class="left" id="filter">
  			<fieldset>
    			<legend>Filter</legend>
    			<!-- fazer iteração para ter uma checkbox para cada issue e tbm js para mostrar/esconder issues -->
    			<input type="checkbox" id="x"><label for="x">issue teste</label>
    		</fieldset>
		</form>
		<div class="right">
			<p>
				<ul class="button-group">
	  				<li><?php echo $this->Html->Link('+ missions', array('controller' => 'missions', 'action' => 'add'), array( 'class' => 'button'));?></li>
	  				<li><?php echo $this->Html->Link('+ issues', array('controller' => 'issues', 'action' => 'add'), array( 'class' => 'button'));?></li>
	  			</ul>
				 
				<?php foreach ($issues as $issue) { 
					$issue_missions = $matrix[$issue['Issue']['name']]; ?>

					<table>
						<thead>
							<tr>
								<th><?php echo $issue['Issue']['name']; ?></th>
								<th><?php echo $this->Html->Link('edit', array('controller' => 'issues', 'action' => 'edit', $issue['Issue']['id']), array( 'class' => 'button small')) . $this->Form->PostLink('delete', array('controller' => 'issues', 'action' => 'delete', $issue['Issue']['id']), array( 'class' => 'button small alert')); ?></th> 
							</tr>
						</thead>
						<tbody>
							<?php foreach ($issue_missions as $mission) { ?>
								<tr>
									<td><?php echo $this->Html->Link($mission['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'])); ?></td>
									<td><?php echo $this->Html->Link('edit', array('controller' => 'missions', 'action' => 'edit', $mission['Mission']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink('delete', array('controller' => 'missions', 'action' => 'delete', $mission['Mission']['id']), array( 'class' => 'button tiny alert')); ?></td>
								</tr>
							<?php }	?>
						</tbody>
					</table>
				<?php }	?>
			</p>
		</div>
	</div>
	<div class="content" id="levels">
		<p>Not defined.. levels details go here.</p>
	</div>
	<div class="content" id="badges">
		<p>
			<?php echo $this->Html->Link('+ badges', array('controller' => 'badges', 'action' => 'add'), array( 'class' => 'button'));?>
			<table>				
			<?php foreach ($badges as $badge) { ?>
				<tr>
					<td><?php echo $this->Html->Link($badge['Badge']['name'], array('controller' => 'badges', 'action' => 'view', $badge['Badge']['id'])); ?></td>
					<td><?php echo $this->Html->Link('edit', array('controller' => 'badges', 'action' => 'edit', $badge['Badge']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink('delete', array('controller' => 'badges', 'action' => 'delete', $badge['Badge']['id']), array( 'class' => 'button tiny alert')); ?></td>
				</tr>
			<?php }	?>
			</table>
		</p>
	</div>
	<div class="content" id="estatistics">
		<p>Some estatistics to view..</p>
		<p><?php echo "Users: " . sizeof($users);?></p>
		<p><?php echo "Groups: " . sizeof($groups);?></p>
		<p><?php echo "Organizations: " . sizeof($organizations);?></p>
		<p><?php echo "Badges won: "."/".sizeof($badges);?></p>
		<p>AND MORE!</p>
	</div>
</div>

