<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Articles;
use app\models\Users;
use app\models\Categories;
use app\components\LayoutInit;
use app\components\Pages;

class PostsController extends Controller {
    public $layout = 'blog';

    public function init() {
        $this->initData($this);
    }

    public function behaviors(){
        return [
            LayoutInit::ClassName(),
            Pages::ClassName()
        ];
    }

    public function actionCategory($id) {
        $category = Categories::findOne(['name' => $id]);
        $articles = Articles::find()->where(['category' => $category]);
        $this->initPages($articles);
        return $this->render('@app/views/articles/articles', 
            ['articless' => $this->articles, 'pages' => $this->pages]);
    }

    public function actionUser($id) {
        $author = Users::findOne(['username' => $id]);
        $articles = Articles::find()->where(['author_id' => $author]);
        $this->initPages($articles);
        return $this->render('@app/views/articles/articles', 
            ['articless' => $this->articles, 'pages' => $this->pages]);
    }
}