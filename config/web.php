<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'homeUrl' => '/yii2blog',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ufqtuTPkVOhsTZ_l2FSkr1tn6ud0UJOu',
            'baseUrl' => '/yii2blog',     
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'layout' => 'main',
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'articles/show/<id:\d+>' => 'articles/show',
                'posts/category/<id:\w+>/<page:\d+>' => 'posts/category',
                'posts/category/<id:\w+>' => 'posts/category',
                'posts/user/<id:\w+>/<page:\d+>' => 'posts/user',
                'posts/user/<id:\w+>' => 'posts/user',
                'articles/all/<page:\d+>' => 'articles/all',
                'articles/all' => 'articles/all',
                'articles/archive/<year:\d{4}>/<month:\w+>/<page:\d+>' => 'articles/archive',
                'articles/archive/<year:\d{4}>/<month:\w+>' => 'articles/archive'
            ],
        ],
        'months' => [
            'class' => 'app\components\Months'
        ]
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ]
    ],
    'defaultRoute' => 'articles/all',
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
