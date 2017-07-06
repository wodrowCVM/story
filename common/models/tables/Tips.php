<?php

namespace common\models\tables;

use \common\models\tables\base\Tips as BaseTips;

/**
 * This is the model class for table "tips".
 */
class Tips extends BaseTips
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['msg', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['msg'], 'string', 'max' => 200]
        ]);
    }
	
}
