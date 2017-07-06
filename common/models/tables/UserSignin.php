<?php

namespace common\models\tables;

use \common\models\tables\base\UserSignin as BaseUserSignin;

/**
 * This is the model class for table "user_signin".
 */
class UserSignin extends BaseUserSignin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'created_by', 'date', 'message'], 'required'],
            [['created_at', 'created_by', 'c_days'], 'integer'],
            [['date'], 'string', 'max' => 8],
            [['message'], 'string', 'max' => 200],
            [['created_by', 'date'], 'unique', 'targetAttribute' => ['created_by', 'date'], 'message' => 'The combination of Created By and Date has already been taken.']
        ]);
    }
	
}
