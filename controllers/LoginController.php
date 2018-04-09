<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\Authorization;

class LoginController extends Controller
{
    public $layout ='signup';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','logout'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $model = new Authorization;
        $model->scenario = Authorization::SCENARIO_LOGIN;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->user->login($user)) {
                    return $this->goHome();
                }
            }
            else {
                 Yii::$app->session->setFlash('failure', "Неверные имя или пароль");
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}