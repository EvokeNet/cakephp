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
        $this->Auth->allow('add', 'login', 'fb_login', 'index', 'view');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard');

        $cuser = $this->Auth->user();

        $this->_checkBrowserLanguage();

        $userPoints = $this->getPoints($this->getUserId());
        $userLevel = $this->getLevel($userPoints);
        $userLevelPercentage = $this->getLevelPercentage($userPoints, $userLevel);

        $this->set(compact('userPoints', 'userLevel', 'userLevelPercentage'));
        
        // $this->set('userPoints', $userPoints);
        // $this->set('userLevel', $userLevel);
        // $this->set('userLevelPercentage', $userLevelPercentage);
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

    public function getCurrentLanguage(){
        return CakeSession::read('Config.language');
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

        return $level;
        
    }

    public function getUserImage($userid) {

    }

    public function getLevelPercentage($userPoints, $userLevel){

        $this->loadModel('Level');

        $thisLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $userLevel+1)));

        if(!empty($thisLevel))
            $percentage = round(($userPoints/$thisLevel['Level']['points']) * 100);
        else
            $percentage = 0;

        return $percentage;
        
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