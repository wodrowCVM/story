<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 下午3:37
 */

namespace frontend\models;

use common\components\user\xpr\XpRules;
use common\models\UserSignin;
use yii\base\ErrorException;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class SigninForm
 * @package frontend\models
 *
 * @property UserSignin $todaySignin
 */
class SigninForm extends Model
{
    public $message;

    public function attributeLabels()
    {
        return [
            'message' => '签到信息',
        ];
    }

    public function rules()
    {
        return [
            ['message', 'required'],
            ['message', 'string', 'min' => 10, 'max'=> 200],
        ];
    }

    /**
     * @return ActiveRecord
     */
    public function getTodaySignin()
    {
        $x = UserSignin::findOne(['created_by'=>\Yii::$app->user->id, 'date'=>date("Ymd", NOW_TIME)]);
        if ($x){}else{
            $x = new UserSignin();
        }
        return $x;
    }

    public function signin()
    {
        $ts = $this->todaySignin;
        if ($ts->isNewRecord){
            $trans = \Yii::$app->db->beginTransaction();
            try{
                $ts->message = $this->message;
                $ts->date = date("Ymd", NOW_TIME);
                $ts->created_at = NOW_TIME;
                $ts->created_by = \Yii::$app->user->id;
                $yesterdaySignin = UserSignin::findOne(['created_by'=>\Yii::$app->user->id, 'date'=>date("Ymd", NOW_TIME-86400)]);
                if ($yesterdaySignin){
                    $ts->c_days = $yesterdaySignin->c_days+1;
                }
                if ($ts->save()){
                    $trans->commit();
//                    \Yii::$app->session->setFlash("success", "签到成功，你已经连续签到{$ts->c_days}天。");
                }else{
                    $trans->rollBack();
                    \Yii::$app->session->setFlash("error", "签到失败");
                }
            }catch (ErrorException $e){
                $trans->rollBack();
                \Yii::$app->session->setFlash("error", "签到异常");
            }
        }else{
            \Yii::$app->session->setFlash("info", "你已经签到了");
        }
    }
}