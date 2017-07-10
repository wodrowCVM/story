<?php

namespace common\models\tables;

use \common\models\tables\base\EssayReply as BaseEssayReply;

/**
 * This is the model class for table "essay_reply".
 */
class EssayReply extends BaseEssayReply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['essay_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'content'], 'required'],
            [['essay_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'status'], 'integer'],
            [['content'], 'string']
        ]);
    }
	
}
