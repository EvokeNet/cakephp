<?php
App::uses('AppModel', 'Model');
/**
 * Dossier Model
 *
 * @property Mission $Mission
 */
class Dossier extends AppModel {


	public function createWithAttachments($data, $hasPrev = false, $id = null) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Attachment'][0]) || !empty($data['Attachment'][1])) {
        	foreach ($data['Attachment'] as $i => $image) {
                if($i == 'Old') continue; //if its an already existing attachment, ignore it
                if (is_array($data['Attachment'][$i])) {
                    // Force setting the `model` field to this model
                    $image['model'] = 'Dossier';
                    // debug($data); die();
                    $image['language'] = $data['Dossier']['language'];
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
        	$data['Dossier']['id'] = $id;
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
		)
	);


	/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Attachment' => array(
	            'className' => 'Attachment',
	            'foreignKey' => 'foreign_key',
	            'conditions' => array(
	                'Attachment.model' => 'Dossier',
	            ),
	    )
	);
}
