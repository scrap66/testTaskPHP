<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['username', 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],

        ];
    }

    public function register()
    {
        if ($this->validate()) {
                $user = new User();
                $user->username = $this->username;
                $user->password = $this->password;
                if ($user->save()) return true;
                return false;
        }
    }
}


