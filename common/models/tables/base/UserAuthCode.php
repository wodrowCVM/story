<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%user_auth_code}}".
 *
 * @property integer $id
 * @property string $code
 * @property integer $bind_user
 * @property integer $bind_at
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $status
 *
 * @property \common\models\tables\User $bindUser
 * @property \common\models\tables\User $createdBy
 * @property \common\models\tables\User $updatedBy
 */
class UserAuthCode extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['bind_user', 'bind_at', 'created_by', 'created_at', 'updated_by', 'updated_at', 'status'], 'integer'],
            [['code'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_code}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'bind_user' => 'Bind User',
            'bind_at' => 'Bind At',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindUser()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'bind_user']);
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
                'updatedByAttribute' => false,
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\tables\UserAuthCodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\UserAuthCodeQuery(get_called_class());
    }
}
