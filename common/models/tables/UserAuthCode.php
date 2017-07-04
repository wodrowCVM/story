<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "{{%user_auth_code}}".
 *
 * @property integer $id
 * @property string $code
 * @property integer $bind_user
 * @property integer $bind_at
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $status
 *
 * @property User $bindUser
 * @property User $createdBy
 * @property User $updatedBy
 */
class UserAuthCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_auth_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['bind_user', 'bind_at', 'created_by', 'created_at', 'updated_by', 'updated_at', 'status'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['bind_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['bind_user' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'bind_user' => 'Bind User',
            'bind_at' => 'Bind At',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindUser()
    {
        return $this->hasOne(User::className(), ['id' => 'bind_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
