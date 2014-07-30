<?php

class User extends AppModel {

    public function beforeSave($options = array())
    {
        parent::beforeSave($options = array());
        $this->data['User']['resetkey'] = Security::hash(mt_rand(),'md5',true);
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password'], 'blowfish', false);
        }
        return true;
    }

    public $validate = array(
        'username' => array(
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
