
<h2><?= __('Hello, agent %s!', $recipient['firstname'].' '.$recipient['lastname']);?></h2>

<p><?php echo __('Unfortunately, your request to join group "%s" was declined.', $group['title']);?></p>

<p><?php echo __("But don't worry!");?></p>

<p align="center" style="text-align: center;"><?php echo $this->Html->link(
		__('Access Evoke and join another group, or create your own!'), 
		array(
			'controller' => 'missions', 
			'action' => 'view_mission', 
			$group['mission_id'], 
			$phase['position'],
			'full_base' => true
		)
	); ?></p>