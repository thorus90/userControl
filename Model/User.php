<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public function beforeSave($options = array())
    {
        parent::beforeSave($options = array());
        $this->data['User']['resetkey'] = Security::hash(mt_rand(),'md5',true);
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
		if (isset($this->data['User']['password_confirm']))
		{
		  unset($this->data['User']['password_confirm']);
		}
        return True;
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
            ),
            'alphaNumeric' => array
            (
                'rule' => array('alphaNumeric'),
                'required' => true,
                'message' => 'Als Benutzername nur Buchstaben und Zahlen!'
            )
        ),
        'password' => array
        (
            'required' => array
            (
                'rule' => array('notEmpty'),
                'required' => true,
                'message' => 'Ein Passwort wird benötigt!'
            )
        ),
		'password_confirm' => array
		(
			'required' => array
			(
				'rule' => array('notEmpty'),
				'required' => true,
				'message' => 'Ein Passwort wird benötigt!'
			),
			'match' => array
			(
				'rule' => array('validatePasswdConfirm'),
				'required' => true,
				'message' => 'Passwörter stimmen nicht überein'
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

	public function validatePasswdConfirm($data)
	{
		if ($this->data['User']['password'] !== $data['password_confirm'])
		{
		  return false;
		}
		return true;
	}
}
?>