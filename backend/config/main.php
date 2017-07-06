<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',//yii2-admin的导航菜单
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => \common\models\User::className(),
                    'idField' => 'user_id',
                    'usernameField' => 'username',
                    'extraColumns' => [
                        'mobile',
                        'email',
                        [
                            'label' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                        [
                            'label' => 'updated_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                    ],
//                    'searchClass' => 'backend\models\UserSearch',
                ],
            ],
            'mainLayout' => '@app/views/layouts/main.php',
            'menus' => [
                'assignment' => [
                    'label' => '用户授权' // change label
                ],
                'user' => null, // disable menu
            ],
        ],
        'user' => [
            'class' => 'backend\modules\user\UserModule',
        ],
        'tag' => [ // 标签管理
            'class' => 'backend\modules\tag\TagModule',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'class' => \common\components\rewrite\web\User::className(),
            'identityClass' => \common\models\User::className(),
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'rules' => [
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
        ]
    ],
    "aliases" => [
        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',//允许访问的节点，可自行添加
//            'admin/*',//允许所有人访问admin节点及其子节点
//            'debug/*',
//            'gii/*',
        ]
    ],
    'params' => $params,
];
