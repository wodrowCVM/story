<?php

namespace common\models\tables;

use \common\models\tables\base\Novel as BaseNovel;

/**
 * This is the model class for table "novel".
 */
class Novel extends BaseNovel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['title', 'desc', 'content', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['content'], 'string'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 200]
        ]);
    }
	
}
