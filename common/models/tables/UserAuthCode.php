<?php

namespace common\models\tables;

use Yii;
use \common\models\tables\base\UserAuthCode as BaseUserAuthCode;

/**
 * This is the model class for table "user_auth_code".
 */
class UserAuthCode extends BaseUserAuthCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['code', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['bind_user', 'bind_at', 'created_by', 'created_at', 'updated_by', 'updated_at', 'status'], 'integer'],
            [['code'], 'string', 'max' => 50]
        ]);
    }
	
}
