<?php

namespace common\models\tables;

use \common\models\tables\base\Essay as BaseEssay;

/**
 * This is the model class for table "essay".
 */
class Essay extends BaseEssay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['title', 'content', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['content'], 'string'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'need_money', 'need_integral', 'need_xp'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255]
        ]);
    }
	
}
