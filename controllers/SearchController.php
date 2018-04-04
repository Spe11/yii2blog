<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Articles;
use app\components\LayoutInit;
use app\components\Pages;

class SearchController extends Controller
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

    public function actionIndex($query) {
        $query = Articles::find()->where(['like', 'title', $query, false])->
            orWhere(['like', 'content', $query, false]);
            $this->initPages($query);
            return $this->render('@app/views/articles/articles', 
                ['articless' => $this->articles, 'pages' => $this->pages]);
    }
}