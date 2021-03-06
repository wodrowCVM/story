<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 下午4:33
 */

namespace common\models;


use common\components\user\xpr\XpRules;
use mootensai\behaviors\UUIDBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class UserSignin extends \common\models\tables\UserSignin
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if ($insert){
                return \Yii::$app->user->identity->xps->setRule(XpRules::RULE_SIGNIN)->run();
            }
            return true;
        }else{
            return false;
        }
    }
}