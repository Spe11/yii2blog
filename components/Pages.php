<?php

namespace app\components;

use yii\base\Behavior;
use yii\data\Pagination;

class Pages extends Behavior {
    public $articles;
    public $pages;

    public function initPages($query) {
        $this->pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $this->pages->pageSizeParam = false;
        $this->articles = $query->offset($this->pages->offset)->limit($this->pages->limit)->all();
    } 
}