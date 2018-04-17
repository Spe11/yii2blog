<?php

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class ArticleController extends ActiveController
{
    public $modelClass = 'app\models\Article';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        $behaviors['authenticator'] = [
             'class' => HttpBearerAuth::className(),
         ];
         $behaviors['access'] = [
             'class' => AccessControl::className(),
             'only' => ['create', 'update', 'delete'],
             'rules' => [
                 [
                     'allow' => true,
                     'roles' => ['@'],
                 ],
             ],
         ];
        return $behaviors;
    }   

    public function actionUpdate()
    {
        /* $model = $this->findModel();
        if(Yii::$app->user->can('owner', ['model' => $model])) {
            return 'yes';
        }
        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return $model; */
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete'])) {
            if (!Yii::$app->user->can('manage', ['model' => $model])) {
                throw  new ForbiddenHttpException('Forbidden.');
            }
        }
        else return 'yes';
    }
}