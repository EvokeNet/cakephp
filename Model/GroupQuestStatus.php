<?php
App::uses('AppModel', 'Model');
/**
 * GroupQuestStatus Model
 *
 * @property User $User
 * @property Mission $Mission
 * @property Phase $Phase
 */
class GroupQuestStatus extends AppModel {
	// all possible status
	const STATUS_NOT_STARTED = 0;
	const STATUS_IN_USE		 = 1; // bloked for other users
	const STATUS_IN_PROGRESS = 2; // started but not finished
	const STATUS_COMPLETED   = 3;

/**
* initialize all evokation quests status as not started
* @param group_id
*/
public function initQuests($group_id = null, $mission_id){
	//QUESTS TO DISPLAY IN THE EVOKATION PHASE
	//evokePhase is a custom find type to retrieve just the quests to be displayed in the Evoke phase
	$evokationQuests = $this->Quest->find('evokePhase',array(
		'conditions' => array('mission_id' => $mission_id),
		'fields' => array('Quest.id')
	));
	// array with all the quests ids for evoke phase
	$questsIds = Hash::extract($evokationQuests, '{n}.Quest.id');
	debug($questsIds);

	foreach ($questsIds as $q) {
		$data = array(
			'group_id' => $group_id,
			'quest_id' => $q,
			'status'   => self::STATUS_NOT_STARTED
		);
		debug($data);
		$this->save($data);
		$this->clear();
	}
	
}





//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
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
