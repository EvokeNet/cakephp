<?php 
if (isset($evidences)):
	foreach($evidences as $e): ?>
		<div class="border-top-dark">
			<!-- TITLE -->
			<h5 class="text-color-highlight">
				<?php echo $this->Html->link($e['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $e['Evidence']['id']));?>
			</h5>

			<p><?php echo substr($e['Evidence']['content'], 0, 200); ?></p>
		</div><?php 
	endforeach; 
endif; ?>