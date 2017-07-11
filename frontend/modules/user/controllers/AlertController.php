<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-11
 * Time: 上午10:01
 */

namespace frontend\modules\user\controllers;


use common\models\Essay;
use yii\web\Controller;

class AlertController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionToLink($id)
    {
        exit;
    }
}