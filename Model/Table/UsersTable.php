<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'Ein Benutzername wird benoetigt')
            ->add('username', 'usernameUnique', [ 'rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Benutzername bereits vergeben!' ])
            ->add('username', 'usernameAlphaNumeric', [ 'rule' => 'alphaNumeric', 'message' => 'Als Benutzername nur Buchstaben und Zahlen!' ])
            ->notEmpty('password', 'Ein Passwort wird benoetigt')
            ->notEmpty('password_confirm', 'Ein Passwort wird benoeigt!')
            ->add('password', 'passwordMatch', [ 'rule' => [ 'compareWith', 'password_confirm' ] , 'message' => 'Passwoerter stimmen nicht  ueberein' ])
            ->add('email', 'emailFormat', [ 'rule' => 'email', 'message' => 'Bitte geben Sie eine gültige E-Mail Adresse an' ])
        ;
    }

}
?>
