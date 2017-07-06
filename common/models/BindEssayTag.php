<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-6
 * Time: 下午1:12
 */

namespace common\models;


class BindEssayTag extends \common\models\tables\BindEssayTag
{
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'essay_id' => '随笔编号',
            'tag_id' => '标签编号',
        ];
    }

    public function rules()
    {
        return [
            [['essay_id'], 'required'],
            [['essay_id', 'tag_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['essay_id', 'tag_id'], 'unique', 'targetAttribute' => ['essay_id', 'tag_id'], 'message' => 'The combination of Essay ID and Tag ID has already been taken.'],
            ['select2_tag_id_show', 'safe']
        ];
    }
}