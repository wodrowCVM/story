<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 上午10:16
 */

namespace common\models;

use common\components\rewrite\mootensai\relation\RelationTrait;
use common\models\interfaces\Item;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class Tag
 * @package common\models
 *
 * @property \common\models\BindEssayTag[] $bindEssayTags
 * @property array $urls
 * @property \common\models\tables\User $createdBy
 * @property \common\models\tables\User $updatedBy
 */
class Tag extends \common\models\tables\Tag implements Item
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
            ['name', 'isNotNumeric'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255],
        ];
    }

    public function isNotNumeric($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (is_numeric($this->name)){
                $this->addError($attribute, '标签名不能为纯数字');
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindEssayTags()
    {
        return $this->hasMany(\common\models\BindEssayTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getUrls()
    {
        $arr = [];
        $arr['search_items_arr'] = ['/tag/search', 'id'=>$this->id];
        $arr['search_items'] = Url::to($arr['search_items_arr']);
        $arr['search_items_show_name'] = Html::a($this->name, $arr['search_items'], ['style' => ['margin-right'=>'1em'], 'class'=>"btn btn-default btn-xs"]);
        return $arr;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'updated_by']);
    }
}