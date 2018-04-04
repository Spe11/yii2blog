<?php

namespace app\models;
 
use Yii;
use yii\base\Model;
 
class Authorization extends Model
{
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';
    
    public $username;
    public $password;

    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['username', 'password'],
            self::SCENARIO_REGISTER =>  ['username', 'password']
        ];
    }
 
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Имя уже занято', 'on' => self::SCENARIO_REGISTER],
            ['username', 'string', 'min' => 3, 'max' => 20],
            ['password', 'required'],
            ['password', 'string', 'min' => 5],
        ];
    }

    public function attributeLabels() {
        return [
            'username' =>'Имя пользователя',
            'password' =>'Пароль'
        ];
    }
 
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }
 
        $user = new User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
    
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        if($user = User::findByUsername($this->username)) {
            if($user->validatePassword($this->password)) {
                return $user;
            }
        }
        return null;
    }  
}