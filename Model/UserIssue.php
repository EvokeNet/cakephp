<?php
App::uses('AppModel', 'Model');
/**
 * UserIssue Model
 *
 * @property User $User
 * @property Issue $Issue
 */
class UserIssue extends AppModel {


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
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $validate = array(
        'Issue' => array( 
            'multiple' => array( 
                'rule' => array('multiple',array('min' => 1)), 
                'message' => 'Please select at least 1 feature'), 
        ), 
    );
}
