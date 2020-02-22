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
	public function testAdd() {

		$result = $this->testAction(
			'/users/add/',
			array('return' => 'vars', 'method' => 'get')
		);
		$this->assertNull($result['user']); //un authenticated user cannot view this page

		$Users = $this->generate('Users',array(
			'components' => array(
				'Auth'=>array('user')
			)));

			$user = $Users->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnValue(1));			
		
			$data = array(
				'User' => array(
					'first_name' => 'FirstName',
					'last_name' => 'LastName',
					'username' => 'flusername',
					'email'=>'first@gmail.com',
					'password'=>'password',
					'group_id'=>'1'
				)
			);

			$result = $this->testAction(
				'/users/add/',
				array('data' => $data, 'method' => 'post', 'return'=>'vars')
			);

			$this->assertArrayHasKey("user", $result);  
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
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

		$userId = '4000';
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			'/users/delete/' . $userId,
			array(
				'method' => 'get'
			)
		);

		$userId = '1';
		$this->testAction(
			'/users/delete/' . $userId,
			array(
				'method' => 'post'
			)
		);
		
		$this->assertEquals(array(), $this->User->findById($userId));
	}

	public function testLogin(){

		// $this->enableCsrfToken();
		// $this->enableSecurityToken();

		//TODO: Come back here - fix this for user login
		// $this->Users = $this->generate( 'Users');

		// $Users = $this->generate('Users',array(
		// 	'components' => array(
		// 		'Auth'=>array('user')
		// 	)));

		// 	$Users->Auth
		// 	->staticExpects($this->any())
		// 	->method('user')
		// 	->will($this->returnValue(3));

	// 	$data = array(
	// 		'User' => array(
	// 			'username' => 'seyiadmin',
	// 			'password' => 'password'				
	// 		)
	// 	);

	
	// $result = $this->testAction( "/users/login", array(
	// 		"method" => "post",
	// 		"return" => "contents",
	// 		"data" => $data
	// 	)
	// );

	// $res[] = $this->view;
	
	// $this->assertIdentical( 'Yes',$res );
	// $this->assertNotNull( $this->headers['Location'] );
	// $this->assertContains( 'posts', $this->headers['Location'] );
	// $this->assertNotContains( '"/users/login" id="UserLoginForm"', $res );

	// $this->Users->Auth->logout();

	}

}
