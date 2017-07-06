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
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
            'timeFormat' => 'php:H:i:s',
        ]
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // see settings on http://demos.krajee.com/grid#module
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
            // see settings on http://demos.krajee.com/datecontrol#module
        ],
        // If you use tree table
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // see settings on http://demos.krajee.com/tree-manager#module
        ],
        'dynagrid'=>[
            'class'=>\kartik\dynagrid\Module::className(),
            // other settings (refer documentation)
        ],
        'redactor' => [
            'class' => \yii\redactor\RedactorModule::className(),
            'uploadDir' => '@storage/web/images/redactor',
            'uploadUrl' => '@storageUrl/images/redactor',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
];
