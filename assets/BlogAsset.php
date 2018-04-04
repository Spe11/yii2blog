<?php

namespace app\assets;

use yii\web\AssetBundle;

class BlogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'yii\bootstrap\BootstrapAsset',
        'css/screen.css',
        'css/style.css'
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}