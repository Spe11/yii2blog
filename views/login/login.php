<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->params['breadcrumbs'][] = 'Регистрация';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Введите данные:</p>

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            
    <div class="col-lg-offset-1" style="color:#bd4a0a;">
       <?= Yii::$app->session->getFlash('failure') ?>
    </div>
    <div class="col-lg-offset-1" style="color:#999;">
        Админ: <strong>admin/admin</strong>
    </div>
    
</div>
