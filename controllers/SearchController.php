<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\components\LayoutInit;
use app\components\Pages;

class SearchController extends Controller
{
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

    public function actionIndex($query) {
        
       return $this->articlesByWord($query);
    }

    private function articlesByWord($word) {
        $query = Article::find()->where(['like', 'title', $word, false])->
        orWhere(['like', 'content', $word, false]);
        $this->initPages($query);
        return $this->render('@app/views/articles/articles', 
            ['articles' => $this->articles, 'pages' => $this->pages]);
    }
}