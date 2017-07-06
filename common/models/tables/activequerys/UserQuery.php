<?php

namespace common\models\tables\activequerys;

/**
 * This is the ActiveQuery class for [[\common\models\tables\activequerys\User]].
 *
 * @see \common\models\tables\activequerys\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}