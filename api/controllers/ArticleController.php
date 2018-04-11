<?php

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

class ArticleController extends ActiveController
{
    public $modelClass = 'app\models\Article';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON ;
        return $behaviors;
    }
}