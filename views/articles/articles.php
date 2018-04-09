<?php
use yii\helpers\Url;
use yii\helpers\Html; 
use yii\helpers\HtmlPurifier;
use yii\widgets\LinkPager;
?>

<h1><span>Список статей</span></h1>

<? foreach($articles as $article) {?>
<article>
<div class="date span-3"><?=Html::encode($article->date)?></div>
<h2><?=Html::encode($article->title)?></h2>
<div class="metadata">
  <ul>
    <li>Автор: <?= Html::a(Html::encode($article->author->username), Url::to(['articles/user', 'id' => $article->author->username])); ?></li>
    <li>Категория: <?= Html::a(Html::encode($article->category0->name), Url::to(['articles/category/', 'id' => $article->category0->name])); ?></li>
  </ul>
</div>
<div id = "image">
<?= Html::img($article->image, ['alt' => '']) ?>
</div>
<p>
<?= HtmlPurifier::process($article->description)?> 
</p>
<div class="more"><?= Html::a('Читать', ['articles/show/'.$article->id]); ?></div>
</article>
<hr>
<? } ?>
<div class="pagination">
<?= LinkPager::widget([
  'pagination' => $pages
]); ?>
</div>