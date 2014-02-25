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
			<table>				
				<?php foreach ($organizations as $organization) { ?>
					<tr>
						<td><?php echo $this->Html->Link($organization['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['Organization']['id'])); ?></td>
						<td><?php echo $this->Html->Link('edit', array('controller' => 'organizations', 'action' => 'edit', $organization['Organization']['id'])) . " " . $this->Form->PostLink('delete', array('controller' => 'organizations', 'action' => 'delete', $organization['Organization']['id'])); ?></td>
					</tr>
				<?php }	?>
			</table>
		</p>
	</div>
	<div class="content" id="missions">
		<p>
			<?php echo $this->Html->Link('Add new missions!', array('controller' => 'missions', 'action' => 'add')) . " | " . 
				$this->Html->Link('Add new issues!', array('controller' => 'issues', 'action' => 'add'));?>
		</p>
		<p>
			<?php foreach ($issues as $issue) { 
				$issue_missions = $matrix[$issue['Issue']['name']]; ?>

				<table>
					<tr>
						<td><?php echo $issue['Issue']['name']; ?></td>
						<td><?php echo $this->Html->Link('[edit]', array('controller' => 'issues', 'action' => 'edit', $issue['Issue']['id'])) . " " . $this->Form->PostLink('[delete]', array('controller' => 'issues', 'action' => 'delete', $issue['Issue']['id'])); ?></td> 
					</tr>
					<tr>
						<td colspan='3'>
							<table>				
								<?php foreach ($issue_missions as $mission) { ?>
									<tr>
										<td><?php echo $this->Html->Link($mission['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'])); ?></td>
										<td><?php echo $this->Html->Link('[edit]', array('controller' => 'missions', 'action' => 'edit', $mission['Mission']['id'])) . " " . $this->Form->PostLink('[delete]', array('controller' => 'missions', 'action' => 'delete', $mission['Mission']['id'])); ?></td>
									</tr>
								<?php }	?>
							</table>
						</td>
				</table>
			<?php }	?>
		</p>
	</div>
	<div class="content" id="levels">
		<p>Not defined.. levels details go here.</p>
	</div>
	<div class="content" id="badges">
		<p>
			<?php echo $this->Html->Link('Add new badges!', array('controller' => 'badges', 'action' => 'add'));?>
			<table>				
			<?php foreach ($badges as $badge) { ?>
				<tr>
					<td><?php echo $this->Html->Link($badge['Badge']['name'], array('controller' => 'badges', 'action' => 'view', $badge['Badge']['id'])); ?></td>
					<td><?php echo $this->Html->Link('edit', array('controller' => 'badges', 'action' => 'edit', $badge['Badge']['id'])) . " " . $this->Form->PostLink('delete', array('controller' => 'badges', 'action' => 'delete', $badge['Badge']['id'])); ?></td>
				</tr>
			<?php }	?>
			</table>
		</p>
	</div>
	<div class="content" id="estatistics">
		<p>Some estatistics to view..</p>
	</div>
</div>

