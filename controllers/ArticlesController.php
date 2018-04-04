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
        $this->initData($this);
    }

    public function behaviors(){
        return [
            LayoutInit::ClassName(),
            Pages::ClassName()
        ];
    }

    public function actionShow() { 
        $commentary = new Commentary;
        if ($commentary->load(Yii::$app->request->post()) && $commentary->save()) {
            
            return $this->refresh();
        }

        $id = Yii::$app->request->get()['id'];
        
        if($id !== null  && $article = Article::find()->where(['id' => $id])->one()) 
        {
            $commentaries = $article->commentaries;
            $article->updateCounters(['hits' => 1]);
            return $this->render('article', ['article' =>  $article, 
            'comment' => $commentary, 'commentaries' => $commentaries]);
        }
        else throw new \yii\web\NotFoundHttpException();
    }

    public function actionAll()
    {
        $articles = Article::find();
        $this->initPages($articles);
        return $this->render('articles', ['articles' => $this->articles, 
            'pages' => $this->pages]);
    }

    public function actionArchive($month, $year)
    {
        $month = Yii::$app->months->IdByName($month);
        $articless = Article::find()->where("MONTH(`date`) = $month AND YEAR(`date`) = $year");
        $this->initPages($articless);
        return $this->render('articles', ['articles' => $this->articles, 
            'pages' => $this->pages]);
    }
}