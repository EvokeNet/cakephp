
<h2><?= __('Hello, agent %s!', $recipient['firstname'].' '.$recipient['lastname']);?></h2>

<p><?php echo __('Your request to join group "%s" was accepted!', $group['title']);?></p>

<p align="center" style="text-align: center;"><?php echo $this->Html->link(
		__('Access Evoke and help your group!'), 
		array('controller' => 'missions', 'action' => 'view_mission', $group['mission_id'], $phase['position'])
	); ?></p>