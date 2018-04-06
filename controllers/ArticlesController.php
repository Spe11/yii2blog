<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Article;
use app\models\Commentary;
use app\components\LayoutInit;
use app\components\Pages;

class ArticlesController extends Controller
{
    public $layout = 'blog';

    public function init() {
        $this->initSidebar($this);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function behaviors(){
        return [
            LayoutInit::ClassName(),
            Pages::ClassName()
        ];
    }

    public function actionShow() { 
        $this->addComment();

        $id = Yii::$app->request->get('id');

        return $this->articleById($id);
    }

    public function actionAll()
    {
        return $this->allArticles();
    }

    public function actionArchive($month, $year)
    {
       return $this->articleByDate($month, $year);
    }

    private function addComment() {
        $commentary = new Commentary;
        if ($commentary->load(Yii::$app->request->post()) && $commentary->save()) {
            return $this->refresh();
        }
    }

    private function articleById($id) {
        $article = Article::find()->where(['id' => $id])->one();
        $commentaries = $article->commentaries;
        $article->updateCounters(['hits' => 1]);
        return $this->render('article', ['article' =>  $article, 
            'comment' => $commentary, 'commentaries' => $commentaries]);
    }

    private function allArticles() {
        $articles = Article::find();
        $this->initPages($articles);
        return $this->render('articles', ['articles' => $this->articles, 
            'pages' => $this->pages]);
    }

    private function articleByDate($month, $year) {
        $month = Yii::$app->months->IdByName($month);
        $articless = Article::find()->where("MONTH(`date`) = $month AND YEAR(`date`) = $year");
        $this->initPages($articless);
        return $this->render('articles', ['articles' => $this->articles, 
            'pages' => $this->pages]);
    }
}