<div class="row full-width">

	<h3><?= strtoupper(__('Groups')) ?></h3>

	<h3><?= strtoupper(sprintf(__('Mission: %s'), $mission['Mission']['title'])) ?></h3>

	<?php if(isset($mission['Mission'])): ?>
		<div>
			<a class="button" href="" data-reveal-id="newGroup" data-reveal>
				<span><?php echo __('Create a group');?></span>
			</a>
		</div>
		<div id="newGroup" class="reveal-modal large lightbox" data-reveal>
			<?= $this->element('add_group', array('mission' => $mission, 'quest_id' => $quest_id, 'userid' => $user['User']['id'], 'groups' => $groups));?>
			<a class="close-reveal-modal">&#215;</a>
		</div>

	<?php else : ?>
		<a class="button" href="" data-reveal-id="newGroup" data-reveal>
			<span><?php echo __('Create a group');?></span>
		</a>
		<div id="newGroup" class="reveal-modal large lightbox" data-reveal>
			<?= $this->element('add_group', array('userid' => $user['User']['id'], 'groups' => $groups));?>
			<a class="close-reveal-modal">&#215;</a>
		</div>

	<?php endif; ?>

	<div>
		<dl class="groups tabs float-right margin bottom-2" data-tab>
			<dd class="active"><a href="#panel2-1"><?php echo __('All Evokation Teams');?></a></dd>
			<dd><a href="#panel2-2"><?php echo __('My Evokation Teams');?></a></dd>
			<dd><a href="#panel2-3"><?php echo __('Evokation Teams I Belong To');?></a></dd>
		</dl>
		<div class="groups tabs-content">
		  <div class="content active margin top-2" id="panel2-1">
			<?php
				foreach($groups as $e):
					echo $this->element('group_box', array('group' => $e));
				endforeach;
			?>
		   </div>
		  <div class="content margin top-2" id="panel2-2">

			<?php
				foreach($myGroups as $e):
					echo $this->element('group_box', array('group' => $e));
				endforeach;
			?>
		  </div>
		  <div class="content margin top-2" id="panel2-3">
			<?php
				foreach($groupsIBelong as $e):
					echo $this->element('group_box', array('group' => $e));
				endforeach;
			?>
		  </div>
		</div>
	</div>
</div>