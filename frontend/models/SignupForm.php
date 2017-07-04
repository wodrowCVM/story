<?php
namespace frontend\models;

use common\models\UserAuthCode;
use yii\base\ErrorException;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $authcode;
    public $email;
    public $code;
    public $username;
    public $password;
    public $repassword;

    public function attributeLabels()
    {
        return [
            'authcode' => '授权码',
            'email' => '邮箱',
            'code' => '验证码',
            'username' => "用户名",
            'password' => '密码',
            'repassword' => '确认密码',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['authcode', 'required'],
            ['authcode', 'exist',
                'targetAttribute' => 'code',
                'targetClass' => '\common\models\UserAuthCode',
                'filter' => ['status' => UserAuthCode::STATUS_ACTIVE],
                'message' => '没有找到授权码或未激活的授权码。'],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['repassword', 'required'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],

            ['code', 'required'],
            ['code', 'captcha'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        \Yii::$app->cache->set($user->username."_signup_active_key", \Yii::$app->security->generateRandomKey(), 3600);
        $is_send = \Yii::$app->mailer
            ->compose(['html'=>'signup'], ['url'=>\yii\helpers\Url::toRoute(['site/set-active', 'username'=>$user->username, 'code'=>\Yii::$app->cache->get($user->username."_signup_active_key")], true)])
            ->setFrom(\Config::$adminEmail)
            ->setTo($user->email)
            ->setSubject("注册激活用户")
            ->send();
        if ($is_send){
            if ($user->save()){
                return $user;
            }else{
                \Yii::$app->session->setFlash('error', '用户注册失败。');
            }
        }else{
            \Yii::$app->session->setFlash('error', '邮箱发送邮件失败，请检查邮箱是否有效或更换邮箱。');
//            throw new ErrorException("邮箱发送邮件失败，请检查邮箱是否有效或更换邮箱", 1001);
        }
    }
}
