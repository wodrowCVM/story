<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-3
 * Time: 下午2:36
 */

namespace common\components\rewrite\web;

/**
 * Class User
 * @package common\components\rewrite
 *
 * @property \common\models\User $identity
 */
class User extends \yii\web\User
{
    public $isAdmin;
}