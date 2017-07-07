<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%user_signin}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $created_by
 * @property string $date
 * @property string $message
 * @property integer $c_days
 *
 * @property \common\models\tables\User $createdBy
 */
class UserSignin extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'date', 'message'], 'required'],
            [['created_at', 'created_by', 'c_days'], 'integer'],
            [['date'], 'string', 'max' => 8],
            [['message'], 'string', 'max' => 200],
            [['created_by', 'date'], 'unique', 'targetAttribute' => ['created_by', 'date'], 'message' => 'The combination of Created By and Date has already been taken.']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_signin}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'message' => Yii::t('app', 'Message'),
            'c_days' => Yii::t('app', 'C Days'),
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
     * @return \common\models\tables\activequerys\UserSigninQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\UserSigninQuery(get_called_class());
    }
}
