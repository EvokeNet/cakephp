<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 */
class Attachment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $actsAs = array(
        'Upload.Upload' => array(
            'attachment' => array(
                'thumbnailSizes' => array(
                    'xvga' => '1024x768',
                    'vga' => '640x480',
                    'thumb' => '80x80',
                ),
            ),
        ),
    );

    public $belongsTo = array(
        'Quest' => array(
            'className' => 'Quest',
            'foreignKey' => 'foreign_key',
        ),
        'Mission' => array(
            'className' => 'Mission',
            'foreignKey' => 'foreign_key',
        ),
        'Dossier' => array(
            'className' => 'Dossier',
            'foreignKey' => 'foreign_key',
        ),
        'Evidence' => array(
            'className' => 'Evidence',
            'foreignKey' => 'foreign_key',
        ),
        'Badge' => array(
            'className' => 'Badge',
            'foreignKey' => 'foreign_key',
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'foreign_key',
        ),
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'foreign_key',
        ),
        'Novel' => array(
            'className' => 'Novel',
            'foreignKey' => 'foreign_key',
        )
    );
}
