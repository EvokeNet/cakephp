<?php
App::uses('AppModel', 'Model');
/**
 * UserPowerPoint Model
 *
 * @property User $User
 * @property PowerPoints $PowerPoints
 * @property Quest $Quest
 */
class UserPowerPoint extends AppModel {


	public function afterSave($created, $options = array()) {
       
       	if($created){
       		//check to see if admin set a different amount of points for this action
	        App::import('model','Badge');
	        $badge = new Badge();
	        $available_badges = $badge->find('all');


	        $my_powerpoints = $this->find('all', array(
	        	'conditions' => array(
	        		'UserPowerPoint.user_id' => $this->data['UserPowerPoint']['user_id']
	        	)
	        ));

	        //debug($available_badges);
	        //to each badge, check the amount of pp it needs and the amount of pp i got
	        foreach ($available_badges as $badge) {
	        	//need to check to see if user alread got this badge & if this badge only needs pp's
	        	App::import('model','UserBadge');
	        	$modelUserBadge = new UserBadge();
	        	$userbadge = $modelUserBadge->find('first', array(
	        		'conditions' => array(
	        			'UserBadge.user_id' => $this->data['UserPowerPoint']['user_id'],
	        			'UserBadge.badge_id' => $badge['Badge']['id']
	        		)
	        	));
	        	//if he's got it, ignore this iteration
	        	if(!empty($userbadge))
	        		continue;

	        	foreach ($badge['BadgePowerPoint'] as $b) {
	        		
		        	$needed = $b['quantity'];
		        	$gotit = 0;
		        	foreach ($my_powerpoints as $my_pp) {
		        		if($my_pp['UserPowerPoint']['power_points_id'] == $b['power_points_id'])
		        			$gotit += $my_pp['UserPowerPoint']['quantity'];
		        	}
		        	if($gotit >= $needed) {
		        		//hurray! he's got it! -> dispatch an event letting him know he won the badge
		        		$event = new CakeEvent('Model.BadgesUser.won', $this, array(
				        	'badge_id' => $b['badge_id'],
				        	'user_id' => $this->data['UserPowerPoint']['user_id']
				        ));

				        $this->getEventManager()->dispatch($event);
		        	}
		        }
	        }
	    	return true;
	    }	

	    
    }


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PowerPoints' => array(
			'className' => 'PowerPoints',
			'foreignKey' => 'power_points_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'quest_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
