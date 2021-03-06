<?php
namespace common\models;

use common\components\user\xpr\XpRules;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property UserAuthCode[] $userAuthCodes
 * @property array $urls
 * @property XpRules $xps
 */
class User extends \common\models\tables\User implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 9;
    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => '已激活',
            self::STATUS_DELETED => '已删除',
            self::STATUS_INACTIVE => '未激活',
        ];
    }

    public static function getSex()
    {
        return [
            self::SEX_MAN => '男',
            self::SEX_WOMAN => '女',
        ];
    }

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '用户编号',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => '邮箱',
            'status' => '状态',
            'created_at' => '注册时间',
            'updated_at' => '修改时间',
            'money' => '金币',
            'integral' => '积分',
            'xp' => '经验',
            'mobile' => '手机号',
            'nickname' => '昵称',
            'qq' => 'QQ',
            'weibo' => '微博',
            'sex' => '性别',
            'birthday' => '出生日期',
        ];
    }

    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at', 'money', 'integral', 'xp', 'sex'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'nickname', 'weibo'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['mobile'], 'string', 'min' => 11, 'max' => 11],
            [['qq', 'birthday'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuthCodes()
    {
        return $this->hasMany(\common\models\tables\UserAuthCode::className(), ['updated_by' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getUrls()
    {
        $arr = [];
        $arr['info_arr'] = ['/user/default/user-home', 'id'=>$this->id];
        $arr['info'] = Url::to($arr['info_arr']);
        $arr['info_show_username'] = Html::a($this->username, $arr['info_arr']);
        $arr['list_arr'] = ['/user/default/users'];
        $arr['list'] = Url::to($arr['list_arr']);
        $arr['list_show_label'] = Html::a('所有用户', $arr['list_arr']);
        return $arr;
    }

    /**
     * @return XpRules $xps
     */
    public function getXps()
    {
        $xps = New XpRules();
        $xps->setUser($this);
        return $xps;
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if ($this->xp < 0){
                Yii::$app->session->setFlash('error', '经验值必须为大于0的整数!');
                return false;
            }
            if ($this->money < 0){
                Yii::$app->session->setFlash('error', '金币不足!');
                return false;
            }
            if ($this->integral < 0){
                Yii::$app->session->setFlash('error', '积分不足!');
                return false;
            }
            return true;
        }else{
            return false;
        }
    }
}
