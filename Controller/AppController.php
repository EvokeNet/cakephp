<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Global Components
 *
 * @var array
 */	
	public $components = array(
        'Session',
        'Auth' => array(
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        ),
        'DebugKit.Toolbar',
        'Acl'
    );

    public $user = null;

/**
 * beforeFilter method
 *
 * @return void
 */
	public function beforeFilter() {
        $this->Auth->allow('add', 'fb_login', 'index', 'view');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard');
        $cuser = $this->Auth->user();
    }

    public function getUserData(){
        $c_user = array();

        if(is_null($this->Session->read('Auth.User.role_id'))) {
            $c_user['role_id'] = $this->Session->read('Auth.User.User.role_id');
            $c_user['id'] = $this->Session->read('Auth.User.User.id');
            $c_user['name'] = $this->Session->read('Auth.User.User.name');
        } else{
            $c_user['role_id'] = $this->Session->read('Auth.User.role_id');
            $c_user['id'] = $this->Session->read('Auth.User.id');
            $c_user['name'] = $this->Session->read('Auth.User.name');
        }
        return $c_user;
    }

}
