<?php
App::uses('PostsController', 'Controller');
// App::uses('Post', 'Model');

/**
 * PostsController Test Case
 */
class PostsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post',
		'app.user',
		'app.group'
	);

	
	/**
 * setUp method
 *
 * @return void
 */
public function setUp() {
	parent::setUp();
	$this->Post = ClassRegistry::init('Post');
	$this->User = ClassRegistry::init('User');
	$this->Group = ClassRegistry::init('Group');

}

/**
* tearDown method
*
* @return void
*/
public function tearDown() {
	unset($this->Post);
	unset($this->User);
	unset($this->Group);


	parent::tearDown();
}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {

		$result = $this->testAction('/posts/index',array('return'=>'vars', 'method' => 'get'));
		$this->assertArrayHasKey('posts',$result); //check if posts are being returned
		$this->assertGreaterThan(0, count($result['posts']));
		$this->assertLessThan(10, count($result['posts']));
		

	}


/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		//check that only logged In user can view posts
		$postId = 2;
		
		$result = $this->testAction('/posts/view/' . $postId,array('return'=>'vars', 'method' => 'get'));
		
		$this->assertArrayHasKey('post', $result);
		$this->assertArrayHasKey('Post', $result['post']);
		$this->assertCount(7, $result['post']['Post']);
		$this->assertEquals($postId, $result['post']['Post']['id']); //proper ID returned

		$this->setExpectedException('NotFoundException');
		$this->testAction('/posts/view/70',array('return'=>'vars'));
				
	}

/**
 * testMyposts method
 *
 * @return void
 */
	public function testMyposts(){

		$result = $this->testAction('/posts/myposts',array('return'=>'view', 'method' => 'get'));
		$this->assertNull($result);  //check that only logged In Users can view myposts


		$Posts = $this->generate('Posts',array(
			'components' => array(
				'Auth'=>array('user')
			)));

			$Posts->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnValue(1));

			$result = $this->testAction('/posts/myposts',array('return'=>'contents', 'method' => 'get'));
			$this->assertContains('My Posts',$result);  
			
	}

/**
 * validate data set for the add get request
 *
 * @return void
 */
	public function testAdd() {
		
		$result = $this->testAction(
			'/posts/add/',
			array('return' => 'contents', 'method' => 'get')
		);
		$this->assertNull($result); //un authenticated user cannot view this page
			
		$data = array(
			'Post' => array(
				'title' => 'New Post Added',
				'except' => 'Lorem ipsum dolor sit amet',
				'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
				'user_id'=>'1'				
			)
		);

		$result = $this->testAction(
			'/posts/add/',
			array('data' => $data, 'method' => 'post')
		);
		
		$this->assertStringEndsWith("/posts", $this->headers['Location']);

		$this->assertEquals(1, $this->Post->find('count', array(
			'conditions' => array(
				'Post.title' => 'New Post Added',
			),
		))); 			
	
	}


/**
 * testEditFails method
 *
 * @return void
 */
	public function testEditFails() {

		$postId = '2';

		$result = $this->testAction(
			'/posts/edit/'.$postId,
			array('return' => 'contents', 'method' => 'get')
		);
		$this->assertNull($result);  //un authenticated user cannot view this page

		$Post = $this->generate('Posts',array(
			'components' => array(
				'Auth'=>array('user')
			)));			

			$Post->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnValue(1));
		
		$result = $this->testAction(
			'/posts/edit/' . $postId,
			array('return' => 'contents', 'method' => 'get')
		);

		$this->assertContains('Edit Post', $result);

		$data = array(
			'Post' => array(
				'title' => 'New Post Added',
				'except' => 'Lorem ipsum dolor sit amet',
				'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
			),
			'user_id'=>'1'	
		);

		$this->setExpectedException('NotFoundException');
		$this->testAction(
			'/posts/edit/'. $postId,
			array('data' => $data, 'method' => 'put') //try to do this when not logged in
		);


	}

	/**
 * testEditFailIdNotFound method
 *
 * @return void
 */

	public function testEditFailIdNotFound(){
		$postId = '44000';

		$Post = $this->generate('Posts',array(
			'components' => array(
				'Auth'=>array('user')
			)));			

		$Post->Auth
		->staticExpects($this->any())
		->method('user')
		->will($this->returnValue(1));

		$this->setExpectedException('NotFoundException');
		
		$this->testAction(
			'/posts/edit/'.$postId,
			array('return' => 'contents', 'method' => 'get')
		);
	}

/**
 * testEditSucceed method
 *
 * @return void
 */

	public function testEditSucceed() {

		$postId = '2';
		$data = array(
			'title' => 'Post Added Edit',
			'except' => 'Lorem ipsum dolor sit amet',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_id'=>'1'	
		);

		$Posts = $this->generate('Posts',array(
			'components' => array(
				'Auth'
			)));			

		$Posts->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnValue(1));

		$result = $this->testAction(
				'/posts/edit/'. $postId,
				array('data' => $data, 'method' => 'post','return'=>'contents') //try to do this when not logged in
			);
	
		$this->assertStringEndsWith("/posts", $this->headers['Location']);

		$this->assertEquals(1, $this->Post->find('count', array(
			'conditions' => array(
				'Post.title' => 'Post Added Edit',
			),
		))); 	
	}

/**
 * test the delete method when the object is not found
 *
 * @return void
 */
	public function testDeleteNotFoundException() {
		$postId = '4000';
		$this->setExpectedException('NotFoundException');
		$this->testAction(
			'/posts/delete/' . $postId,
			array(
				'method' => 'get'
			)
		);
	}

/**
 * test the delete method when using the incorrected method
 *
 * @return void
 */
	public function testDeleteMethodNotAllowedException() {
		$postId = '2';
		$this->setExpectedException('MethodNotAllowedException');
		$this->testAction(
			'/posts/delete/' . $postId,
			array(
				'method' => 'get'
			)
		);
	}

/**
 * test the delete method when using the correct method
 *
 * @return void
 */
	public function testDeleteValidDeletion() {
		$postId = '2';
		$this->testAction(
			'/posts/delete/' . $postId,
			array(
				'method' => 'post',
			)
		);
		$this->assertStringEndsWith("/posts", $this->headers['Location']);
		$this->assertEquals(array(), $this->Post->findById($postId));
	}

/**
 * test the delete method when delete fails
 *
 * @return void
 */
	public function testDeleteInvalidDeletion() {
		$postId = '2';

		$Posts = $this->generate('Posts', array(
			'models' => array(
				'Post' => array('delete')
			),
		));
		$Posts->Post
			->expects($this->once())
			->method('delete')
			->will($this->returnValue(false));
			
		$this->testAction(
			'/posts/delete/' . $postId,
			array(
				'method' => 'post'
			)
		);
		$this->assertStringEndsWith("/posts", $this->headers['Location']);
		$this->assertEquals(1, $this->Post->find('count', array(
			'conditions' => array(
				'Post.id' => $postId,
			),
		)));
	}
	
}
