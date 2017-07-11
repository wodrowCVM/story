<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-11
 * Time: 上午10:01
 */

namespace frontend\modules\user\controllers;


use common\components\nav\Item;
use common\models\Essay;
use common\models\UserAlert;
use yii\base\ErrorException;
use yii\data\Pagination;
use yii\web\Controller;

class AlertController extends Controller
{
    public function actionIndex()
    {
        $query = UserAlert::find()->orderBy(['status'=>SORT_ASC, 'created_at'=>SORT_DESC])->where(['to_user'=>\Yii::$app->user->id]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);
        $user_alerts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'user_alerts' => $user_alerts,
            'pages' => $pages,
        ]);
    }

    public function actionToLink($id)
    {
        $user_alert = $this->findUserAlert($id);
        $user_alert->status = $user_alert->status==$user_alert::STATUS_UNREAD?$user_alert::STATUS_READ:$user_alert->status;
        if ($user_alert->save()){
            return $this->redirect($user_alert->urls['item_arr']);
        }
    }

    public function findUserAlert($id)
    {
        $user_alert = UserAlert::findOne(['id'=>$id]);
        if ($user_alert->to_user!=\Yii::$app->user->id){
            throw new ErrorException("不是你的提醒", 1026);
        }
        return $user_alert;
    }
}