<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use app\models\Article;
use app\models\Category;

class LayoutInit extends Behavior {

    public function initData($controller) {
        $controller->view->params['archive'] = Yii::$app->months->getLatest(date('m'));
        $controller->view->params['categories'] = Category::find()->all();
        $controller->view->params['recents'] = Article::find()->orderBy(['date'=>SORT_DESC])->limit(3)->all();
    }
}