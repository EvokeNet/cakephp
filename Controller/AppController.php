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
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
						'authError' => 'Você não tem permissão para ver essa página'
        ),
				'UserRole'
    );

    public $helpers = array(
        'Chosen.Chosen', 'Text'
    );

    public $user = null;
    public $lang = null;

		public $accessLevels = array(
        '*' => 'admin',
        '*' => 'manager',
				'*' => 'user'
    );

/**
* beforeFilter method
*
* @return void
*/
	public function beforeFilter() {
				$this->set('loggedIn', $this->Auth->loggedIn());
				//$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard');

				$this->_checkBrowserLanguage();

				//Info from the user that is currently logged in
				$cuser = $this->Auth->user();
				$loggedInUser = $this->Auth->user();

				$userPoints = $this->getPoints($this->getUserId());
				$userLevel = $this->getLevel($userPoints); //level ID
				$userNextLevel = $this->getNextLevel($userLevel); //next level object
				$userLevelPercentage = $this->getLevelPercentage($userPoints, $userLevel);

				if (!empty($this->accessLevels)) {
						$this->Auth->authorize = 'Controller';
						$this->Auth->deny();
				} else {
						$this->Auth->allow();
				}

				//$userNotifications = $this->getNotificationsNumber($this->getUserId());

				$this->set(compact('userNotifications', 'userPoints', 'userLevel', 'userNextLevel', 'userLevelPercentage', 'cuser', 'loggedInUser'));
		}

		public function isAuthorized($user = null) {

        if (!empty ($this->accessLevels)) {

            $currentAction = $this->params['action'];

            if(!empty ($this->accessLevels[$currentAction])) {
                $accessLevel = $this->accessLevels[$currentAction];
            } else if(!empty ($this->accessLevels['*'])) {
                $accessLevel = $this->accessLevels['*'];
            }

            // debug($this->UserRole->is($accessLevel));
            // debug('hey');

            // if($this->UserRole->is($accessLevel)){
            //     return true;
            //     debug('ops');

            // } else{
            //     debug('de');
            //     $this->Session->setFlash(__('Você não está autorizado a visualizar esta página'));
            //     $this->redirect(array('controller' => 'users', 'action' => 'view', $this->Auth->user('user_id')));
            //     return false;
            // }

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
            $this->redirect(array('controller' => 'users', 'action' => 'changePassword', $user['user_id']));
            return false;

        }

        $this->setFlash(__('Você não tem permissão para ver essa página.'));
        return false;

    }

/**
 * langToLocale method
 *
 * @return array
 */
    public function langToLocale($language) {
        static $language_codes = array(
            'ab'=>'abk', // Abkhazian
            'af'=>'afr', // Afrikaans
            'ak'=>'aka', // Akan
            'sq'=>'alb', // Albanian
            'am'=>'amh', // Amharic
            'ar'=>'ara', // Arabic
            'an'=>'arg', // Aragonese
            'hy'=>'arm', // Armenian
            'as'=>'asm', // Assamese
            'av'=>'ava', // Avaric
            'ay'=>'aym', // Aymara
            'az'=>'aze', // Azerbaijani
            'bm'=>'bam', // Bambara
            'eu'=>'baq', // Basque
            'be'=>'bel', // Belarusian
            'bn'=>'ben', // Bengali
            'bs'=>'bos', // Bosnian
            'br'=>'bre', // Breton
            'bg'=>'bul', // Bulgarian
            'my'=>'bur', // Burmese
            'ca'=>'cat', // Catalan
            'ch'=>'cha', // Chamorro
            'ce'=>'che', // Chechen
            'zh-CN'=>'chi_hans', // Chinese (Simplified)
            'zh-TW'=>'chi_hant', // Chinese (Traditional)
            'cv'=>'chv', // Chuvash
            'kw'=>'cor', // Cornish
            'co'=>'cos', // Corsican
            'cr'=>'cre', // Cree
            'cs'=>'cze', // Czech
            'da'=>'dan', // Danish
            'dv'=>'div', // Dhivehi
            'nl'=>'dut', // Dutch
            'dz'=>'dzo', // Dzongkha
            'en'=>'eng', // English
            'et'=>'est', // Estonian
            'ee'=>'ewe', // Ewe
            'fo'=>'fao', // Faroese
            'fj'=>'fij', // Fijian
            'fi'=>'fin', // Finnish
            'fr-CA'=>'fre_ca', //   French (Canadian)
            'fr-FR'=>'fre_fr', //   French (French)
            'fy'=>'fry', // Western Frisian
            'ff'=>'ful', // Fulah
            'ka'=>'geo', // Georgian
            'de'=>'ger', // German
            'gd'=>'gla', // Scottish Gaelic
            'ga'=>'gle', // Irish
            'gl'=>'glg', // Galician
            'gv'=>'glv', // Manx
            'el'=>'gre', // Modern Greek (1453-)
            'gn'=>'grn', // Guarani
            'gu'=>'guj', // Gujarati
            'ht'=>'hat', // Haitian
            'ha'=>'hau', // Hausa
            'he'=>'heb', // Hebrew
            'hz'=>'her', // Herero
            'hi'=>'hin', // Hindi
            'ho'=>'hmo', // Hiri Motu
            'hu'=>'hun', // Hungarian
            'ig'=>'ibo', // Igbo
            'is'=>'ice', // Icelandic
            'ii'=>'iii', // Sichuan Yi
            'iu'=>'iku', // Inuktitut
            'id'=>'ind', // Indonesian
            'ik'=>'ipk', // Inupiaq
            'it'=>'ita', // Italian
            'jv'=>'jav', // Javanese
            'ja'=>'jpn', // Japanese
            'kl'=>'kal', // Kalaallisut
            'kn'=>'kan', // Kannada
            'ks'=>'kas', // Kashmiri
            'kr'=>'kau', // Kanuri
            'kk'=>'kaz', // Kazakh
            'km'=>'khm', // Central Khmer
            'ki'=>'kik', // Kikuyu
            'rw'=>'kin', // Kinyarwanda
            'ky'=>'kir', // Kirghiz
            'kv'=>'kom', // Komi
            'kg'=>'kon', // Kongo
            'ko'=>'kor', // Korean
            'kj'=>'kua', // Kuanyama
            'ku'=>'kur', // Kurdish
            'lo'=>'lao', // Lao
            'lv'=>'lav', // Latvian
            'li'=>'lim', // Limburgan
            'ln'=>'lin', // Lingala
            'lt'=>'lit', // Lithuanian
            'lb'=>'ltz', // Luxembourgish
            'lu'=>'lub', // Luba-Katanga
            'lg'=>'lug', // Ganda
            'mk'=>'mac', // Macedonian
            'mh'=>'mah', // Marshallese
            'ml'=>'mal', // Malayalam
            'mi'=>'mao', // Maori
            'mr'=>'mar', // Marathi
            'ms'=>'may', // Malay (macrolanguage)
            'mg'=>'mlg', // Malagasy
            'mt'=>'mlt', // Maltese
            'mn'=>'mon', // Mongolian
            'na'=>'nau', // Nauru
            'nv'=>'nav', // Navajo
            'nr'=>'nbl', // South Ndebele
            'nd'=>'nde', // North Ndebele
            'ng'=>'ndo', // Ndonga
            'ne'=>'nep', // Nepali
            'nb'=>'nob', // Norwegian BokmŒl
            'no'=>'nor', // Norwegian
            'ny'=>'nya', // Nyanja
            'oc'=>'oci', // Occitan (post 1500)
            'oj'=>'oji', // Ojibwa
            'or'=>'ori', // Oriya
            'om'=>'orm', // Oromo
            'os'=>'oss', // Ossetian
            'pa'=>'pan', // Panjabi
            'fa'=>'per', // Persian
            'pl'=>'pol', // Polish
            'pt-BR'=>'por_br', //   Portuguese (Brazil)
            'pt-PT'=>'por_pt', //   Portuguese (Portugal)
            'ps'=>'pus', // Pushto
            'qu'=>'que', // Quechua
            'rm'=>'roh', // Romansh
            'ro'=>'rum', // Romanian
            'rn'=>'run', // Rundi
            'ru'=>'rus', // Russian
            'sg'=>'sag', // Sango
            'si'=>'sin', // Sinhala
            'sk'=>'slo', // Slovak
            'sl'=>'slv', // Slovenian
            'se'=>'sme', // Northern Sami
            'sm'=>'smo', // Samoan
            'sn'=>'sna', // Shona
            'sd'=>'snd', // Sindhi
            'so'=>'som', // Somali
            'st'=>'sot', // Southern Sotho
            'es'=>'spa', // Spanish
            'sc'=>'srd', // Sardinian
            'ss'=>'ssw', // Swati
            'su'=>'sun', // Sundanese
            'sw'=>'swa', // Swahili (macrolanguage)
            'sv'=>'swe', // Swedish
            'ty'=>'tah', // Tahitian
            'ta'=>'tam', // Tamil
            'tt'=>'tat', // Tatar
            'te'=>'tel', // Telugu
            'tg'=>'tgk', // Tajik
            'tl'=>'tgl', // Tagalog
            'th'=>'tha', // Thai
            'bo'=>'tib', // Tibetan
            'ti'=>'tir', // Tigrinya
            'to'=>'ton', // Tonga (Tonga Islands)
            'tn'=>'tsn', // Tswana
            'ts'=>'tso', // Tsonga
            'tk'=>'tuk', // Turkmen
            'tr'=>'tur', // Turkish
            'tw'=>'twi', // Twi
            'ug'=>'uig', // Uighur
            'uk'=>'ukr', // Ukrainian
            'ur'=>'urd', // Urdu
            'uz'=>'uzb', // Uzbek
            've'=>'ven', // Venda
            'vi'=>'vie', // Vietnamese
            'cy'=>'wel', // Welsh
            'wa'=>'wln', // Walloon
            'wo'=>'wol', // Wolof
            'xh'=>'xho', // Xhosa
            'yi'=>'yid', // Yiddish
            'yo'=>'yor', // Yoruba
            'za'=>'zha', // Zhuang
            'zu'=>'zul'  // Zulu
        );

        return $language_codes[$language];

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

        debug($notes);
        
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

    public function getPoints($user_id){

        $this->loadModel('Point');
        $all = $this->Point->find('all', array('conditions' => array('Point.user_id' => $user_id)));

        $points = 0;
        
        foreach($all as $a){
            $points += $a['Point']['value'];
        }

        return $points;

    }

    /**
     * Gets the next level number
     * @param int $userLevel Id of the current level
     * @return int Next level number
     */
    public function getLevel($userPoints){

        $this->loadModel('Level');

        $levels = $this->Level->find('all', array('order' => array('Level.points ASC')));

        $level = 0;

        foreach($levels as $l):
            if ($l['Level']['points'] <= $userPoints) {
                $level = $l['Level']['level'];
            } else {
                break;
            }
        endforeach;
        
        return $level;
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

    // public function canUploadMedias($model, $id) {
    //     return true;
    // }
}
