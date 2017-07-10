<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-6
 * Time: 下午1:21
 */

namespace common\models\interfaces;

use common\models\User;

/**
 * Interface Item
 * @package common\models\interfaces
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
interface Item
{
//    public static function getListUrl();
//    public function getUrl();
    public function getCreatedBy();
    public function getUpdatedBy();
}