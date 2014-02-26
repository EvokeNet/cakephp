<div>
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