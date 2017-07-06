<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%bind_essay_tag}}".
 *
 * @property integer $id
 * @property integer $essay_id
 * @property integer $tag_id
 *
 * @property \common\models\tables\Essay $essay
 * @property \common\models\tables\Tag $tag
 */
class BindEssayTag extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['essay_id', 'tag_id'], 'required'],
            [['essay_id', 'tag_id'], 'integer'],
            [['essay_id', 'tag_id'], 'unique', 'targetAttribute' => ['essay_id', 'tag_id'], 'message' => 'The combination of Essay ID and Tag ID has already been taken.']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bind_essay_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'essay_id' => 'Essay ID',
            'tag_id' => 'Tag ID',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEssay()
    {
        return $this->hasOne(\common\models\tables\Essay::className(), ['id' => 'essay_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(\common\models\tables\Tag::className(), ['id' => 'tag_id']);
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
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\tables\activequerys\BindEssayTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\BindEssayTagQuery(get_called_class());
    }
}
