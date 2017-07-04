<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'name' => 'YY故事',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'class' => \common\components\rewrite\web\User::className(),
            'identityClass' => \common\models\User::className(),
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix'=>'.html',
            'rules' => [
//                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//                '<controller:\w+>/<action:\w+>.html'=>'<controller>/<action>',
            ],
        ],
        'as access' => [
            'class' => \frontend\components\behaviors\Check::className(),
            'except' => [
                'site/*',
                'help/*',
                'gii/*',
                'debug/*',
            ],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\UserModule',
        ],
    ],
    'params' => $params,
];
