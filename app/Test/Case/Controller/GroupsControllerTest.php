<?php
App::uses('GroupsController', 'Controller');
App::uses('Group', 'Model');
App::uses('User', 'Model');
/**
 * GroupsController Test Case
 */
class GroupsControllerTest extends ControllerTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array(
		'app.group',
		'app.user'
	);

	public function setUp() {
        parent::setUp();
        $this->Group = ClassRegistry::init('Group');
	}
	
		/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Group);

		parent::tearDown();
	}

    public function testIndex() {

		$result = $this->testAction(
			'/groups',
			array('return' => 'result', 'method' => 'get')
		);
		// $this->assertArrayHasKey('groups', $result);
		// $this->assertGreaterThan(0, count($result['groups']));
		// $this->assertLessThan(4, count($result['groups']));
    }

}
