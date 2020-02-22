<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

	public $helpers = array('Html', 'Form','Time');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Auth', 'Session');
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$post = $this->Post->find('all');
		
		if($this->isAuthor || $this->isAdmin){

			$postCount = $this->Post->find('count',array('conditions' => array('user_id' => $this->userId)));
			$this->set('userCount',$postCount);
		
		}
		
		$this->set('posts', $post);
		
	}

/**
 * myposts method
 *
 * @return void
 */
	public function myposts(){

		if (!$this->userId) {
			// throw new NotFoundException(__('Unauthorized'));
			$this->Flash->error(__('Unauthorized'));
			return $this->redirect(array('action' => 'index'));
		}
			
		$post = $this->Post->find('all',array('conditions' => array('user_id' => $this->userId)));
		$this->set('posts', $post);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		}

		$users = $this->Post->User->find('list');
		$this->set(compact('users'));

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));			
		}

		if ($this->request->is(array('post', 'put'))) {
		
			if ( !$this->isAdmin && $this->request->data['user_id'] != $this->userId ) {
				throw new NotFoundException('Not allowed');
			} 	

			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}

	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		 
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete($id)) {
			$this->Flash->success(__('The post has been deleted.'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
