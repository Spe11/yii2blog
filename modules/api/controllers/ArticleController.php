<?php

namespace app\modules\api\controllers;

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