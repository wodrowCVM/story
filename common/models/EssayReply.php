<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-10
 * Time: 下午5:59
 */

namespace common\models;


use common\components\user\xpr\XpRules;

/**
 * Class EssayReply
 * @package common\models
 *
 * @property \common\models\User $createdBy
 * @property \common\models\Essay $essay
 * @property \common\models\User $updatedBy
 */
class EssayReply extends \common\models\tables\EssayReply
{
    const STATUS_ACTIVE = 10;

    public function rules()
    {
        return [
            [['essay_id', 'content'], 'required'],
            [['essay_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'status'], 'integer'],
            [['content'], 'string']
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if ($insert){
                $x = \Yii::$app->user->identity->xps->setRule(XpRules::RULE_ESSAY_REPLY)->run();
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
    public function getEssay()
    {
        return $this->hasOne(\common\models\Essay::className(), ['id' => 'essay_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
    }
}