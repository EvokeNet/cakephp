<?php
App::uses('Friendship', 'Model');

/**
 * Friendship Test Case
 *
 */
class FriendshipTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.friendship'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Friendship = ClassRegistry::init('Friendship');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Friendship);

		parent::tearDown();
	}

}
