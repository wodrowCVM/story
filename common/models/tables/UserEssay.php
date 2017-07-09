<?php

namespace common\models\tables;

use \common\models\tables\base\UserEssay as BaseUserEssay;

/**
 * This is the model class for table "user_essay".
 */
class UserEssay extends BaseUserEssay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['essay_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'buy_log'], 'required'],
            [['essay_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status'], 'integer'],
            [['buy_log'], 'string'],
            [['essay_id', 'created_by'], 'unique', 'targetAttribute' => ['essay_id', 'created_by'], 'message' => 'The combination of Essay ID and Created By has already been taken.']
        ]);
    }
	
}
