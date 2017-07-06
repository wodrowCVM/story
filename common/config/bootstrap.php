<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@project', dirname(dirname(__DIR__)));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '/storage');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@data', dirname(dirname(__DIR__)) . '/data');
require_once Yii::getAlias('@project')."/Config.php";
Yii::setAlias('@frontendUrl', Config::$frontendUrl);
Yii::setAlias('@backendUrl', Config::$backendUrl);
Yii::setAlias('@storageUrl', Config::$storageUrl);
define(NOW_TIME, time());