<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;

?>
<article>
<div class="date span-3"><?=Html::encode($article->date)?></div>
<h2><a href="#"><?=Html::encode($article->title)?></a></h2>
<div class="metadata">
  <ul>
    <li>Автор: <?= Html::a(Html::encode($article->author->username), Url::to(['posts/user', 'id' => $article->author->username]));?></a></li>
    <li>Категория: <?= Html::a(Html::encode($article->category0->name), Url::to(['posts/category/', 'id' => $article->category0->name])); ?></li>
    <li>Просмотров: <?= Html::encode($article->hits); ?></li>
  </ul>
</div>
<div id = "image">
<?= Html::img($article->image, ['alt' => '']) ?>
</div>
<p>
<?= HtmlPurifier::process($article->content)?> 
</p>
</article>
<hr>

<? foreach($commentaries as $commentary) { ?>
  Автор: <?= Html::encode($commentary->author->username); ?>
  <p> Дата: <?= Html::encode($commentary->date); ?>
  <p><b> <?= HtmlPurifier::process($commentary->commentary) ?></b>
  <hr>
<? } ?>
<? if(!Yii::$app->user->isGuest) {
$form = ActiveForm::begin(['options' => ['class' => 'left']]); ?>
<?=$form->field($comment, 'commentary')->textarea(['rows' => '6', 'cols' => '50']); ?>
<?=$form->field($comment, 'author_id')->hiddenInput(['value' => Yii::$app->user->identity->id]); ?>
<?=$form->field($comment, 'article')->hiddenInput(['value' => $article->id]); ?>
<?=Html::submitButton('Отправить'); ?>
<? ActiveForm::end(); } ?>
