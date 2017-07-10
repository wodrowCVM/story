<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-10
 * Time: 下午6:15
 */

namespace frontend\modules\essay;


use common\models\EssayReply;
use yii\base\Model;

class EssayReplyForm extends Model
{
    public $essay_id;
    public $content;
    public $code;

    public function attributeLabels()
    {
        return [
            'content'=>"内容",
            'code'=>"验证码",
        ];
    }

    public function rules()
    {
        return [
            ['essay_id', 'required'],
            ['content', 'trim'],
            ['content', 'required'],
            ['content', 'string', 'min'=>10],
            ['code', 'required'],
            ['code', 'captcha'],
        ];
    }

    public function save()
    {
        $essay_reply = new EssayReply();
        $essay_reply->essay_id = $this->essay_id;
        $essay_reply->content = $this->content;
        $essay_reply->status = $essay_reply::STATUS_ACTIVE;
        $x = $essay_reply->save();
        if ($x){
            return $x;
        }else{
            return false;
        }
    }
}