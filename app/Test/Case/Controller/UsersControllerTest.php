<?php
App::uses('UsersController', 'Controller');

/**
 * UsersController Test Case
 */
class UsersControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.group',
		'app.post'
	);

/**
 * setUp method
 *
 * @var array
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
		$this->Group = ClassRegistry::init('Group');
		
	
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		
		$result = $this->testAction('/users/index',array('return'=>'vars', 'method' => 'get'));
		$this->assertArrayHasKey('users',$result); //check if posts are being returned
		$this->assertGreaterThan(0, count($result['users']));
		$this->assertLessThan(10, count($result['users']));
		
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		
		$userId = 2;
		
		$result = $this->testAction('/users/view/' . $userId,array('return'=>'vars', 'method' => 'get'));
		
		$this->assertArrayHasKey('user', $result);
		$this->assertArrayHasKey('User', $result['user']);
		$this->assertCount(9, $result['user']['User']);
		$this->assertEquals($userId, $result['user']['User']['id']); //proper ID returned

		$this->setExpectedException('NotFoundException');
		$this->testAction('/users/view/70',array('return'=>'vars'));

	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testGetAdd() {

		$result = $this->testAction(
			'/users/add/',
			array('return' => 'vars', 'method' => 'get')
		);
		$this->assertArrayHasKey('groups',$result);
		$this->assertNotNull($result); 		
		
	}
/**
 * testAddFailUserEmailAlreadyUsed method
 *
 * @return void
 */
	
	public function testAddFailUserEmailAlreadyUsed(){

		$data = array(
			'User' => array(
				'first_name' => 'FirstName',
				'last_name' => 'LastName',
				'username' => 'flusername',
				'email'=>'seyi@problogger.com',
				'password'=>'password',
				'group_id'=>'3'
			)
		);

		$result = $this->testAction(
			'/users/add/',
			array('data' => $data, 'method' => 'post','return'=>'contents')
		);
		// $this->assertIdentical('una',$result);
		$this->assertEquals(1, $this->User->find('count', array(
			'conditions' => array(
				'User.email' => 'seyi@problogger.com',
			),
		)));

	}

/**
 * testAddFailUsernameAlreadyUsed method
 *
 * @return void
 */
	public function testAddFailUsernameAlreadyUsed(){

		$data = array(
			'User' => array(
				'first_name' => 'FirstName',
				'last_name' => 'LastName',
				'username' => 'seyiadmin',
				'email'=>'seyip@problogger.com',
				'password'=>'password',
				'group_id'=>'3'
			)
		);

		$result = $this->testAction(
			'/users/add/',
			array('data' => $data, 'method' => 'post','return'=>'contents')
		);
		// $this->assertIdentical('una',$result);
		$this->assertEquals(1, $this->User->find('count', array(
			'conditions' => array(
				'User.username' => 'seyiadmin',
			),
		)));

	}

	/**
 * testAddSucceed method
 *
 * @return void
 */
	public function testAddSucceed(){

			$data = array(
				'User' => array(
					'first_name' => 'FirstName',
					'last_name' => 'LastName',
					'username' => 'flusername',
					'email'=>'first@gmail.com',
					'password'=>'password',
					'group_id'=>'3'
				)
			);

			$result = $this->testAction(
				'/users/add/',
				array('data' => $data, 'method' => 'post')
			);

			$this->assertEquals(1, $this->User->find('count', array(
				'conditions' => array(
					'User.email' => 'first@gmail.com',
				),
			))); 	

	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

		$userId = '2';

		$result = $this->testAction(
			'/users/edit/'.$userId,
			array('return' => 'contents', 'method' => 'get')
		);
		$this->assertNull($result);  //un authenticated user cannot view this page

		$User = $this->generate('Users',array(
			'components' => array(
				'Auth'
			)));			

			$User->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnValue(1));
		
		$result = $this->testAction(
			'/users/edit/' . $userId,
			array('return' => 'contents', 'method' => 'get')
		);

		$this->assertContains('Edit User', $result);

	}

	/**
 * testEditSucceed method
 *
 * @return void
 */

	public function testEditSucceed(){

		$userId = '2';

		$data = array(
			'User' => array(
				'first_name' => 'FirstName_Edit',
				'last_name' => 'LastName',
				'username' => 'flusername',
				'email'=>'first@gmail.com',
				'password'=>'password',
				'group_id'=>'3'
			)
		);

		$Users = $this->generate('Users',array(
			'components' => array(
				'Auth'
			)));			

		$Users->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnValue(1));

		$result = $this->testAction(
				'/users/edit/'. $userId,
				array('data' => $data, 'method' => 'post','return'=>'contents') //try to do this when not logged in
			);
	
		$this->assertEquals(1, $this->User->find('count', array(
			'conditions' => array(
				'User.first_name' => 'FirstName_Edit',
			),
		))); 	

	}


	/**
 * testEditFailIdNotFount method
 *
 * @return void
 */
	public function testEditFailIdNotFount(){
		$userId = '49999';

		$User = $this->generate('Users',array(
			'components' => array(
				'Auth'=>array('user')
			)));			

		$User->Auth
		->staticExpects($this->any())
		->method('user')
		->will($this->returnValue(1));

		$this->setExpectedException('NotFoundException');
		
		$this->testAction(
			'/users/edit/'.$userId,
			array('return' => 'contents', 'method' => 'get')
		);
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDeleteFail() {

		$userId = '4000';
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			'/users/delete/' . $userId,
			array(
				'method' => 'delete'
			)
		);
		
	}

/**
 * testDeleteSucceed method
 *
 * @return void
 */

	public function testDeleteSucceed(){

		$userId = '1';

		$User = $this->generate('Users',array(
			'components' => array(
				'Auth'=>array('user')
			)));			

		$User->Auth
		->staticExpects($this->any())
		->method('user')
		->will($this->returnValue(1));

		$result = $this->testAction(
			'/users/delete/' . $userId,
			array(
				'method' => 'delete'
			)
		);		
		
		$this->assertStringEndsWith("/users", $this->headers['Location']);
		$this->assertEquals(array(), $this->User->findById($userId));
				
	}

/**
 * testLoginSucceed method
 *
 * @return void
 */
	public function testLoginSucceed(){

		$User = $this->generate('Users',array(
			'components' => array(
				'Auth'=>array('user')
			)));			

		$User->Auth
		->staticExpects($this->any())
		->method('user')
		->will($this->returnValue(1));

		$data = array(
			'User' => array(
				'username' => 'seyiadmin',
				'password' => 'password'				
			)
		);

		$result = $this->testAction(
			'/users/login/',
			array('data' => $data, 'method' => 'post') 
		);


	$this->assertStringEndsWith("/posts", $this->headers['Location']);


	$User->Auth->logout();

	}

/**
 * testLoginFail method
 *
 * @return void
 */

	public function testLoginFail(){

		$data = array(
			'User' => array(
				'username' => 'seyiadmin',
				'password' => 'passwordfail'				
			)
		);

		$result = $this->testAction(
			'/users/login/',
			array('data' => $data, 'method' => 'post') 
		);

		$this->assertNull($result);
	
	}

	
/**
 * testLogout method
 *
 * @return void
 */


	public function testLogout(){
		
		$User = $this->generate('Users',array(
			'components' => array(
				'Auth'=>array('user')
			)));			

		$User->Auth
		->staticExpects($this->any())
		->method('user')
		->will($this->returnValue(1));

		$this->testAction('/users/logout',array('method'=>'get'));		

	}

}
