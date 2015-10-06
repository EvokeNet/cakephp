<div id="moreEvokationsTarget" class="evidences-list">
	<?php 
	if (isset($groups)):
		foreach($groups as $g):
			echo $this->element('Evokations/evokation_list_item', array('g' => $g));
		endforeach;
	endif; ?>
</div>

<!-- BUTTON LOAD MORE -->
<div class="moreEvokationsButtonContainer text-center margin all-1 bottom-2">
	<a id="btnLoadMoreEvokations" class="button-icon highlight-black">
		<span class="fa-stack fa-lg">
			<i class="fa fa-circle fa-stack-2x"></i>
			<i class="fa fa-arrow-down fa-stack-1x fa-inverse"></i>
		</span>
		<p class="text-color-highlight"><?= __('Load more') ?></p>
	</a>
</div>

<!-- LOADING ANIMATION -->
<div class="moreEvokationsLoading hidden padding all-1">
	<?php echo $this->element('loading_animation'); ?>
</div>

<!-- SCRIPT -->
<?php
	//LOADING EVokationS
	$load_evokations_url = $this->Html->url(array('controller' => 'missions', 'action' => 'moreEvokations', 
		'?' => array('mission_id' => $this->request->query('mission_id'))
	));
	$load_evokations_url = str_replace('amp;', '', $load_evokations_url); //Workaround for Cakephp 2.x

	//SCRIPT VARIABLES
	$this->Html->scriptStart(array('inline' => false)); ?>
		var missions_evokation_list_load_limit = "<?= $this->request->query('limit') ?>";
		var missions_evokation_list_load_evokations_url = "<?= $load_evokations_url ?>";
	<?php
	$this->Html->scriptEnd();

	//SCRIPT
	$this->Html->script('requirejs/app/Elements/Evokations/evokation_list.js', array('inline' => false));
?>