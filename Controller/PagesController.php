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
        $this->Auth->allow('*');
    }

  public function display(){
		$lang = $this->getCurrentLanguage();
		$video_url = 'http://player.vimeo.com/video/94984840';
		if ($lang == 'es')
			$video_url = 'http://player.vimeo.com/video/93164917';

		$this->set(compact('video_url'));

  }

	public function reportissue(){
	}

	public function terms(){
	}
}
