<?php

namespace common\models\tables;

use \common\models\tables\base\Tag as BaseTag;

/**
 * This is the model class for table "tag".
 */
class Tag extends BaseTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255]
        ]);
    }
	
}
