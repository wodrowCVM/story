<?php

namespace common\models\tables;

/**
 * This is the ActiveQuery class for [[UserAuthCode]].
 *
 * @see UserAuthCode
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
     * @return UserAuthCode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserAuthCode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}