<?php

namespace common\models\tables;

use \common\models\tables\base\ItemTag as BaseItemTag;

/**
 * This is the model class for table "item_tag".
 */
class ItemTag extends BaseItemTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['title', 'created_at', 'created_by', 'updated_at', 'updated_by', 'tag_name'], 'required'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'need_money', 'need_integral', 'need_xp', 'tag_id', 'item_type', 'item_id'], 'integer'],
            [['title', 'tag_name'], 'string', 'max' => 50]
        ]);
    }
	
}
