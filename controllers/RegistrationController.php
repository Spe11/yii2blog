<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Authorization;

class RegistrationController extends Controller 
{
    public $layout = 'signup';

    public function actionIndex() {
        $model = new Authorization;
        $model->scenario = Authorization::SCENARIO_REGISTER;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                if (Yii::$app->user->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('registration', [ 'model' => $model]);
    }
}