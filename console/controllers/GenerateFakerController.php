<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-4
 * Time: 下午4:21
 */

namespace console\controllers;


use common\models\User;
use yii\console\Controller;

class GenerateFakerController extends Controller
{
    public function actionGuser()
    {
        $user = [
            'username' => 'facere89',
            'auth_key' => '5towaRo9LPxi2s6C5S4DDjUbO-bPnmdl',
            'password_hash' => '$2y$13$3vd4YENyfdSO9T8rQ7K5aekLBi442Na7g2MK74yLucoicaJEilsuu',
            'created_at' => NOW_TIME,
            'updated_at' => NOW_TIME,
            'email' => 'quaerat88@126.com',
        ];
        $u = new User();
        $u->load($user);
        $u->save();
    }
}