<?php
App::uses('AppModel', 'Model');
/**
 * Point Model
 *
 * @property User $User
 */
class Point extends AppModel {

	public $actsAs = array('Containable'); //Can be retrieved through models it belongs to


	/**
	 * After points are created/updated, the user level has to be updated as well
	 * @param boolean True the point has been created, otherwise it's updated
	 * @param array Options
	 */
	public function afterSave($created, $options = array()) {
		//Data of the point saved
		$point_saved = $this->data;

		//User model
		App::import('model','User');
		$userModel = new User();
		$userModel->id = $point_saved['Point']['user_id'];

		//Get new user level
		$level = $userModel->getLevel($point_saved['Point']['user_id']);

		//UPDATE LEVEL
		$userModel->set(array('level'=> $level['Level']['level']));
		$userModel->save();
	}


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
