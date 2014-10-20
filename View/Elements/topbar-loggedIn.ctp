<!-- MENU LOGGED IN -->
<ul class="<?php echo isset($ulClass) ? $ulClass : ''; ?>">
	<li>
		<div class="column">
			<a href="#"><?php echo __('How to play'); ?></a>
		</div>
	</li>
	<li>
		<div class="column">
			<a href="#"><?php echo __('Missions'); ?></a>
		</div>
	</li>
	<li>
		<div class="column">
			<a href="#"><?php echo __('Evokations'); ?></a>
		</div>
	</li>
	<li>
		<div class="column">
			<a href="#"><?php echo __('Forum'); ?></a>
		</div>
	</li>
	<li>
		<div class="column">
			<a href="#"><?php echo __('Admin'); ?></a>
		</div>
	</li>

	<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
	<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
	<!--send to correct address-->
</ul>
<?php echo $this->Form->end(); ?>
<!-- MENU LOGGED IN -->