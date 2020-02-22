<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $isAdmin = false;
    public $isAuthor = false;
    public $isReader = false;
    public $user_id = null;
    public $loggedInUser = null;

    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session',
        'Flash'
    );
    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() {
        
        $this->Auth->loginAction = array(
          'controller' => 'users',
          'action' => 'login'
        );
        $this->Auth->logoutAction = array(
          'controller' => 'users',
          'action' => 'logout'
        );
        $this->Auth->logoutRedirect = array(
          'controller' => 'pages',
          'action' => 'index'
        );
        $this->Auth->loginRedirect = array(
          'controller' => 'posts',
          'action' => 'index'
        );

        $this->Auth->allow('display'); // Allow everyone to access homepage

        $this->set('user', $this->Auth->user()); //Make logged User available for views

        //Set Data for other controllers to use
        $this->isAdmin =  $this->Auth->user('Group')['name'] == 'Admin' ? true : false;
        $this->isAuthor =  $this->Auth->user('Group')['name'] == 'Author' ? true : false;
        $this->isReader =  $this->Auth->user('Group')['name'] == 'Reader' ? true : false;
        $this->userId = $this->Auth->user('id');	
        // $this->loggedInUser = $this->Auth->user(); un-needed for now	

    }

}
