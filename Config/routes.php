<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 * ...and connect the rest of 'Pages' controller's URLs.
 */
//	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
    
    // Router::connect('/', array('controller' => 'users', 'action' => 'login'));
    
    Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
    
	Router::connect(
			'/login',
			array('controller' => 'users', 'action' => 'login')
	);
    
    Router::connect(
			'/register',
			array('controller' => 'users', 'action' => 'register')
	);

	Router::connect(
    	'/recover_password',
    	array('controller' => 'users', 'action' => 'recover_password')
	);

	Router::connect(
    	'/fbLogin',
    	array('controller' => 'users', 'action' => 'fbLogin')
	);

	Router::connect(
    	'/googleLogin',
    	array('controller' => 'users', 'action' => 'googleLogin')
	);

	Router::connect(
    	'/terms',
    	array('controller' => 'pages', 'action' => 'terms')
	);

	Router::connect(
    	'/reportissue',
    	array('controller' => 'pages', 'action' => 'reportissue')
	);

	Router::connect(
    	'/DMCAnotifications',
    	array('controller' => 'pages', 'action' => 'dmcanotifications')
	);

	//if (!defined('WEB_ROOT')){
	//	define('WEB_ROOT', "http://".$_SERVER['HTTP_HOST']."/yourdomainname/images/");
	//}

/*	Router::connect(
    	'/admin/*',
    	array('controller' => 'panels')
	);

	Router::connect(
    	'/admin/:action/*',
    	array('controller' => 'panels')
	);
*/
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
