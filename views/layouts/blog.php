<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\BlogAsset;
use yii\widgets\ActiveForm;

BlogAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE HTML>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Yii::$app->params['commonPath']; ?>/favicon.ico" type="image/x-icon" />
</head>
<body>
<?php $this->beginBody() ?>

<div id="uppermenu"><span class="container">
<?  if(Yii::$app->user->isGuest) { ?>
  <?=Html::a('Вход', Url::to(['/login'])); ?> | <?=Html::a('Регистрация', ['/registration']); ?>
<? }
  else { ?>
 <div class="active">Вы вошли как: <?= Yii::$app->user->identity->username;
  if(Yii::$app->user->identity->username == 'admin') { ?>
  <?=Html::a('Админ Панель', Url::to(['/admin'])) ?> 
  <? } ?>|
 <?=Html::a('Выйти', ['login/logout'], ['data' => ['method' => 'post']]); ?>
<? } ?></div>
</span></div>
<div class="container">
  <header  class="clearfix">
    <h1 class="left"><span>Sera</span>blog</h1>
    <?$form = ActiveForm::begin(['method' => 'get', 'action' => Url::to(['/search']), 'options' => ['class' => 'right']]);
     ?> <input class="span-6 last" type="text" name="query" placeholder="Поиск">  
     <? ActiveForm::end(); ?>
  </header>
  <nav>
    <ul>
      <li class="active"><?=Html::a('На главную', Url::to(['articles/all'])); ?></li>
    </ul>
  </nav>
  <div id="content" class="clearfix">
    <section id="posts" class="span-15 append-1">
        <p>
        <?= $content ?>
        </p>
    </section>
    <aside class="span-8 last right clearfix">
      <h2><span>Категории</span></h2>
      <ul>
        <? foreach($this->params['categories'] as $category) { ?>
          <li>
          <?= Html::a(HTML::encode($category->name), Url::to(['posts/category/', 'id' =>$category->name])); ?>
            </li>
          <?  } ?>
      </ul>
      <h2><span>Последние</span></h2>
      <? foreach($this->params['recents'] as $recent) { ?>
      <?= Html::img($recent->image, ['alt' => '', 'width' => '70', 'height' => '64', 'class' =>'span-2']) ?>
      <h3><?= Html::a(HTML::encode($recent->title), Url::to(['articles/show/', 'id' => $recent->id])); ?></h3>
      <p><?=HTML::encode($recent->description)?></p>
      <p class="date"><?=HTML::encode($recent->date)?></p>
      <hr>
      <?  } ?>
      <h2><span>Архив</span></h2>
      <ul>
      <? foreach($this->params['archive'] as $month) { ?>
          <li>
          <?= Html::a($month[0], Url::to(['articles/archive/', 'year' => $month[1], 'month' => $month[0]])); ?>
            </li>
          <?  } ?>
      </ul>
    </aside>
  </div>
</div>
<footer class="clearfix">
  <div class="container">
    <div class="about span-6 append-1">
      <h3>About Serablog</h3>
      <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet orem ipsum dolor sit amet, consetetur sadipscing eli</p>
    </div>
    <div id="tweets" class="span-6 append-1">
      <h3>Latest tweets</h3>
      <div class="one_tweet">
        <p>sit amet orem ipsum dolor sit amet, consetetur sadipscing </p>
        <a href="#">http://t.co/#####</a>
        <div class="date">03 March 2013</div>
      </div>
      <div class="one_tweet">
        <p>sit amet orem ipsum dolor sit amet</p>
        <a href="#">http://t.co/#####</a>
        <div class="date">03 March 2013</div>
      </div>
    </div>
    <div id="footer_form" class="span-10 last clearfix">
      <h3>Contact us</h3>
      <form action="#">
        <div class="row">
          <label for="name">your name</label>
          <input type="text" id="name" name="name" class="span-7 right last">
        </div>
        <div class="row">
          <label for="email">your email</label>
          <input type="text" id="email" name="email" class="span-7 right last">
        </div>
        <div class="row">
          <label for="message">your message</label>
          <textarea id="message" name="message" class="span-7 right last"></textarea>
        </div>
        <div class="right">
          <input type="submit">
        </div>
      </form>
    </div>
    <hr>
    Copyright 2013 by <b>SITE INC</b>, all rights reserved <span class="right last">Design by: <a href="http://www.ws-templates.com">ws-templates</a></span></div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>