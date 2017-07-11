<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%item_tag}}".
 *
 * @property string $title
 * @property integer $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $need_money
 * @property integer $need_integral
 * @property integer $need_xp
 * @property integer $tag_id
 * @property string $tag_name
 * @property integer $item_type
 * @property integer $item_id
 */
class ItemTag extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'created_by', 'updated_at', 'updated_by', 'tag_name'], 'required'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'need_money', 'need_integral', 'need_xp', 'tag_id', 'item_type', 'item_id'], 'integer'],
            [['title', 'tag_name'], 'string', 'max' => 50]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
            'need_money' => Yii::t('app', 'Need Money'),
            'need_integral' => Yii::t('app', 'Need Integral'),
            'need_xp' => Yii::t('app', 'Need Xp'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'tag_name' => Yii::t('app', 'Tag Name'),
            'item_type' => Yii::t('app', 'Item Type'),
            'item_id' => Yii::t('app', 'Item ID'),
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\ItemTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\ItemTagQuery(get_called_class());
    }
}
