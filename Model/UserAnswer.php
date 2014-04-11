<?php
App::uses('AppModel', 'Model');
/**
 * UserAnswer Model
 *
 * @property User $User
 * @property Question $Question
 * @property Answer $Answer
 */
class UserAnswer extends AppModel {

	public function afterSave($created, $options = array()) {
       
       	if($created){
	        $event = new CakeEvent('Model.UserAnswer.add', $this);

	        $this->getEventManager()->dispatch($event);

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
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Answer' => array(
			'className' => 'Answer',
			'foreignKey' => 'answer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
