<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity {
    public function beforeSave($options = array())
    {
        parent::beforeSave($options = array());
        $this->data['User']['resetkey'] = Security::hash(mt_rand(),'md5',true);
        if (isset($this->data['User']['password_confirm']))
        {
            unset($this->data['User']['password_confirm']);
        }
        return True;
    }

    protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}
?>
