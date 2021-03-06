<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $money
 * @property integer $integral
 * @property integer $xp
 * @property string $mobile
 * @property string $nickname
 * @property string $qq
 * @property string $weibo
 * @property integer $sex
 * @property string $birthday
 *
 * @property \common\models\tables\BindEssayTag[] $bindEssayTags
 * @property \common\models\tables\Essay[] $essays
 * @property \common\models\tables\Tips[] $tips
 * @property \common\models\tables\UserAuthCode[] $userAuthCodes
 * @property \common\models\tables\UserSignin[] $userSignins
 */
class User extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'money', 'integral', 'xp', 'sex'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'nickname', 'weibo'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['mobile'], 'string', 'max' => 11],
            [['qq', 'birthday'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'money' => Yii::t('app', 'Money'),
            'integral' => Yii::t('app', 'Integral'),
            'xp' => Yii::t('app', 'Xp'),
            'mobile' => Yii::t('app', 'Mobile'),
            'nickname' => Yii::t('app', 'Nickname'),
            'qq' => Yii::t('app', 'Qq'),
            'weibo' => Yii::t('app', 'Weibo'),
            'sex' => Yii::t('app', 'Sex'),
            'birthday' => Yii::t('app', 'Birthday'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindEssayTags()
    {
        return $this->hasMany(\common\models\tables\BindEssayTag::className(), ['updated_by' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEssays()
    {
        return $this->hasMany(\common\models\tables\Essay::className(), ['updated_by' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTips()
    {
        return $this->hasMany(\common\models\tables\Tips::className(), ['updated_by' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuthCodes()
    {
        return $this->hasMany(\common\models\tables\UserAuthCode::className(), ['updated_by' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSignins()
    {
        return $this->hasMany(\common\models\tables\UserSignin::className(), ['created_by' => 'id']);
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
     * @return \common\models\tables\activequerys\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\UserQuery(get_called_class());
    }
}
