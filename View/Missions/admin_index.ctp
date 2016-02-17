<?php
  // TOPBAR MENU -->
  $this->start('topbar');
  echo $this->element('topbar');
  $this->end();



  /* Image header */
  $this->start('image_header');
  echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
  $this->end();

  echo $this->Html->css(
    array(
      'evoke',
      'panels',
      'circle'
    )
  );

?>

<div class="row full-width" data-equalizer>

  <?php
    echo $this->element('panel/admin_sidebar');
    $this->end();
  ?>

  <div class="large-10 columns hidden" id="panel-content" data-equalizer-watch>
    <div class="missions index">
      <h2><?php echo __('Missions'); ?></h2>
      <table cellpadding="0" cellspacing="0">
      <tr>
          <th><?php echo $this->Paginator->sort('id'); ?></th>
          <th><?php echo $this->Paginator->sort('title'); ?></th>
          <th><?php echo $this->Paginator->sort('created'); ?></th>
          <th><?php echo $this->Paginator->sort('modified'); ?></th>
          <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
      <?php foreach ($missions as $mission): ?>
      <tr>
        <td><?php echo h($mission['Mission']['id']); ?>&nbsp;</td>
        <td><?php echo h($mission['Mission']['title']); ?>&nbsp;</td>
        <td><?php echo h($mission['Mission']['created']); ?>&nbsp;</td>
        <td><?php echo h($mission['Mission']['modified']); ?>&nbsp;</td>
        <td class="actions">
          <?php echo $this->Html->link(__('View'), array('action' => 'view', $mission['Mission']['id'])); ?>
          <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mission['Mission']['id'])); ?>
          <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mission['Mission']['id']), array(), __('Are you sure you want to delete # %s?', $mission['Mission']['id'])); ?>
        </td>
      </tr>
    <?php endforeach; ?>
      </table>
      <p>
      <?php
      echo $this->Paginator->counter(array(
      'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
      ));
      ?>	</p>
      <div class="paging">
      <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
      ?>
      </div>
    </div>
  </div>
