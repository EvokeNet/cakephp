<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<div style = "padding:1em">

    <div class="panels">
        <div class="panels-heading">
            <div class="panels-heading-btn">
                <a title="" data-original-title="" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" class="font-gray" data-click="panels-expand">
                    <i class="fa fa-plus-circle fa-lg"></i>
                </a>
            </div>
            <h4 class="uppercase font-gray font-weight-bold"><?php echo __('Organizations'); ?></h4>
        </div>
        
	<table cellpadding="0" cellspacing="0" style = "width:100%">
	<thead>
        <tr>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('birthdate'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('website'); ?></th>
                <th><?php echo $this->Paginator->sort('facebook'); ?></th>
                <th><?php echo $this->Paginator->sort('twitter'); ?></th>
                <th><?php echo $this->Paginator->sort('blog'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
	</thead>
	<tbody>
	<?php foreach ($organizations as $organization): ?>
	<tr>
		<td><?php echo h($organization['Organization']['name']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['birthdate']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['description']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['website']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['facebook']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['twitter']); ?>&nbsp;</td>
		<td><?php echo h($organization['Organization']['blog']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $organization['Organization']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $organization['Organization']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $organization['Organization']['id']), array(), __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	</div>

    <div class = "margin-top-2">
        <p class = "left">
            <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Mostrando {:start} a {:end} de {:count} registros') // 'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                ));
            ?>
        </p>
        <div class="paging right">
            <?php
                echo $this->Paginator->prev('< ' . __('Anterior') . ' ', array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(' ' . __('Próximo') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
    </div>
</div>

<?php $this->end(); ?>