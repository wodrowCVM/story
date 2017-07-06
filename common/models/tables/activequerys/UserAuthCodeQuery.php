<?php

namespace common\models\tables\activequerys;

/**
 * This is the ActiveQuery class for [[\common\models\tables\activequerys\UserAuthCode]].
 *
 * @see \common\models\tables\activequerys\UserAuthCode
 */
class UserAuthCodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\UserAuthCode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\UserAuthCode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}