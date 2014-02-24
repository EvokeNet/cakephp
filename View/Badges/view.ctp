<div class="badges view">
<h2><?php echo __('Badge'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trigger'); ?></dt>
		<dd>
			<?php echo h($badge['Badge']['trigger']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Badge'), array('action' => 'edit', $badge['Badge']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Badge'), array('action' => 'delete', $badge['Badge']['id']), null, __('Are you sure you want to delete # %s?', $badge['Badge']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Badges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Badge'), array('action' => 'add')); ?> </li>
	</ul>
</div>
