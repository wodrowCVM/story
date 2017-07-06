<?php

namespace common\models\tables\activequerys;

/**
 * This is the ActiveQuery class for [[\common\models\tables\activequerys\UserSignin]].
 *
 * @see \common\models\tables\activequerys\UserSignin
 */
class UserSigninQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\UserSignin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\UserSignin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}