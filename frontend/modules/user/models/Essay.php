<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-6
 * Time: 下午1:57
 */

namespace frontend\modules\user\models;

/**
 * Class Essay
 * @package frontend\modules\user\models

 */
class Essay extends \common\models\Essay
{
    public function rules()
    {
        return [
            [['title', 'desc'], 'trim'],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'need_money', 'need_integral', 'need_xp'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255],
            [['need_money', 'need_integral', 'need_xp'], 'default', 'value' => 0],
            ['title', 'onlyOneForUser'],
            [['title', 'created_by'], 'unique', 'targetAttribute' => ['title', 'created_by'], 'message' => 'The combination of Title and Created By has already been taken.'],
        ];
    }

    public function onlyOneForUser($attribute, $params)
    {
        if (!$this->hasErrors()&&$this->isNewRecord){
            $x = self::findOne(['title'=>$this->title, 'created_by'=>\Yii::$app->user->id]);
            if ($x){
                $this->addError($attribute, "你已经创建过该标题的文档!");
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindEssayTags()
    {
        return $this->hasMany(\common\models\BindEssayTag::className(), ['essay_id' => 'id']);
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
}