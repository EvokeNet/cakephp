<?php
/**
 * FriendshipFixture
 *
 */
class FriendshipFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 16, 'key' => 'primary'),
		'user_from' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 16),
		'user_to' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 16),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_from' => 1,
			'user_to' => 1,
			'created' => '2014-02-17 20:29:31'
		),
	);

}
