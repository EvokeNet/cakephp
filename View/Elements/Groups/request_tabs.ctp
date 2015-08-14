<dl class="tabs tabs-style-image-and-text" data-tab>
	<dd class="active"><a href="#panel2-1"><?php echo __('Pending Requests');?></a></dd>
	<dd><a href="#panel2-2"><?php echo __('Accepted/Declined Requests');?></a></dd>
</dl>

<div class="tabs-content background-color-light-dark">
	<div class="content padding all-1 active" id="panel2-1">
		
		<?php
		//NO REQUESTS
		if (count($group['GroupRequestsPending']) <= 0) {
			echo __('There are no requests pending.');
		}
		//REQUESTS
		else {
			echo "<ul>";

			foreach($group['GroupRequestsPending'] as $request_pending): ?>
				<li>
					<?php
					echo date('d/m/Y H:i', strtotime($request_pending['created'])).": ";
					echo __("Agent %s", $request_pending['User']['name']);
					echo "<br /><br />";

					//ACCEPT
					echo $this->Html->link(
						__('Accept'),
						array('controller' => 'groupsUsers', 'action' => 'add', '?' => array(
							'arg' => $request_pending['user_id'], 
							'arg2' => $request_pending['group_id']
						)),
						array('class' => "buttonAcceptRequest button thin bg-green")
					);

					echo " ";

					//DECLINE
					echo $this->Html->link(
						__('Decline'),
						array('controller' => 'groupRequests', 'action' => 'decline', '?' => array(
							'arg' => $request_pending['user_id'], 
							'arg2' => $request_pending['group_id']
						)),
						array('class' => "buttonDeclineRequest button thin bg-red")
					);
					?>
				</li> <?php
			endforeach;

			echo "</ul>";
		}
		?>

	</div>
	<div class="content padding all-1" id="panel2-2">
		<?php
		//NO REQUESTS
		if (count($group['GroupRequestsDone']) <= 0) {
			echo __('There were no requests accepted or declined.');
		}
		//REQUESTS
		else {
			foreach($group['GroupRequestsDone'] as $request_done):?>
				<p>
					<?php
					if ($request_done['status'] == 1) {
						$icon = '<i class="fa fa-check-circle green"></i>';
						$status = __('Accepted');
					}
					else {
						$icon = '<i class="fa fa-times-circle red"></i>';
						$status = __('Declined');
					}

					echo $icon." ";
					echo date('d/m/Y H:i', strtotime($request_done['created'])).": ";
					echo __("Agent %s", $request_done['User']['name']);
					echo " ($status)";
					?>
				</p> <?php
			endforeach;
		}
		?>
	</div>
</div>