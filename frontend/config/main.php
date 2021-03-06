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
    'name' => 'YY故事汇',
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
//            'suffix' => '.html',
            'rules' => [
//                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>.html'=>'<controller>/<action>',
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\UserModule',
        ],
        'tag' => [ // 标签
            'class' => 'frontend\modules\tag\TagModule',
        ],
        'essay' => [ // 随笔
            'class' => 'frontend\modules\essay\EssayModule',
        ],
        'novel' => [ // 小说
            'class' => 'frontend\modules\novel\NovelModule',
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
    'params' => $params,
];
