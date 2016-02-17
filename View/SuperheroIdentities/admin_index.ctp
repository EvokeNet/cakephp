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
            <h4 class="uppercase font-gray font-weight-bold"><?php echo __('Superhero Identities'); ?></h4>
        </div>
        <table cellpadding="0" cellspacing="0" class="table table-td-valign-middle" style = "width:100%">
            <thead>
							<th><?php echo $this->Paginator->sort('name'); ?></th>
							<th><?php echo $this->Paginator->sort('quality_1'); ?></th>
							<th><?php echo $this->Paginator->sort('quality_2'); ?></th>
							<th><?php echo $this->Paginator->sort('primary_power'); ?></th>
							<th><?php echo $this->Paginator->sort('secondary_power'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
            </thead>
						<?php foreach ($superheroIdentities as $superheroIdentity): ?>
							<tr>
								<td><?php echo h($superheroIdentity['SuperheroIdentity']['name']); ?>&nbsp;</td>
								<td>
									<?php echo $this->Html->link($superheroIdentity['Quality1']['name'], array('controller' => 'SocialInnovatorQualities', 'action' => 'view', $superheroIdentity['Quality1']['id'])); ?>
								</td>
								<td>
									<?php echo $this->Html->link($superheroIdentity['Quality2']['name'], array('controller' => 'SocialInnovatorQualities', 'action' => 'view', $superheroIdentity['Quality2']['id'])); ?>
								</td>
								<td>
									<?php echo $this->Html->link($superheroIdentity['Power1']['name'], array('controller' => 'powers', 'action' => 'view', $superheroIdentity['Power1']['id'])); ?>
								</td>
								<td>
									<?php echo $this->Html->link($superheroIdentity['Power2']['name'], array('controller' => 'powers', 'action' => 'view', $superheroIdentity['Power2']['id'])); ?>
								</td>
								<td class="actions">
									<?php echo $this->Html->link(__('View'), array('action' => 'view', $superheroIdentity['SuperheroIdentity']['id'])); ?>
									<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $superheroIdentity['SuperheroIdentity']['id'])); ?>
									<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $superheroIdentity['SuperheroIdentity']['id']), array(), __('Are you sure you want to delete # %s?', $superheroIdentity['SuperheroIdentity']['id'])); ?>
								</td>
							</tr>
						<?php endforeach; ?>
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
