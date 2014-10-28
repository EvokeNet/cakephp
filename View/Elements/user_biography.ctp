<?php
//MODAL
if (isset($modal) && ($modal == true)): ?>
	<div id="modalProfile<?= $counter ?>" class="reveal-modal background-color-darkest" data-reveal><?php 
endif; ?>

		<div class="left margin right-2">
			<!-- PICTURE -->
			<div class="profile-picture radius border-style-solid border-color-highlight border-width-01"
	    		data-interchange="['<?= (isset($pic) ? $pic : '') ?>',(default)]">
			</div>

			<!-- SOCIAL NETWORKS -->
			<div>
			</div>
		</div>

		<div>
			<!-- USER NAME -->
			<h4 class="text-color-highlight"><?= __('Agent ').(isset($similar_user['User']['name']) ? $similar_user['User']['name'] : '') ?></h4>

			<!-- LEVEL PROGRESS BAR -->

			<!-- BIOGRAPHY -->
			<?= (isset($similar_user['User']['biography']) ? $similar_user['User']['biography'] : '') ?>


			<?php
			if (isset($add_button) && ($add_button == true)):?>
			<!-- ADD -->
			<div class="text-center">
				<a class="button small addally" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'add_friend', $similar_user['User']['id'], 'false')); ?>"><?php echo __('ADD ALLY'); ?></a>
			</div><?php 
			endif; ?>

			<a class="close-reveal-modal">&#215;</a>
		</div>

<?php
//MODAL
if (isset($modal) && ($modal == true)): ?>
	</div><?php
endif; ?>
