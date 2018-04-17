<?php

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use app\models\Article;
use app\models\Image;
use yii\helpers\Url;

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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        return $actions;
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->getBodyParams();
        $model = new Article;
        $model->author_id = Yii::$app->user->id;
        $model->title = $params['title'];
        $model->content = $params['title'];
        $model->date = $params['date'];
        $model->category = $params['category'];
        $image = new Image;
        $image->uploadFromBase64($params['picture'], $model);
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Ошибка создания');
        }
        return $model;
    }

    public function actionUpdate()
    {
        if (!Yii::$app->user->can('manage', ['model' => $model])) {
            throw  new ForbiddenHttpException('Запрещено');
        }
        $params = Yii::$app->request->queryParams;
        $id = $params['id'];
        $model = Article::find(['id' => $id])->one();
        $model->author_id = Yii::$app->user->id;
        $model->title = $params['title'];
        $model->content = $params['title'];
        $model->date = $params['date'];
        $model->category = $params['category'];
        $image = new Image;
        $image->uploadFromBase64($params['picture'], $model);
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Ошибка обновления');
        }
        return $model;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'delete') {
            if (!Yii::$app->user->can('manage', ['model' => $model])) {
                throw  new ForbiddenHttpException('Запрещено');
            }
        }
    }
}