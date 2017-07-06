<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $code;
    public $rememberMe = true;

    private $_user;

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'code' => '验证码',
            'rememberMe' => '记住我',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['code', 'required'],
            ['code', 'captcha'],
            ['username', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(['username'=>$this->username]);
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '账号或密码错误');
            }else{
                if ($user->status == $user::STATUS_INACTIVE){
                    $this->addError($attribute, '没有激活，请先激活');
                }
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
