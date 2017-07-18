<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-4
 * Time: 下午5:21
 */

namespace frontend\components\behaviors;


use yii\filters\AccessControl;

class Check extends AccessControl
{
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest){}else{
            \Yii::$app->user->isAdmin = in_array(\Yii::$app->user->identity->username, \Config::$adminUsers);
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}