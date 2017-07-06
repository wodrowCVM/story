<?php

namespace frontend\models;


use yii\base\Model;

class ActiveForEmailForm extends Model
{
    public $email;
    public $code;

    public function attributeLabels()
    {
        return [
            'email' =>'邮箱',
            'code' => '验证码',
        ];
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => '\common\models\User', 'message' => '没有找到邮箱或邮箱未激活。'],
            ['code', 'required'],
            ['code', 'captcha'],
        ];
    }
}