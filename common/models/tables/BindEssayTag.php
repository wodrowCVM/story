<?php

namespace common\models\tables;

use \common\models\tables\base\BindEssayTag as BaseBindEssayTag;

/**
 * This is the model class for table "bind_essay_tag".
 */
class BindEssayTag extends BaseBindEssayTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['essay_id', 'tag_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['essay_id', 'tag_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['essay_id', 'tag_id'], 'unique', 'targetAttribute' => ['essay_id', 'tag_id'], 'message' => 'The combination of Essay ID and Tag ID has already been taken.']
        ]);
    }
	
}
