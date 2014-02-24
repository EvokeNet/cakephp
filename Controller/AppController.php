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

    public $helpers = array(
        'Chosen.Chosen', 'Media.Media'
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

    public function getUserId() {
        $currentuser = $this->Auth->user();
        if(isset($currentuser['id'])) return $currentuser['id'];
        return $currentuser['User']['id'];
    }

    public function getUserName() {
        $currentuser = $this->Auth->user();
        if(isset($currentuser['name'])) return $currentuser['name'];
        return $currentuser['User']['name'];   
    }

    public function getUserRole() {
        $currentuser = $this->Auth->user();
        if(isset($currentuser['role_id'])) return $currentuser['role_id'];
        return $currentuser['User']['role_id'];
    }

    public function canUploadMedias($model, $id) {
        return true;
    }
}
