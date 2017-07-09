<?php

namespace common\models\tables\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%essay}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $content
 * @property integer $type
 * @property integer $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $need_money
 * @property integer $need_integral
 * @property integer $need_xp
 *
 * @property \common\models\tables\BindEssayTag[] $bindEssayTags
 * @property \common\models\tables\User $createdBy
 * @property \common\models\tables\User $updatedBy
 * @property \common\models\tables\UserEssay[] $userEssays
 */
class Essay extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['content'], 'string'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'need_money', 'need_integral', 'need_xp'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255],
            [['title', 'created_by'], 'unique', 'targetAttribute' => ['title', 'created_by'], 'message' => 'The combination of Title and Created By has already been taken.']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%essay}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'content' => Yii::t('app', 'Content'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'need_money' => Yii::t('app', 'Need Money'),
            'need_integral' => Yii::t('app', 'Need Integral'),
            'need_xp' => Yii::t('app', 'Need Xp'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindEssayTags()
    {
        return $this->hasMany(\common\models\tables\BindEssayTag::className(), ['essay_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'created_by']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\tables\User::className(), ['id' => 'updated_by']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEssays()
    {
        return $this->hasMany(\common\models\tables\UserEssay::className(), ['essay_id' => 'id']);
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
     * @return \common\models\tables\activequerys\EssayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\tables\activequerys\EssayQuery(get_called_class());
    }
}
