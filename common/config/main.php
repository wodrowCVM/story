<?php
return [
    'timeZone' => 'Asia/Shanghai',
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'tools' => [
            'class' => \common\components\tools\Tools::className(),
        ],
    ],
];
