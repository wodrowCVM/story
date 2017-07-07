<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 上午10:17
 */

namespace common\models;


use common\components\rewrite\mootensai\relation\RelationTrait;

/**
 * Class Essay
 * @package common\models
 *
 * @property \common\models\BindEssayTag[] $bindEssayTags
 */
class Essay extends \common\models\tables\Essay
{
    use RelationTrait;

    const TYPE_DEFAULT = 10;
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;

    public static function getType()
    {
        return [
            self::TYPE_DEFAULT => '默认',
        ];
    }

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => '已激活',
            self::STATUS_DELETED => '已删除',
            self::STATUS_INACTIVE => '未激活',
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '随笔编号',
            'title' => '标题',
            'desc' => '介绍',
            'content' => '内容',
            'type' => '类型',
            'status' => '状态',
            'need_money' => '所需金币',
            'need_integral' => '所需积分',
            'need_xp' => '所需经验',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindEssayTags()
    {
        return $this->hasMany(\common\models\BindEssayTag::className(), ['essay_id' => 'id']);
    }
}