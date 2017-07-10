<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 2017/7/9
 * Time: 11:34
 */

namespace common\models;

use common\components\user\xpr\XpRules;
use yii\base\ErrorException;

/**
 * Class UserEssay
 * @package common\models
 *
 * @property \common\models\Essay $essay
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 */
class UserEssay extends \common\models\tables\UserEssay
{
    const STATUS_ACTIVE = 10;

    public function rules()
    {
        return [
            [['essay_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status'], 'integer'],
            [['buy_log'], 'string'],
            [['essay_id', 'created_by'], 'unique', 'targetAttribute' => ['essay_id', 'created_by'], 'message' => 'The combination of Essay ID and Created By has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEssay()
    {
        return $this->hasOne(\common\models\Essay::className(), ['id' => 'essay_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            if ($insert){
                $x = \Yii::$app->user->identity->xps->setItem($this->essay)->setRule(XpRules::RULE_BUY_ESSAY)->run();
                if (!$x){
//                    throw new ErrorException("积分异常", 1025);
                    return false;
                }
                return $x;
            }
            return true;
        }else{
            return false;
        }
    }
}