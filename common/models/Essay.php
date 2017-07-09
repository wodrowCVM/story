<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 上午10:17
 */

namespace common\models;


use common\components\rewrite\mootensai\relation\RelationTrait;

/**
 * Class Essay
 * @package common\models
 *
 * @property \common\models\BindEssayTag[] $bindEssayTags
 * @property array $urls
 * @property \common\models\User $createdBy
 * @property \common\models\User $updatedBy
 * @property string $tagsShow
 * @property bool $canAdmin
 * @property bool $isYouBuy
 */
class Essay extends \common\models\tables\Essay
{
    use RelationTrait;

    const TYPE_DEFAULT = 10;
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;

    public static function getType()
    {
        return [
            self::TYPE_DEFAULT => '默认',
        ];
    }

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => '已激活',
            self::STATUS_DELETED => '已删除',
            self::STATUS_INACTIVE => '未激活',
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '随笔编号',
            'title' => '标题',
            'desc' => '介绍',
            'content' => '内容',
            'type' => '类型',
            'status' => '状态',
            'need_money' => '所需金币',
            'need_integral' => '所需积分',
            'need_xp' => '所需经验',
            'created_at' => \Yii::t('app', 'Created At'),
            'created_by' => \Yii::t('app', 'Created By'),
            'updated_at' => \Yii::t('app', 'Updated At'),
            'updated_by' => \Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBindEssayTags()
    {
        return $this->hasMany(\common\models\BindEssayTag::className(), ['essay_id' => 'id']);
    }

    public function getUrls()
    {
        $arr = [];
        $arr['view_arr'] = ['/essay/default/view', 'id'=>$this->id];
        $arr['update_arr'] = ['/user/essay/update', 'id'=>$this->id];
        $arr['list_arr'] = ['/essay/default/index'];
        $arr['buy_arr'] = ['/user/essay/buy', 'id'=>$this->id];
        return $arr;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEssays()
    {
        return $this->hasMany(\common\models\tables\UserEssay::className(), ['essay_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBies()
    {
        return $this->hasMany(User::className(), ['id' => 'created_by'])->viaTable('{{%user_essay}}', ['essay_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getTagsShow()
    {
        $str = '';
        foreach ($this->bindEssayTags as $k => $v){
            $str .= $v->tag->urls['search_items_show_name'];
        }
        return $str;
    }

    /**
     * @return bool
     */
    public function getCanAdmin()
    {
        if (\Yii::$app->user->isAdmin){
            return true;
        }
        if ($this->created_by == \Yii::$app->user->id){
            return true;
        }else{
            return false;
        }
    }

    public function getIsYouBuy()
    {
        if (UserEssay::findOne(['created_by'=>\Yii::$app->user->id, 'essay_id'=>$this->id, 'status'=>self::STATUS_ACTIVE])){
            return true;
        }else{
            return false;
        }
    }
}