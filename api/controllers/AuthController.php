<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use app\models\Auth;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    public function actionIndex() {
        $model = new Auth();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return "access-token: ".$token;
        } else {
            return $model;
        }
    }

    protected function verbs()
    {
        return [
            'index' => ['post'],
        ];
    }
}