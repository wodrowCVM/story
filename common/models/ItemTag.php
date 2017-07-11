<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-11
 * Time: 下午1:47
 */

namespace common\models;


use common\components\nav\Item;
use yii\base\ErrorException;
use yii\db\ActiveRecord;

/**
 * Class ItemTag
 * @package common\models
 *
 * @property ActiveRecord $item
 */
class ItemTag extends \common\models\tables\ItemTag
{
    /**
     * @return ActiveRecord $item
     */
    public function getItem()
    {
        switch ($this->item_type){
            case Item::TYPE_ESSAY:
                $item = Essay::findOne($this->item_id);
                break;
            default:
                throw new ErrorException('没有找到主题', 1027);
                break;
        }
        return $item;
    }
}