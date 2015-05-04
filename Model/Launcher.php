<?php
App::uses('AppModel', 'Model');
/**
 * Launcher Model
 *
 * @property Mission $Mission
 */
class Launcher extends AppModel {

	public function createWithAttachments($data, $hasPrev = false, $id = null) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Attachment'][0]) && $data['Attachment'][0]['attachment']['name'] != '') {
        	foreach ($data['Attachment'] as $i => $image) {
                if (is_array($data['Attachment'][$i])) {
                    
                    // Force setting the `model` field to this model
                    $image['model'] = 'Launcher';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($image['foreign_key'])) {
                        unset($image['foreign_key']);
                    }
                    //$image['foreign_key'] = $data['Novel']['id'];

                }
            }
        }
        $insert['Launcher'] = $data['Launcher'];
        // debug($insert); die();
        //$data['Attachment'] = $image;

        // Try to save the data using Model::saveAll()
        if(!$hasPrev) {
        	$this->create();
        	if (!$this->save($insert)) {
         		return false;
        	}
        	$insert['Launcher']['id'] = $this->id;
        }
        else {
        	$this->id = $id;
        	$insert['Launcher']['id'] = $id;
        }

        if(isset($image)) {

        	$image['foreign_key'] = $insert['Launcher']['id'];
        	$photo['Attachment'] = $image;
            $this->Attachment->create();
	        if ($this->Attachment->save($photo)) {
	        	return true;
	        }
            unset($image);
	    }

        //return false;
        // Throw an exception for the controller
        throw new Exception(__("This post could not be saved. Please try again"));
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

	public $hasMany = array(
		'Attachment' => array(
	            'className' => 'Attachment',
	            'foreignKey' => 'foreign_key',
	            'conditions' => array(
	                'Attachment.model' => 'Launcher',
	            ),
	    )
	);
}
