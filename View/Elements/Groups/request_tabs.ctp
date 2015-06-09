<dl class="tabs tabs-style-image-and-text" data-tab>
	<dd class="active"><a href="#panel2-1"><?php echo __('Pending Requests');?></a></dd>
	<dd><a href="#panel2-2"><?php echo __('Accepted/Declined Requests');?></a></dd>
</dl>

<div class="tabs-content background-color-light-dark">
	<div class="content active" id="panel2-1">
		<ul>
			<?php
			//NO REQUESTS
			if (count($groupsRequestsPending) <= 0) {
				echo __('There are no requests pending');
			}

			//REQUESTS
			foreach($groupsRequestsPending as $g): ?>
				<li><?php echo $g['Leader']['name']; ?>
					<div class="button-bar">
						<ul class="button-group">
						<li><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'add', $g['GroupRequest']['user_id'], $g['GroupRequest']['group_id'])); ?>" class = "button"><?php echo __('Accept');?></a></li>
						</ul>
						<ul class="button-group">
						<li><a href = "<?php echo $this->Html->url(array('controller' => 'groupRequests', 'action' => 'decline', $g['GroupRequest']['user_id'], $g['GroupRequest']['group_id'])); ?>" class = "button alert"><?php echo __('Decline');?></a></li>
						</ul>
					</div>
				</li> <?php
			endforeach; ?>
		</ul>
	</div>
	<div class="content" id="panel2-2">
		<ul>
			<?php
			//NO REQUESTS
			if (count($groupsRequests) <= 0) {
				echo __('There were no requests accepted or declined.');
			}

			//REQUESTS

			foreach($groupsRequests as $g):?>
				<li>
					<?php
					if ($g['GroupRequest']['status'] == 1) $status = __('Accepted');
					else $status = __('Declined');

					echo sprintf(__("Requester: Agent %s </br> Status: %s", $g['Leader']['name'], $status));
					?>
				</li> <?php
			endforeach; ?>
		</ul>
	</div>
</div>