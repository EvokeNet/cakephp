<?php
App::uses('AppModel', 'Model');
/**
 * Point Model
 *
 * @property User $User
 */
class Point extends AppModel {

	public function getLevel($userPoints){

		$level = 0;

		if($userPoints >= 250 && $userPoints < 500)
			$level = 1;

		else if($userPoints >= 500 && $userPoints < 750)
			$level = 2;

		else if($userPoints >= 750 && $userPoints < 1000)
			$level = 3;

		else if($userPoints >= 1000 && $userPoints < 2500)
			$level = 4;

		else if($userPoints >= 2500 && $userPoints < 5000)
			$level = 5;

		else if($userPoints >= 5000 && $userPoints < 7500)
			$level = 6;

		else if($userPoints >= 7500 && $userPoints < 10000)
			$level = 7;

		else if($userPoints >= 10000 && $userPoints < 15000)
			$level = 8;

		else if($userPoints >= 15000 && $userPoints < 20000)
			$level = 9;

		else if($userPoints >= 20000)
			$level = 10;

		return $level;
		
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
		)
	);
}
