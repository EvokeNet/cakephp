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
			<dl class="tabs" data-tab>
				<dd class="active"><a href="#organizations">Organizations</a></dd>
				<dd><a href="#missions">Missions</a></dd>
				<dd><a href="#levels">Levels</a></dd>
				<dd><a href="#badges">Badges</a></dd>
				<dd><a href="#users">Users</a></dd>
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
				<div class="content large-12 columns" id="missions">
					<div class="large-4 columns filter">
			  			<fieldset>
			    			<legend>Issues</legend>
			    			 <ul id="filters">
			    			 	<?php foreach ($issues as $issue) { ?>
							    	<li>
							        	<input type="checkbox" checked="true" value="issue_<?php echo $issue['Issue']['id'];?>" id="filter-issue_<?php echo $issue['Issue']['id'];?>" />
							        	<label for="filter-issue_<?php echo $issue['Issue']['id'];?>">
							        		<?php echo $issue['Issue']['name'];?>
							        	</label>
							    	</li>
							    <?php } ?>
							</ul>
						</fieldset>
					</div>
					<div class="large-5 columns filteredContent">
						<ul class="button-group">
				  			<li><?php echo $this->Html->Link('+ missions', array('controller' => 'missions', 'action' => 'add'), array( 'class' => 'button'));?></li>
				  			<li><?php echo $this->Html->Link('+ issues', array('controller' => 'issues', 'action' => 'add'), array( 'class' => 'button'));?></li>
				  		</ul>
				  		<table>
					  		<?php foreach ($missions_issues as $mi) { ?>
					  			<!-- colocar paginação -->
								<tr class="<?php foreach ($mi['MissionIssue'] as $i) echo ' issue_'.$i['issue_id'];?>">
									<td><?php echo $this->Html->Link($mi['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $mi['Mission']['id'])); ?></td>
									<td><?php echo $this->Html->Link('edit', array('controller' => 'missions', 'action' => 'edit', $mi['Mission']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink('delete', array('controller' => 'missions', 'action' => 'delete', $mi['Mission']['id']), array( 'class' => 'button tiny alert')); ?></td>
								</tr>
							<?php }?>	
						</table>
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
				<div class="content" id="users">
					<div class="large-4 columns filter">
			  			<fieldset>
			    			<legend>Roles</legend>
			    			 <ul id="filters2">
			    			 	<?php foreach ($roles as $role) { ?>
							    	<li>
							        	<input type="checkbox" checked="true" value="role_<?php echo $role['Role']['id'];?>" id="filter-role_<?php echo $role['Role']['id'];?>" />
							        	<label for="filter-role_<?php echo $role['Role']['id'];?>">
							        		<?php echo $role['Role']['name'];?>
							        	</label>
							    	</li>
							    <?php } ?>
							</ul>
						</fieldset>
					</div>
					<div class="large-5 columns filteredContent">
						<table>
							<!-- colocar paginação -->
							<?php foreach ($users as $user) { ?>
								<tr class="role_<?php echo $user['User']['role_id'];?> ">
									<td><?php echo $this->Html->Link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?></td>
								</tr>
							<?php }	?>
						</table>
					</div>
				</div>
				<div class="content" id="estatistics">
					<p>Some estatistics to view..</p>
					<p><?php echo "Users: " . sizeof($users);?></p>
					<p><?php echo "Groups: " . sizeof($groups);?></p>
					<p><?php echo "Organizations: " . sizeof($organizations);?></p>
					<p><?php echo "Badges: ".sizeof($badges);?></p>
					<p>AND MORE!</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- issues & roles' filtering script -->
<script type="text/javascript">
	$("#filters :checkbox").click(function() {
	   	$("#filters :checkbox").each(function() {
	       	if($(this).is(':checked')) {
	            $("." + $(this).val()).fadeTo("slow", 1);
			} else {
	            $("." + $(this).val()).hide();
	        }
	 	});
	});

	$("#filters2 :checkbox").click(function() {
	   	$("#filters2 :checkbox").each(function() {
	       	if($(this).is(':checked')) {
	            $("." + $(this).val()).fadeTo("slow", 1);
			} else {
	            $("." + $(this).val()).hide();
	        }
	 	});
	});
</script>