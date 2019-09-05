<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login'], 'string'],
            [['login'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'login'],
            [['login', 'password'], 'required'],
        ];
    }

    /**
     * @return bool
     */
    public function signup()
    {
        if ($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;

            return $user->save(false);
        }

        return false;
    }
}