<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */

$this->title = 'Update Articles: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articles-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model, 'users' => $users, 'categories' => $categories, 'image' => $image
    ]) ?>

</div>
