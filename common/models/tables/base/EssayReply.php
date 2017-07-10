<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%essay_reply}}".
 *
 * @property integer $id
 * @property integer $essay_id
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $status
 * @property string $content
 *
 * @property \common\models\tables\User $createdBy
 * @property \common\models\tables\Essay $essay
 * @property \common\models\tables\User $updatedBy
 */
class EssayReply extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['essay_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'content'], 'required'],
            [['essay_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'status'], 'integer'],
            [['content'], 'string']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%essay_reply}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'essay_id' => Yii::t('app', 'Essay ID'),
            'status' => Yii::t('app', 'Status'),
            'content' => Yii::t('app', 'Content'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'created_by']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEssay()
    {
        return $this->hasOne(\common\models\tables\Essay::className(), ['id' => 'essay_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'updated_by']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\EssayReplyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\EssayReplyQuery(get_called_class());
    }
}
