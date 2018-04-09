<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use app\models\Article;
use app\models\Category;

class LayoutInit extends Behavior {

    public function initSidebar($controller) {
        $controller->view->params['archive'] = Yii::$app->months->getLatest(date('m'));
        $controller->view->params['categories'] = Category::find()->all();
        $controller->view->params['recents'] = Article::find()->limit(3)->orderBy(['id' =>SORT_DESC])->all();
    }
}