<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 * 		//...
 * ));
 *
 */

Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Supported languages
 */
Configure::write('Config.supported_languages', array('en', 'es'));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

/**
 * Amazon AccessKey for file upload
 */
Configure::load('amazon');

require APP . '/Vendor/autoload.php';

spl_autoload_unregister(array('App', 'load'));
spl_autoload_register(array('App', 'load'), true, true);

CakePlugin::loadAll(array(
	'bootstrap' => true,
	// 'Optimum' => array('routes' => true)
));

/**
 * Evoke Config
 */
Configure::load('evoke');

/**
 * Events
 */
App::uses('CakeEventManager', 'Event');


/**
 * Configures Optimum Plugin
 * forum_filters: each forum can be associated to project-specific models
 */
Configure::write('Optimum.settings', array(
	'forum_filters' => array (
		'Mission' => array (
			'model' => 'Mission',
			'foreign_key' => 'mission_id'
		),
		'Phase' => array (
			'model' => 'Phase',
			'foreign_key' => 'phase_id'
		)
	)
	//,'discussion_tags' => array('Quests','Topic') //Possibilidade futura
));
