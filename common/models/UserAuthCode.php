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
    const STATUS_ACTIVE = 10;

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