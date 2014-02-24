<dl class="tabs" data-tab>
	<dd class="active"><a href="#organizations">Organizations</a></dd>
	<dd><a href="#missions">Missions</a></dd>
	<dd><a href="#badges">Badges</a></dd>
	<dd><a href="#panel2-3">Tab 3</a></dd>
	<dd><a href="#panel2-4">Tab 4</a></dd>
</dl>
<div class="tabs-content">
	<div class="content active" id="organizations">
		<p>
			<table>				
				<?php foreach ($organizations as $organization) { ?>
					<tr>
						<td><?php echo $this->Html->Link($organization['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['Organization']['id'])); ?></td>
					</tr>
				<?php }	?>
			</table>
		</p>
	</div>
	<div class="content" id="missions">
		<p>
			<?php echo $this->Html->Link('Add new missions!', array('controller' => 'missions', 'action' => 'add'));?>
			<table>				
			<?php foreach ($missions as $mission) { ?>
				<tr>
					<td><?php echo $this->Html->Link($mission['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'])); ?></td>
					<td><?php echo $this->Html->Link('edit', array('controller' => 'missions', 'action' => 'edit', $mission['Mission']['id'])) . " " . $this->Form->PostLink('delete', array('controller' => 'missions', 'action' => 'delete', $mission['Mission']['id'])); ?></td>
				</tr>
			<?php }	?>
			</table>
		</p>
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
	<div class="content" id="panel2-3">
		<p>Third panel content goes here...</p>
	</div>
	<div class="content" id="panel2-4">
		<p>Fourth panel content goes here...</p>
	</div>
</div>

