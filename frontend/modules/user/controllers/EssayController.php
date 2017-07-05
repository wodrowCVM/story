<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 下午8:33
 */

namespace frontend\modules\user\controllers;


use yii\web\Controller;

class EssayController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}