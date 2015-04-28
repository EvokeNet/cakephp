<?php
App::uses('AppModel', 'Model');
/**
 * Level Model
 *
 */
class Level extends AppModel {
	/**
	 * Gets the level that corresponds to the number of points
	 * @param int $points Number of points 
	 * @return object Level
	 */
	public function getLevel($points){
		debug($points);

		$level = $this->find('first', array(
			'conditions' => array("Level.points <= $points"),
			'order' => array('Level.points DESC')
		));
		
		return $level;
	}
}
