<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('terms', 'reportissue', 'dmcanotifications');        
    }

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}


	public function reportissue(){
	}

	public function terms(){
		$userid = $this->getUserId();
		//debug($this->Auth);
		$facebook = new Facebook(array(
			'appId' => Configure::read('fb_app_id'),
			'secret' => Configure::read('fb_app_secret'),
			'allowSignedRequest' => false,
			
		));

		$browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$this->set(compact('browserLanguage'));

		if(isset($this->params['url']['code'])) {

			$token = $facebook->getAccessToken();

			if (!empty($token)) {

				$userFbData = $facebook->getUser();
				$user_profile = '';

				try {
					$user_profile = $facebook->api('/me');
				} catch (FacebookApiException $e) {
					error_log($e);
					$userFbData = null;
				}

				$user = $this->User->find('first', array('conditions' => array('facebook_id' => $user_profile['id'])));

				if(empty($user)) {

					// User does not exist in DB, so we are going to create

					$this->User->create();
					$user['User']['facebook_id'] = $user_profile['id'];
					$user['User']['facebook_token'] = $token;
					$user['User']['name'] = $user_profile['name'];
					$user['User']['sex'] = $user_profile['gender'];
					$user['User']['login'] = $user_profile['username'];
					$user['User']['facebook'] = $user_profile['link'];
					$user['User']['role_id'] = 3;

					if($this->User->save($user)) {
						$user['User']['id'] = $this->User->id;
						$this->Auth->login($user);
						// $this->Session->write('Auth.User.id', $this->User->getLastInsertID());
						//return $this->redirect(array('action' => 'dashboard'));
						$this->Session->setFlash('', 'opening_lightbox_message');
						return $this->redirect(array('controller' => 'users', 'action' => 'edit', $this->User->id));
					} else {
						$this->Session->setFlash(__('There was some interference in your connection.'), 'error');
						return $this->redirect(array('controller' => 'users', 'action' => 'login'));
					}

				} else {

					// User exists, so we just force login
					// TODO: check if any data changed since last Facebook login, then update in our table

					// We need to update the Facebook token, once web tokens are short-term only
					$this->User->id = $user['User']['id'];
					$this->User->set('facebook_token', $token);
					$this->User->save();

					$user['User']['id'] = $this->User->id;
					$this->Auth->login($user);
					// $this->Session->write('Auth.User.id', $user['User']['id']);
					return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $this->User->id));

				}
				
			}

		} else {
			$fbLoginUrl = $facebook->getLoginUrl();
			$this->set(compact('fbLoginUrl'));
		}
		$this->set(compact('userid'));
	}


	public function dmcanotifications(){
		$userid = $this->getUserId();
		//debug($this->Auth);
		$facebook = new Facebook(array(
			'appId' => Configure::read('fb_app_id'),
			'secret' => Configure::read('fb_app_secret'),
			'allowSignedRequest' => false,
			
		));

		$browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		$this->set(compact('browserLanguage'));

		if(isset($this->params['url']['code'])) {

			$token = $facebook->getAccessToken();

			if (!empty($token)) {

				$userFbData = $facebook->getUser();
				$user_profile = '';

				try {
					$user_profile = $facebook->api('/me');
				} catch (FacebookApiException $e) {
					error_log($e);
					$userFbData = null;
				}

				$user = $this->User->find('first', array('conditions' => array('facebook_id' => $user_profile['id'])));

				if(empty($user)) {

					// User does not exist in DB, so we are going to create

					$this->User->create();
					$user['User']['facebook_id'] = $user_profile['id'];
					$user['User']['facebook_token'] = $token;
					$user['User']['name'] = $user_profile['name'];
					$user['User']['sex'] = $user_profile['gender'];
					$user['User']['login'] = $user_profile['username'];
					$user['User']['facebook'] = $user_profile['link'];
					$user['User']['role_id'] = 3;

					if($this->User->save($user)) {
						$user['User']['id'] = $this->User->id;
						$this->Auth->login($user);
						// $this->Session->write('Auth.User.id', $this->User->getLastInsertID());
						//return $this->redirect(array('action' => 'dashboard'));
						$this->Session->setFlash('', 'opening_lightbox_message');
						return $this->redirect(array('controller' => 'users', 'action' => 'edit', $this->User->id));
					} else {
						$this->Session->setFlash(__('There was some interference in your connection.'), 'error');
						return $this->redirect(array('controller' => 'users', 'action' => 'login'));
					}

				} else {

					// User exists, so we just force login
					// TODO: check if any data changed since last Facebook login, then update in our table

					// We need to update the Facebook token, once web tokens are short-term only
					$this->User->id = $user['User']['id'];
					$this->User->set('facebook_token', $token);
					$this->User->save();

					$user['User']['id'] = $this->User->id;
					$this->Auth->login($user);
					// $this->Session->write('Auth.User.id', $user['User']['id']);
					return $this->redirect(array('controller' => 'users', 'action' => 'dashboard', $this->User->id));

				}
				
			}

		} else {
			$fbLoginUrl = $facebook->getLoginUrl();
			$this->set(compact('fbLoginUrl'));
		}
		$this->set(compact('userid'));
	}
}
