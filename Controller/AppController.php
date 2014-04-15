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
        'Chosen.Chosen', 'Media.Media',
    );

    public $user = null;
    public $lang = null;

/**
 * beforeFilter method
 *
 * @return void
 */
	public function beforeFilter() {
        $this->Auth->allow('add', 'fb_login', 'index', 'view');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard');

        $cuser = $this->Auth->user();

        $this->_checkBrowserLanguage();
    }

    /**
     * Read the browser language and sets the website language to it if available. 
     * 
     */
    protected function _checkBrowserLanguage(){
        if(!$this->Session->check('Config.language')){
             
            //checking the 1st favorite language of the user's browser 
            $languageHeader = $this->request->header('Accept-language');
            $languageHeader = substr($languageHeader, 0, 2);
             
            //available languages
            switch ($languageHeader){
                case "en":
                    $this->Session->write('Config.language', 'en');
                    break;
                case "es":
                    $this->Session->write('Config.language', 'es');
                    break;
                default:
                    $this->Session->write('Config.language', 'en');
            }
        }
    }

    public function changeLanguage($lang){
        if(!empty($lang)){
            if($lang == 'es'){
                $this->Session->write('Config.language', 'es');
            }
 
            if($lang == 'en'){
                $this->Session->write('Config.language', 'en');
            }
 
            //in order to redirect the user to the page from which it was called
            $this->redirect($this->referer());
        }
    }

    public function getPoints($user_id){

        $this->loadModel('Point');
        $all = $this->Point->find('all', array('conditions' => array('Point.user_id' => $user_id)));

        $points = 0;
        
        foreach($all as $a){
            $points += $a['Point']['value'];
        }

        return $points;

    }

    public function getLevel($userPoints){

        $this->loadModel('Level');

        $levels = $this->Level->find('all', array('order' => array('Level.points ASC')));

        $level = 0;

        foreach($levels as $l):
            if($l['Level']['points'] <= $userPoints){
                $level = $l['Level']['level'];
            } else{
                break;
            }

        endforeach;

        // if($userPoints < 250)
        //     $level = 0;

        // else if($userPoints >= 250 && $userPoints < 500)
        //     $level = 1;

        // else if($userPoints >= 500 && $userPoints < 750)
        //     $level = 2;

        // else if($userPoints >= 750 && $userPoints < 1000)
        //     $level = 3;

        // else if($userPoints >= 1000 && $userPoints < 2500)
        //     $level = 4;

        // else if($userPoints >= 2500 && $userPoints < 5000)
        //     $level = 5;

        // else if($userPoints >= 5000 && $userPoints < 7500)
        //     $level = 6;

        // else if($userPoints >= 7500 && $userPoints < 10000)
        //     $level = 7;

        // else if($userPoints >= 10000 && $userPoints < 15000)
        //     $level = 8;

        // else if($userPoints >= 15000 && $userPoints < 20000)
        //     $level = 9;

        // else if($userPoints >= 20000)
        //     $level = 10;

        return $level;
        
    }

    public function getUserId() {
        $currentuser = $this->Auth->user();
        if(isset($currentuser['id'])) return $currentuser['id'];
        // debug($currentuser);
        // die();
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