<?php

namespace app\models;

use app\models\User;
use yii\base\Model;

class Auth extends Model
{
    public $username;
    public $password;

    private $user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function auth()
    {
        if ($this->validate()) {
            $model = new User;
            $model->token = \Yii::$app->security->generateRandomString();
            return $token->save() ? $token : null;
        } else {
            return null;
        }
    }

    protected function getUser()
    {
        if ($this->user === null) {
            $this->user = User::findByUsername($this->username);
        }
        return $this->user;
    }
}
