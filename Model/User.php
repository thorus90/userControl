<?php
class User extends AppModel {
    public function beforeSave($options = array())
    {
        parent::beforeSave($options = array());
        $this->data['User']['resetkey'] = Security::hash(mt_rand(),'md5',true);
        return True;
    }

    public $displayField = 'user';
    public $recursive = -1;
    public $_schema = array
    (
        'language' => array
        (
            'length' => 3
        )
    );

    public $validate = array(
        'user' => array(
            'required' => array
            (
                'rule' => array('notEmpty'),
                'message' => 'Ein Benutzername wird benötigt'
            ),
            'unique' => array
            (
                'rule' => array('isUnique'),
                'message' => 'Benutzername bereits vergeben!'
            )
        ),
        'password' => array
        (
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Ein Passwort wird benötigt!'
            )
        ),
        'role' => array
        (
            'valid' => array
            (
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Bitte eine gültige Rolle eingeben',
                'allowEmpty' => false
            )
        ),
        'email' => array
        (
            'rule' => array('email'),
            'message' => 'Bitte geben Sie eine gültige E-Mail Adresse an',
            'allowEmpty' => false
        )
    );
}
?>