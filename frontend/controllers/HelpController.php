<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-4
 * Time: 下午5:23
 */

namespace frontend\controllers;


use yii\web\Controller;

class HelpController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHowToGetAuthCode()
    {
        return $this->render('how-to-get-auth-code');
    }
}