<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-4
 * Time: 上午10:02
 */

namespace common\models;


class UserAuthCode extends \common\models\tables\UserAuthCode
{
    const STATUS_DELETE = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => '已激活',
            self::STATUS_DELETE => '已删除',
            self::STATUS_INACTIVE => '未激活',
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'code' => '授权码',
            'bind_user' => '绑定的用户',
            'bind_at' => '绑定时间',
            'created_by' => '创建人',
            'created_at' => '创建时间',
            'updated_by' => '修改人',
            'updated_at' => '修改时间',
            'status' => '状态',
        ];
    }
}