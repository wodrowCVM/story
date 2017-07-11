<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-11
 * Time: 上午10:16
 */

namespace common\components\nav;


use yii\base\Component;

class Item extends Component
{
    const TYPE_ESSAY = 10;

    public static function getType()
    {
        return [
            self::TYPE_ESSAY => '随笔',
        ];
    }
}