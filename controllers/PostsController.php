<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\User;
use app\models\Category;
use app\components\LayoutInit;
use app\components\Pages;

class PostsController extends Controller {
    public $layout = 'blog';

    public function init() {
        $this->initSidebar($this);
    }

    public function behaviors(){
        return [
            LayoutInit::ClassName(),
            Pages::ClassName()
        ];
    }

    public function actionCategory($id = null) {
        $category = Category::findOne(['name' => $id]);

        return $this->articleByCategory($category);
    }

    public function actionUser($id = null) {
        $author = User::findOne(['username' => $id]);

        return $this->articleByUser($user);
    }

    private function articleByCategory($category) {
        $articles = Article::find()->where(['category' => $category]);
        $this->initPages($articles);
        return $this->render('@app/views/articles/articles', 
            ['articles' => $this->articles, 'pages' => $this->pages]);
    }

    private function articleByUser($user) {
        $articles = Article::find()->where(['author_id' => $author]);
        $this->initPages($articles);
        return $this->render('@app/views/articles/articles', 
            ['articles' => $this->articles, 'pages' => $this->pages]);
    }
}