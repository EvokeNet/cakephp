<?php
App::uses('AppModel', 'Model');
/**
 * LogPlaytest Model
 *
 * @property User $User
 */
class LogPlaytest extends AppModel {

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable');

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


/**
 * add_log
 *
 * @return void
 */
	public function log_playtest_add($action_performed = null, $variable = null) {
		$user = $this->getCurrentUser();
		
		$log['LogPlaytest']['user_id'] = $user['id'];
		$log['LogPlaytest']['action_performed'] = $action_performed;
		$log['LogPlaytest']['variable'] = $variable;

		$this->create($log);

		if ($this->save($log)) {
			return true;
		}
		return false;
	}
}
