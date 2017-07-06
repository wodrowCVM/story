<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-6
 * Time: 下午1:57
 */

namespace frontend\modules\user\models;


class Essay extends \common\models\Essay
{
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'need_money', 'need_integral', 'need_xp'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255],
            [['need_money', 'need_integral', 'need_xp'], 'default', 'value' => 0    ],
        ];
    }
}