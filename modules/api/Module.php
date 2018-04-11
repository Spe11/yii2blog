<?php

namespace app\modules\api;

use Yii;
use yii\base\BootstrapInterface;

/**
 * api module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'article',
                'prefix' => 'api'
            ],
        ]);
    }
}
