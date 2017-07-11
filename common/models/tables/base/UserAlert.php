<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%user_alert}}".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $status
 * @property string $title
 * @property string $content
 * @property string $other_data
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $to_user
 * @property integer $item_type
 *
 * @property \common\models\tables\User $createdBy
 * @property \common\models\tables\User $toUser
 * @property \common\models\tables\User $updatedBy
 */
class UserAlert extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'created_at', 'title', 'updated_by', 'updated_at', 'to_user'], 'required'],
            [['created_by', 'created_at', 'status', 'updated_by', 'updated_at', 'to_user', 'item_type'], 'integer'],
            [['content', 'other_data'], 'string'],
            [['title'], 'string', 'max' => 200]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_alert}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'other_data' => Yii::t('app', 'Other Data'),
            'to_user' => Yii::t('app', 'To User'),
            'item_type' => Yii::t('app', 'Item Type'),
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
    public function getToUser()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'to_user']);
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
     * @return \common\models\tables\activequerys\UserAlertQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\UserAlertQuery(get_called_class());
    }
}
