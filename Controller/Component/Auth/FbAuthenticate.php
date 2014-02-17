<?php
require APP.'Vendor'.DS.'facebook'.DS.'php-sdk'.DS.'src'.DS.'facebook.php';

App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class FbAuthenticate extends BaseAuthenticate {

    public function authenticate(CakeRequest $request, CakeResponse $response) {

    	debug($request);
    	die();

		return true;
    }
}