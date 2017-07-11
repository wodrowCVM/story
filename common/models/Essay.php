<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-5
 * Time: 上午10:17
 */

namespace common\models;


use common\components\rewrite\mootensai\relation\RelationTrait;
use common\components\user\xpr\XpRules;
use common\models\interfaces\Item;
use yii\base\ErrorException;

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
class Essay extends \common\models\tables\Essay implements Item
{
    use RelationTrait;

    const TYPE_DEFAULT = 10;
    const STATUS_ACTIVE = 10;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const EVENT_ESSAY_REPLY = 'event_essay_reply';

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

    public function init()
    {
        parent::init();
        $this->on(self::EVENT_ESSAY_REPLY, [$this, 'eventEssayReply']);
    }

    public function rules()
    {
        return [
            [['title', 'desc'], 'trim'],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'need_money', 'need_integral', 'need_xp'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['desc'], 'string', 'max' => 255],
            [['need_money', 'need_integral', 'need_xp'], 'default', 'value' => 0],
            ['title', 'onlyOneForUser'],
            [['title', 'created_by'], 'unique', 'targetAttribute' => ['title', 'created_by'], 'message' => 'The combination of Title and Created By has already been taken.'],
            [['need_integral', 'need_xp'], 'max1000'],
        ];
    }

    public function max1000($attribute, $params)
    {
        if (!$this->getErrors()){
            if (\Yii::$app->user->isAdmin){}else{
                if ($this->isNewRecord&&$this->$attribute>1000){
                    $this->addError($attribute, '你能设置的最大值为1000');
                }
                if (!$this->isNewRecord&&$this->$attribute>1000){
                    if ($this->oldAttributes[$attribute]!=$this->$attribute){
                        $this->addError($attribute, '你能设置的最大值为1000');
                    }
                }
            }
        }
    }

    public function onlyOneForUser($attribute, $params)
    {
        if (!$this->hasErrors()&&$this->isNewRecord){
            $x = self::findOne(['title'=>$this->title, 'created_by'=>\Yii::$app->user->id]);
            if ($x){
                $this->addError($attribute, "你已经创建过该标题的文档!");
            }
        }
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

    public function eventEssayReply()
    {
        $user_alert = new UserAlert();
        $user_alert->title = "你的随笔[{$this->title}]有新的回复";
        $user_alert->to_user = $this->created_by;
        $user_alert->item_type = \common\components\nav\Item::TYPE_ESSAY;
        $user_alert->status = $user_alert::STATUS_UNREAD;
        if ($user_alert->save()){}else{
            throw new ErrorException("提醒保存异常", 1026);
        }
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if ($insert){
                $x = \Yii::$app->user->identity->xps->setRule(XpRules::RULE_CREATE_ESSAY)->run();
                if (!$x){
//                    throw new ErrorException("积分异常", 1025);
                    return false;
                }
                return $x;
            }
            return true;
        }else{
            return false;
        }
    }
}