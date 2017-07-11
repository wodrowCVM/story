<?php

namespace common\models\tables;

use \common\models\tables\base\UserAlert as BaseUserAlert;

/**
 * This is the model class for table "user_alert".
 */
class UserAlert extends BaseUserAlert
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_by', 'created_at', 'title', 'updated_by', 'updated_at', 'to_user'], 'required'],
            [['created_by', 'created_at', 'status', 'updated_by', 'updated_at', 'to_user', 'item_type'], 'integer'],
            [['content', 'other_data'], 'string'],
            [['title'], 'string', 'max' => 200]
        ]);
    }
	
}
