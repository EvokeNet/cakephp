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
		'Permission',
		'Auth' => array(
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login','admin' => false),
				'authError' => 'Você não tem permissão para ver essa página'
		)
	);

	public $helpers = array(
		'Chosen.Chosen', 'Text'
	);

	public $user = null;
	public $lang = null;

      public $sex = array(
        0 => 'Male',
        1 => 'Female'
      );

      public $languages = array(
        'pt_BR' => 'Português',
        'en' => 'English',
        'es' => 'Español'
      );

	public $countries = array(
  	'BR' => 'Brasil',
  	'US' => 'United States',
      'AF' => 'Afganistan',
      'AL' => 'Albania',
      'DZ' => 'Algeria',
      'AS' => 'American Samoa',
      'AD' => 'Andorra',
      'AO' => 'Angola',
      'AI' => 'Anguilla',
      'AQ' => 'Antarctica',
      'AG' => 'Antigua and Barbuda',
      'AR' => 'Argentina',
      'AM' => 'Armenia',
      'AW' => 'Aruba',
      'AU' => 'Australia',
      'AT' => 'Austria',
      'AZ' => 'Azerbaijan',
      'BS' => 'Bahamas',
      'BH' => 'Bahrain',
      'BD' => 'Bangladesh',
      'BB' => 'Barbados',
      'BY' => 'Belarus',
      'BE' => 'Belgium',
      'BZ' => 'Belize',
      'BJ' => 'Benin',
      'BM' => 'Bermuda',
      'BT' => 'Bhutan',
      'BO' => 'Bolivia',
      'BA' => 'Bosnia and Herzegowina',
      'BW' => 'Botswana',
      'BV' => 'Bouvet Island',
      'IO' => 'British Indian Ocean Territory',
      'BN' => 'Brunei Darussalam',
      'BG' => 'Bulgaria',
      'BF' => 'Burkina Faso',
      'BI' => 'Burundi',
      'KH' => 'Cambodia',
      'CM' => 'Cameroon',
      'CA' => 'Canada',
      'CV' => 'Cape Verde',
      'KY' => 'Cayman Islands',
      'CF' => 'Central African Republic',
      'TD' => 'Chad',
      'CL' => 'Chile',
      'CN' => 'China',
      'CX' => 'Christmas Island',
      'CC' => 'Cocos (Keeling) Islands',
      'CO' => 'Colombia',
      'KM' => 'Comoros',
      'CG' => 'Congo',
      'CD' => 'Congo, the Democratic Republic of the',
      'CK' => 'Cook Islands',
      'CR' => 'Costa Rica',
      'CI' => 'Cote d\'Ivoire',
      'HR' => 'Croatia (Hrvatska)',
      'CU' => 'Cuba',
      'CY' => 'Cyprus',
      'CZ' => 'Czech Republic',
      'DK' => 'Denmark',
      'DJ' => 'Djibouti',
      'DM' => 'Dominica',
      'DO' => 'Dominican Republic',
      'TP' => 'East Timor',
      'EC' => 'Ecuador',
      'EG' => 'Egypt',
      'SV' => 'El Salvador',
      'GQ' => 'Equatorial Guinea',
      'ER' => 'Eritrea',
      'EE' => 'Estonia',
      'ET' => 'Ethiopia',
      'FK' => 'Falkland Islands (Malvinas)',
      'FO' => 'Faroe Islands',
      'FJ' => 'Fiji',
      'FI' => 'Finland',
      'FR' => 'France',
      'FX' => 'France, Metropolitan',
      'GF' => 'French Guiana',
      'PF' => 'French Polynesia',
      'TF' => 'French Southern Territories',
      'GA' => 'Gabon',
      'GM' => 'Gambia',
      'GE' => 'Georgia',
      'DE' => 'Germany',
      'GH' => 'Ghana',
      'GI' => 'Gibraltar',
      'GR' => 'Greece',
      'GL' => 'Greenland',
      'GD' => 'Grenada',
      'GP' => 'Guadeloupe',
      'GU' => 'Guam',
      'GT' => 'Guatemala',
      'GN' => 'Guinea',
      'GW' => 'Guinea-Bissau',
      'GY' => 'Guyana',
      'HT' => 'Haiti',
      'HM' => 'Heard and Mc Donald Islands',
      'VA' => 'Holy See (Vatican City State)',
      'HN' => 'Honduras',
      'HK' => 'Hong Kong',
      'HU' => 'Hungary',
      'IS' => 'Iceland',
      'IN' => 'India',
      'ID' => 'Indonesia',
      'IR' => 'Iran (Islamic Republic of)',
      'IQ' => 'Iraq',
      'IE' => 'Ireland',
      'IL' => 'Israel',
      'IT' => 'Italy',
      'JM' => 'Jamaica',
      'JP' => 'Japan',
      'JO' => 'Jordan',
      'KZ' => 'Kazakhstan',
      'KE' => 'Kenya',
      'KI' => 'Kiribati',
      'KP' => 'Korea, Democratic People\'s Republic of',
      'KR' => 'Korea, Republic of',
      'KW' => 'Kuwait',
      'KG' => 'Kyrgyzstan',
      'LA' => 'Lao People\'s Democratic Republic',
      'LV' => 'Latvia',
      'LB' => 'Lebanon',
      'LS' => 'Lesotho',
      'LR' => 'Liberia',
      'LY' => 'Libyan Arab Jamahiriya',
      'LI' => 'Liechtenstein',
      'LT' => 'Lithuania',
      'LU' => 'Luxembourg',
      'MO' => 'Macau',
      'MK' => 'Macedonia, The Former Yugoslav Republic of',
      'MG' => 'Madagascar',
      'MW' => 'Malawi',
      'MY' => 'Malaysia',
      'MV' => 'Maldives',
      'ML' => 'Mali',
      'MT' => 'Malta',
      'MH' => 'Marshall Islands',
      'MQ' => 'Martinique',
      'MR' => 'Mauritania',
      'MU' => 'Mauritius',
      'YT' => 'Mayotte',
      'MX' => 'Mexico',
      'FM' => 'Micronesia, Federated States of',
      'MD' => 'Moldova, Republic of',
      'MC' => 'Monaco',
      'MN' => 'Mongolia',
      'MS' => 'Montserrat',
      'MA' => 'Morocco',
      'MZ' => 'Mozambique',
      'MM' => 'Myanmar',
      'NA' => 'Namibia',
      'NR' => 'Nauru',
      'NP' => 'Nepal',
      'NL' => 'Netherlands',
      'AN' => 'Netherlands Antilles',
      'NC' => 'New Caledonia',
      'NZ' => 'New Zealand',
      'NI' => 'Nicaragua',
      'NE' => 'Niger',
      'NG' => 'Nigeria',
      'NU' => 'Niue',
      'NF' => 'Norfolk Island',
      'MP' => 'Northern Mariana Islands',
      'NO' => 'Norway',
      'OM' => 'Oman',
      'PK' => 'Pakistan',
      'PW' => 'Palau',
      'PA' => 'Panama',
      'PG' => 'Papua New Guinea',
      'PY' => 'Paraguay',
      'PE' => 'Peru',
      'PH' => 'Philippines',
      'PN' => 'Pitcairn',
      'PL' => 'Poland',
      'PT' => 'Portugal',
      'PR' => 'Puerto Rico',
      'QA' => 'Qatar',
      'RE' => 'Reunion',
      'RO' => 'Romania',
      'RU' => 'Russian Federation',
      'RW' => 'Rwanda',
      'KN' => 'Saint Kitts and Nevis',
      'LC' => 'Saint LUCIA',
      'VC' => 'Saint Vincent and the Grenadines',
      'WS' => 'Samoa',
      'SM' => 'San Marino',
      'ST' => 'Sao Tome and Principe',
      'SA' => 'Saudi Arabia',
      'SN' => 'Senegal',
      'SC' => 'Seychelles',
      'SL' => 'Sierra Leone',
      'SG' => 'Singapore',
      'SK' => 'Slovakia (Slovak Republic)',
      'SI' => 'Slovenia',
      'SB' => 'Solomon Islands',
      'SO' => 'Somalia',
      'ZA' => 'South Africa',
      'GS' => 'South Georgia and the South Sandwich Islands',
      'ES' => 'Spain',
      'LK' => 'Sri Lanka',
      'SH' => 'St. Helena',
      'PM' => 'St. Pierre and Miquelon',
      'SD' => 'Sudan',
      'SR' => 'Suriname',
      'SJ' => 'Svalbard and Jan Mayen Islands',
      'SZ' => 'Swaziland',
      'SE' => 'Sweden',
      'CH' => 'Switzerland',
      'SY' => 'Syrian Arab Republic',
      'TW' => 'Taiwan, Province of China',
      'TJ' => 'Tajikistan',
      'TZ' => 'Tanzania, United Republic of',
      'TH' => 'Thailand',
      'TG' => 'Togo',
      'TK' => 'Tokelau',
      'TO' => 'Tonga',
      'TT' => 'Trinidad and Tobago',
      'TN' => 'Tunisia',
      'TR' => 'Turkey',
      'TM' => 'Turkmenistan',
      'TC' => 'Turks and Caicos Islands',
      'TV' => 'Tuvalu',
      'UG' => 'Uganda',
      'UA' => 'Ukraine',
      'AE' => 'United Arab Emirates',
      'GB' => 'United Kingdom',
      'UM' => 'United States Minor Outlying Islands',
      'UY' => 'Uruguay',
      'UZ' => 'Uzbekistan',
      'VU' => 'Vanuatu',
      'VE' => 'Venezuela',
      'VN' => 'Viet Nam',
      'VG' => 'Virgin Islands (British)',
      'VI' => 'Virgin Islands (U.S.)',
      'WF' => 'Wallis and Futuna Islands',
      'EH' => 'Western Sahara',
      'YE' => 'Yemen',
      'YU' => 'Yugoslavia',
      'ZM' => 'Zambia',
      'ZW' => 'Zimbabwe'
      );

/**
* beforeFilter method
*
* @return void
*/
	public function beforeFilter() {
		//Determine language if not already determined
		$this->_checkBrowserLanguage();
		$this->language = $language = $this->getCurrentLanguage();

		//Info from the user that is currently logged in
		$this->set('loggedIn', $this->Auth->loggedIn());
		$cuser = $this->Auth->user();
		$loggedInUser = $this->Auth->user();

            $scores = $this->Permission->scores();

		$this->loadModel('Role');

		if(isset($loggedInUser)){
			$role = $this->Role->find('first', array('conditions' => array('id' => $loggedInUser['role_id'])))['Role']['score'];
			$loggedInUser['role'] = $role;
		}

		// CHECK IF USER TRIES TO ACCESS ADMIN PANEL
		if(isset($this->request->params['admin']) && $this->request->params['admin']){
			$options = array(
			'moderatorPrivilege' => false,
			'minimumRole' => 'ADMIN',
			'object' => null
			);

			if(!isset($loggedInUser) || !$this->Permission->hasPrivilege($options)){
				$this->redirect(array('controller' => 'users', 'action' => 'profile', $this->getUserId(),'admin' => false));
			}
		}

		//User definitions
		$userPoints = $this->getPoints($this->getUserId());
		$userLevel = $this->getLevel($userPoints); //level ID
		$userNextLevel = $this->getNextLevel($userLevel); //next level object
		$userLevelPercentage = $this->getLevelPercentage($userPoints, $userLevel);

		//Check if the user has answered the assessment questionnaire and redirect to it, if not
		$this->loadModel('SuperheroIdentity');

		$superhero = $this->SuperheroIdentity->find('first', array(
			'conditions' => array(
				'id' => $cuser['superhero_identity_id']
			)
		));

		// debug($cuser);
		// debug($superhero);
		// debug($this->request->params['action']);
		// die();

		// check if the user has answered the asessment questionnaire and isn't doing it right now
		if(empty($superhero) && $this->request->params['action'] != 'matching'
							 && $this->request->params['action'] != 'login'  //also, if  the user is loging in or out
							 && $this->request->params['action'] != 'logout' // we have to allow it
							 && $this->request->params['action'] != 'register' // also if user is registering
                                           && $this->request->params['action'] != 'recover_password' // also if user is trying to recover password
							 && $this->request->params['action'] != 'matching_results'){

			return $this->redirect(array('controller' => 'users', 'action' => 'matching', $this->getUserId(),'admin' => false));
		}

		$this->set(compact('userNotifications', 'userPoints', 'userLevel', 'userNextLevel', 'userLevelPercentage', 'cuser', 'loggedInUser', 'language','scores'));
	}


/**
 * If no language was defined, read the browser language and sets the website language to it if available
 *
 */
	protected function _checkBrowserLanguage(){
		if (!$this->Session->check('Config.language')){
			//Languages supported in Evoke
			$supported_languages = Configure::read('Config.supported_languages');

			//Language(s) registered in the user's browser
			$languageHeader = $this->request->header('Accept-language');

			$lang = 'en';
			if ($languageHeader) {
				//Get just 1st language
				$languages = explode(',', $languageHeader);
				if (count($languages) > 0) {
					$lang = $languages[0];
				}
				else {
					$lang = substr($languageHeader, 0, 2);
				}
			}

			//Browser language if it is supported
			if (in_array($lang, $supported_languages)) {
				$this->Session->write('Config.language', $lang);
			}
			//Default: spanish (for the playtest)
			else {
				$this->Session->write('Config.language', 'en');
			}
		}

		Configure::write('Config.language', $this->Session->read('Config.language'));
	}


/**
 * Return current language in the platform
 *
 * @return string Current language registered in CakeSession
 */
	public function getCurrentLanguage(){
		return CakeSession::read('Config.language');
	}

/**
 * Change current language in the platform
 *
 * @param string Language to be registered as current language in CakeSession
 */
	public function changeLanguage ($lang) {
		$this->autoRender = false;
		$this->Session->write('Config.language', $lang);

		$this->redirect($this->referer()); //in order to redirect the user to the page from which it was called
	}

	public function isAuthorized($user = null) {

		if (!empty ($this->accessLevels)) {

			$currentAction = $this->params['action'];

			if(!empty ($this->accessLevels[$currentAction])) {
				$accessLevel = $this->accessLevels[$currentAction];
			} else if(!empty ($this->accessLevels['*'])) {
				$accessLevel = $this->accessLevels['*'];
			}

			if(!empty ($accessLevel)) {
				return $this->UserRole->is($accessLevel);
			}

			// Authorised actions
			if (in_array($this->action, array('changePassword'))) {
				$id = $this->request->params['pass'][0];

				if($this->{$this->modelClass}->field('user_id', array('user_id' => $id)) == $this->Auth->user('user_id'))
					return true;
			}

			// Will break out on this call
			$this->Session->setFlash(__('Você não está autorizado a visualizar esta página'));
			$this->redirect(array('controller' => 'users', 'action' => 'changePassword', $user['user_id'],'admin' => false));
			return false;

		}

		$this->setFlash(__('Você não tem permissão para ver essa página.'));
		return false;

	}

	public function getNotificationsNumber($user_id){

		$this->loadModel('Notification');
		$all = $this->Notification->find('all', array(
			'conditions' => array(
				'Notification.user_id' => $user_id,
				'Notification.status' => 0,
			),
			'order' => array(
				'Notification.created DESC'
			)
		));

		$count = array();

		foreach($all as $a => $n){
			if(($n['Notification']['origin'] == 'like') || ($n['Notification']['origin'] == 'commentEvidence')
				|| ($n['Notification']['origin'] == 'commentEvokation') || ($n['Notification']['origin'] == 'voteEvokation')
				|| ($n['Notification']['origin'] == 'gritBadge')):
				array_push($count, array('Notification.id' => $n['Notification']['id']));
			endif;
		}

		return $count;

	}

	public function saveNotifications($notes, $user_id){
		$this->loadModel('Notification');

		$all = $this->Notification->find('all', array(
			'conditions' => array(
				'Notification.user_id' => $user_id,
				'OR' => $notes
			),
			'order' => array(
				'Notification.created DESC'
			)
		));

		$count = array();

		foreach($all as $n){
			$this->Notification->id = $n['Notification']['id'];
			$this->Notification->saveField('status', 1);
		}

	}

	/**
	 * Gets the total number of points of a user
	 * Uses a function in the User model
	 * @param int $user_id User id
	 * @return int Number of points
	 */
	public function getPoints($user_id){
		$this->loadModel('User');
		$userPoints = $this->User->getTotalPoints($user_id);
		return $userPoints;
	}

	/**
	 * Gets the level (just the number) that corresponds to a certain number of points
	 * @param int $userPoints Number of points
	 * @return int Level
	 */
	public function getLevel($userPoints){
		$this->loadModel('Level');
		$level = $this->Level->getLevel($userPoints);
		// return $level['Level']['level'];
	}

	/**
	 * Gets the next level
	 * @param int $userLevel Id of the current level
	 * @return object Next level (if there is one - else null)
	 */
	public function getNextLevel($userLevel){
		$this->loadModel('Level');

		$nextLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $userLevel+1)));

		//There is a next level
		if (isset($nextLevel['Level']))
			return $nextLevel['Level'];
		else
			return null;
	}




	public function getUserImage($userid) {

	}

	public function getLevelPercentage($userPoints, $userLevel){


		// $this->loadModel('Level');
		//
		// $thisLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $userLevel+1)));
		//
		// if(!empty($thisLevel))
		// 	$percentage = round(($userPoints/$thisLevel['Level']['points']) * 100);
		// else
		// 	$percentage = 0;
		//
		// return $percentage;

		$this->loadModel('Level');

		$thisLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $userLevel+1)));

		/*if(!empty($thisLevel))
			$percentage = round(($userPoints/$thisLevel['Level']['points']) * 100);
		else
			$percentage = 0;
			*/

		//return $percentage;
			return 0;

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
		if(isset($currentuser['role'])){

			return $currentuser['role'];
		}

		$role_score = $this->Role->find('first',array('id' => $currentuser['role_id']))['Role']['score'];

		return $role_score;
	}

/**
* getCountries method
*
* @return array
*
* returns short name related to country
*
*/
  function getCountry($country){
	return array_search($country, $this->countries);
  }

/**
* getCountries method
*
* @return array
*
* returns country related to its short name.
*
*/
  function getCountryValue($country){
  	return $this->countries[$country];
  }

}
