<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 下午8:08
 */

namespace frontend\modules\user\models;


use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $oldpassword;
    public $newpassword;
    public $renewpassword;

    public function attributeLabels()
    {
        return [
            'oldpassword' => "老密码",
            'newpassword' => "新密码",
            'renewpassword' => "再次输入密码",
        ];
    }

    public function rules()
    {
        return [
            ['oldpassword', 'required'],
            ['oldpassword', 'checkOldPassword'],
            ['newpassword', 'required'],
            ['newpassword', 'string', 'min' => 6],
            ['renewpassword', 'required'],
            ['renewpassword', 'compare', 'compareAttribute' => 'newpassword'],
        ];
    }

    public function checkOldPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = \Yii::$app->user->identity;
            $x = $user->validatePassword($this->oldpassword);
            if (!$x){
                $this->addError($attribute, $x);
            }
        }
    }

    public function resetPassword()
    {
        $user = \Yii::$app->user->identity;
        $user->setPassword($this->newpassword);
        $user->generateAuthKey();
        return $user->save();
    }
}