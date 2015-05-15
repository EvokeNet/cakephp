<?php
?>

<section class="evoke default-background">

	<div id="secondModal" class="reveal-modal" data-reveal>
	  <h2>This is a second modal.</h2>
	  <p>See? It just slides into place after the other first modal. Very handy when you need subsequent dialogs, or when a modal option impacts or requires another decision.</p>
	  <a class="close-reveal-modal">&#215;</a>
	</div>

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns padding-left">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-10 medium-10 large-10 columns margin top-2 maincolumn body-padding">

	  	<?php echo $this->Session->flash(); ?>

	  	<h3 class = "margin bottom-1"><?= strtoupper(__('Groups')) ?></h3>

	  	<h3 class = "padding top-1"><?= strtoupper(sprintf(__('Mission: %s'), $mission['Mission']['title'])) ?></h3>

	  	<?php if(isset($mission['Mission'])): ?>
			<div class = "evoke titles-right">
				<a class="button general green" href="" data-reveal-id="newGroup" data-reveal>
					<span><?php echo __('Create a group');?></span>
				</a>
			</div>
			<div id="newGroup" class="reveal-modal large evoke lightbox" data-reveal>
				<?= $this->element('add_group', array('mission' => $mission, 'quest_id' => $quest_id, 'userid' => $user['User']['id'], 'groups' => $groups));?>
				<a class="close-reveal-modal">&#215;</a>
			</div>

		<?php else : ?>
			<a class="button general" href="" data-reveal-id="newGroup" data-reveal>
				<span><?php echo __('Create a group');?></span>
			</a>
			<div id="newGroup" class="reveal-modal large evoke lightbox" data-reveal>
				<?= $this->element('add_group', array('userid' => $user['User']['id'], 'groups' => $groups));?>
				<a class="close-reveal-modal">&#215;</a>
			</div>

		<?php endif; ?>

		<div class="evoke sheer-background">
			<dl class="groups tabs float-right margin bottom-2" data-tab>
			  <dd class="active"><a href="#panel2-1"><?php echo __('All Evokation Teams');?></a></dd>
			  <dd><a href="#panel2-2"><?php echo __('My Evokation Teams');?></a></dd>
			  <dd><a href="#panel2-3"><?php echo __('Evokation Teams I Belong To');?></a></dd>
			</dl>
			<div class="groups tabs-content">
			  <div class="content active margin top-2" id="panel2-1">
			  	<?php
		  			foreach($groups as $e):
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user, 'users' => $users_groups));
	  				endforeach;
	  			?>
			   </div>
			  <div class="content margin top-2" id="panel2-2">

			    <?php
		  			foreach($myGroups as $e):
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user, 'users' => $users_groups));
	  				endforeach;
	  			?>
			  </div>
			  <div class="content margin top-2" id="panel2-3">
			  	<?php
		  			foreach($groupsIBelong as $e):
	  					echo $this->element('group_box', array('e' => $e, 'user' => $user, 'users' => $users_groups));
	  				endforeach;
	  			?>
			  </div>
			</div>
		</div>

	  </div>

	  <div class="medium-1 end columns"></div>

  </div>
</section>