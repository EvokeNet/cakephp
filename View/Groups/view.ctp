<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Group: '.$group['title'], 'imgSrc' => ($this->webroot.'img/header-leaderboard.jpg')));
	$this->end();

	/* Paginator */
	$paginatorParams = $this->Paginator->params();
?>

<section class="group">
	<div class="row standard-width margin top-2">
		<!-- GROUP BOX -->
		<div class="margin top-3 bottom-3">
			<?php echo $this->element('Groups/group_box',array('group' => $group, 'show_title' => false)); ?>
		</div>

		<!-- GROUP INFO -->
		<div class="small-5 medium-4 large-2 columns">
			<h5 class="text-color-highlight"><?= __('Team leader');?></h5>
			<p><?= $groupOwner['name'] ?></p>

			<h5 class="text-color-highlight"><?= __('Members');?></h5>
			<p><?= count($groupsUsers) ?></p>

			<h5 class="text-color-highlight"><?= __('Mission');?></h5>
			<p><?= $groupMission['title'] ?></p>
		</div>

		<!-- LIST OF MEMBERS -->	
		<div class="small-7 medium-8 large-10 columns">
			<h4 class="text-color-highlight"><?= strtoupper(__('Members')) ?></h4>

			<?php echo $this->element('Groups/member_list',array('group' => $group, 'show_title' => false)); ?>

			<?php
			//OWNER CAN SEE REQUESTS
			if ($group['is_owner']): ?>
				<div class="margin top-2">
					<h4 class="text-color-highlight"><?= strtoupper(__('Requests')) ?></h4>

					<?php echo $this->element('Groups/request_tabs',array('group' => $group, 'show_title' => false)); ?>
				</div> <?php
			endif; ?>

		</div>
	</div>
</section>


<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>