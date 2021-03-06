<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-11
 * Time: 上午9:45
 */

namespace common\models;

use common\components\nav\Item;
use yii\helpers\Url;

/**
 * Class UserAlert
 * @package common\models
 *
 * @property array $urls
 */
class UserAlert extends \common\models\tables\UserAlert
{
    const STATUS_UNREAD = 10;
    const STATUS_READ = 11;

    public static function getStatus()
    {
        return [
            self::STATUS_UNREAD => '未读',
            self::STATUS_READ => '已读',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'to_user'], 'required'],
            [['created_by', 'created_at', 'status', 'updated_by', 'updated_at', 'to_user'], 'integer'],
            [['content', 'other_data'], 'string'],
            [['title'], 'string', 'max' => 200]
        ];
    }

    public function getUrls()
    {
        $arr = [];
        $arr['view_arr'] = ['/user/alert/to-link', 'id'=>$this->id];
        $arr['view'] = Url::to($arr['view_arr']);
        $arr['list_arr'] = ['/user/alert/index'];
        $arr['list'] = Url::to($arr['list_arr']);
        if ($this->item_type==Item::TYPE_ESSAY){
            $essay = Essay::findOne($this->item_id);
            $arr['item_arr'] = $essay->urls['view_arr'];
        }
        return $arr;
    }
}