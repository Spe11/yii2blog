<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Article;
use app\models\Commentary;
use app\models\User;
use app\models\Category;
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
        $commentary = new Commentary;
        $this->addComment($commentary);

        $id = Yii::$app->request->get('id');
        return $this->articleById($id, $commentary);
    }

    public function actionAll()
    {
        return $this->allArticles();
    }

    public function actionArchive($month, $year)
    {
       return $this->articlesByDate($month, $year);
    }

    public function actionCategory($id = null) {
        $category = Category::findOne(['name' => $id]);

        return $this->articlesByCategory($category);
    }

    public function actionUser($id = null) {
        $user = User::findOne(['username' => $id]);
        return $this->articlesByUser($user);
    }

    private function addComment($commentary) {
        $commentary = new Commentary;
        if ($commentary->load(Yii::$app->request->post()) && $commentary->save()) {
            return $this->refresh();
        }
    }

    private function articleById($id, $commentary) {
        $article = Article::find()->where(['id' => $id])->one();
        $commentaries = $article->commentaries;
        return $this->render('article', ['article' =>  $article, 
            'comment' => $commentary, 'commentaries' => $commentaries]);
    }

    private function allArticles() {
        $articles = Article::find()->orderBy(['id' =>SORT_DESC]);
        $this->initPages($articles);
        return $this->render('articles', ['articles' => $this->articles, 
            'pages' => $this->pages]);
    }

    private function articlesByDate($month, $year) {
        $month = Yii::$app->months->IdByName($month);
        $articless = Article::find()->where("MONTH(`date`) = $month AND YEAR(`date`) = $year")
            ->orderBy(['id' =>SORT_DESC]);
        $this->initPages($articless);
        return $this->render('articles', ['articles' => $this->articles, 
            'pages' => $this->pages]);
    }

    private function articlesByCategory($category) {
        $articles = Article::find()->where(['category' => $category])->orderBy(['id' => SORT_DESC]);
        $this->initPages($articles);
        return $this->render('@app/views/articles/articles', 
            ['articles' => $this->articles, 'pages' => $this->pages]);
    }

    private function articlesByUser($user) {
        $articles = Article::find()->where(['author_id' => $user])->orderBy(['id' => SORT_DESC]);
        $this->initPages($articles);
        return $this->render('@app/views/articles/articles', 
            ['articles' => $this->articles, 'pages' => $this->pages]);
    }
}