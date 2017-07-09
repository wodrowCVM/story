<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%user_essay}}".
 *
 * @property integer $id
 * @property integer $essay_id
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $status
 * @property string $buy_log
 *
 * @property \common\models\tables\Essay $essay
 * @property \common\models\tables\User $createdBy
 * @property \common\models\tables\User $updatedBy
 */
class UserEssay extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['essay_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'buy_log'], 'required'],
            [['essay_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status'], 'integer'],
            [['buy_log'], 'string'],
            [['essay_id', 'created_by'], 'unique', 'targetAttribute' => ['essay_id', 'created_by'], 'message' => 'The combination of Essay ID and Created By has already been taken.']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_essay}}';
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
            'buy_log' => Yii::t('app', 'Buy Log'),
        ];
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
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'created_by']);
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
     * @return \common\models\tables\activequerys\UserEssayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\UserEssayQuery(get_called_class());
    }
}
