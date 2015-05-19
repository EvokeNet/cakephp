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

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable');


	public function afterSave($created, $options = array()) {
       
       	if($created){
       		
       		$value = 1;
       		//check to see if admin set a different amount of points for this action

       		$user_answer = $this->find('first', array(
				'conditions' => array('UserAnswer.id' => $this->id))
			);

       		App::import('model','Questionnaire');
       		App::import('model','Quest');

       		$questionnaires = new Questionnaire();
       		$quests = new Quest();
			
			$questionnaire = $questionnaires->find('first', array(
	        	'conditions' => array(
	        		'Questionnaire.id' => $user_answer['Question']['questionnaire_id'])));

	        $quest = $quests->find('first', array(
	        	'conditions' => array(
	        		'Quest.id' => $questionnaire['Questionnaire']['quest_id'])));

	        if($quest)
	            $value = $quest['Quest']['points'];

	        $event = new CakeEvent('Model.UserAnswer.add', $this, array(
	        	'points' => $value
	        ));

	        $this->getEventManager()->dispatch($event);

	        return true;
	    }	
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
