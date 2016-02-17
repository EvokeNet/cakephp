<?php
	// TOPBAR MENU -->
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
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
		<div class="powers">
		<h2><?php echo __('Power'); ?></h2>
			<dl>
				<dt><?php echo __('Id'); ?></dt>
				<dd>
					<?php echo h($power['Power']['id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Name'); ?></dt>
				<dd>
					<?php echo h($power['Power']['name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Description'); ?></dt>
				<dd>
					<?php echo h($power['Power']['description']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Edit Power'), array('action' => 'edit', $power['Power']['id'])); ?> </li>
				<li><?php echo $this->Form->postLink(__('Delete Power'), array('action' => 'delete', $power['Power']['id']), array(), __('Are you sure you want to delete # %s?', $power['Power']['id'])); ?> </li>
				<li><?php echo $this->Html->link(__('List Powers'), array('action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Power'), array('action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>	
</div>