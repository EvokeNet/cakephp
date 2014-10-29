<!-- MENU LOGGED IN -->
	<li>
		<div class="column">
			<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
				<a href="#"><?php echo __('How to play'); ?></a>
			</span>
		</div>
	</li>
	<li>
		<div class="column">
			<a href="<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'index')); ?>">
				<?php echo __('Missions'); ?>
			</a>
		</div>
	</li>
	<li>
		<div class="column">
			<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
				<a href="#"><?php echo __('Evokations'); ?></a>
			</span>
		</div>
	</li>
	<li>
		<div class="column">
			<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
				<a href="#"><?php echo __('Forum'); ?></a>
			</span>
		</div>
	</li>
	<li>
		<div class="column">
			<span data-tooltip aria-haspopup="true" class="has-tip" title="Not available on preview">
				<a href="#"><?php echo __('Admin'); ?></a>
			</span>
		</div>
	</li>
	<li>
		<div class="column">
			<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">
				<?php echo __('Logout'); ?>
			</a>
		</div>
	</li>

	<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
	<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
	<!--send to correct address-->
<?php echo $this->Form->end(); ?>
<!-- MENU LOGGED IN -->