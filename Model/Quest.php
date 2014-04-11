<?php
App::uses('AppModel', 'Model');
/**
 * Quest Model
 *
 * @property Mission $Mission
 * @property Phase $Phase
 * @property Evidence $Evidence
 */
class Quest extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public $actsAs = array(
        'Containable',
        'Media.Media' => array(
            // You can set up the path where your medias will be saved (optional)
            'path' => 'img/uploads/%y/%m/%f',
            'extensions' => array('jpg', 'png', 'avi', 'mp4')
        )
    );

	public function createWithAttachments($data, $hasPrev = false, $id = null) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Attachment'][0]) || !empty($data['Attachment'][1])) {
        	foreach ($data['Attachment'] as $i => $image) {
                if($i == 'Old') continue; //if its an already existing attachment, ignore it
                if (is_array($data['Attachment'][$i])) {
                    // Force setting the `model` field to this model
                    $image['model'] = 'Quest';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($image['foreign_key'])) {
                        unset($image['foreign_key']);
                    }

                    $images[] = $image;
                }
            }
        }
        $data['Attachment'] = $images;

        // Try to save the data using Model::saveAll()
        if(!$hasPrev) $this->create();
        else {
        	$this->id = $id;
        	$data['Quest']['id'] = $id;
        }
        if ($this->saveAll($data)) {
            return true;
        }
        return false;
        // Throw an exception for the controller
        //throw new Exception(__("This post could not be saved. Please try again"));
    }

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'mission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Phase' => array(
			'className' => 'Phase',
			'foreignKey' => 'phase_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'quest_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'Attachment.model' => 'Quest',
            ),
        ),
	);

//
	public $hasOne = array(
		'Questionnaire' => array(
			'className' => 'Questionnaire',
			'foreignKey' => 'quest_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
