<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 上午10:16
 */

namespace common\models;

/**
 * Class Tag
 * @package common\models
 *
 * @property \common\models\BindEssayTag[] $bindEssayTags
 */
class Tag extends \common\models\tables\Tag
{
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
            'id' => '标签编号',
            'name' => '标签名',
            'desc' => '标签介绍',
            'type' => '标签类型',
            'status' => '标签状态',
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindEssayTags()
    {
        return $this->hasMany(\common\models\BindEssayTag::className(), ['tag_id' => 'id']);
    }
}