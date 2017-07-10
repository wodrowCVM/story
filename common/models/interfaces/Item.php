<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-6
 * Time: 下午1:21
 */

namespace common\models\interfaces;


interface Item
{
//    public static function getListUrl();
//    public function getUrl();
    public function getCreatedBy();
    public function getUpdatedBy();
}