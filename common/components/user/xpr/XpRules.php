<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-10
 * Time: 上午10:25
 */

namespace common\components\user\xpr;


use common\models\interfaces\Item;
use common\models\User;
use common\models\UserSignin;
use yii\base\Component;
use yii\base\ErrorException;

/**
 * Class XpRules
 * @package common\components\user\xpr
 *
 * @property User $user
 * @property Item $item
 * @property array $ruleInfo
 */
class XpRules extends Component
{
    const RULE_CREATE_ESSAY = 'create_essay';
    const RULE_SIGNIN = 'signin';
    const RULE_BUY_ESSAY = 'buy_essay';

    public static function getRuleInfos()
    {
        return [
            self::RULE_SIGNIN => [
                'name' => '签到',
                'xp' => 1,
                'integral' => 1,
                'money' => 0,
                'autoPlus' => 1,
                'maxC' => 10,
            ],
            self::RULE_CREATE_ESSAY => [
                'name' => '创建随笔',
                'xp' => 5,
                'integral' => 5,
                'money' => 0,
            ],
            self::RULE_BUY_ESSAY => [
                'name' => '获取随笔',
            ],
        ];
    }

    public $user;
    public $item;
    public $rule;

    public function setRule($rule)
    {
        $this->rule = $rule;
        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return mixed | array
     * @throws ErrorException
     */
    public function getRuleInfo()
    {
        $rule = $this->rule;
        if (!$this->user) {
            throw new ErrorException('请先登录', 1112);
        }
        if (!$rule) {
            throw new ErrorException('规则名必须有', 1113);
        } else {
            return self::getRuleInfos()[$rule];
        }
    }

    public function run()
    {
        $rule = $this->rule;
        switch ($rule) {
            case self::RULE_SIGNIN:
                return $this->signin();
                break;
            case self::RULE_CREATE_ESSAY:
                return $this->createEssay();
                break;
            case self::RULE_BUY_ESSAY:
                return $this->buyEssay();
                break;
            default:
                throw new ErrorException('没有找到规则名', 1113);
                break;
        }
    }

    public function signin()
    {
        $ruleInfo = $this->getRuleInfo();
        $yesterday_signin = UserSignin::findOne(['created_by' => $this->user->id, 'date' => date("Ymd", NOW_TIME - 86400)]);
        if ($yesterday_signin) {
            $c = $yesterday_signin->c_days + 1;
        } else {
            $c = 1;
        }
        if ($c <= $ruleInfo['maxC']) {
            $add_xp = $ruleInfo['xp'] * $c;
            $add_integral = $ruleInfo['integral'] * $c;
            $add_money = 0;
        } else {
            $add_xp = $ruleInfo['xp'] * $ruleInfo['maxC'];
            $add_integral = $ruleInfo['integral'] * $ruleInfo['maxC'];
            $add_money = 0;
        }
        $this->user->integral = $this->user->integral + $add_integral;
        $this->user->xp = $this->user->xp + $add_xp;
        $this->user->money = $this->user->money + $add_money;
        $x = $this->user->save();
        if ($x){
            \Yii::$app->session->setFlash('success', "签到成功，你已连续签到{$c}天，获取经验值{$add_xp}，积分{$add_integral}，金币{$add_money}。");
            return $x;
        }else{
            return false;
        }
    }

    public function createEssay()
    {
        $ruleInfo = $this->getRuleInfo();
        $this->user->integral = $this->user->integral + $ruleInfo['integral'];
        $this->user->xp = $this->user->xp + $ruleInfo['xp'];
        $this->user->money = $this->user->money + $ruleInfo['money'];
        $x = $this->user->save();
        if ($x){
            \Yii::$app->session->setFlash('success', "创建随笔成功，获取经验值{$ruleInfo['xp']}，积分{$ruleInfo['integral']}，金币{$ruleInfo['money']}");
            return $x;
        }else{
            \Yii::$app->session->setFlash('error', "积分异常");
            return false;
        }
    }

    public function buyEssay()
    {
        if ($this->user->xp < $this->item->need_xp) {
            \Yii::$app->session->setFlash('error', '经验不足！');
            return false;
        } else {
            $item_user = $this->item->createdBy;
            $user = $this->user;
            $user->integral = $user->integral - $this->item->need_integral;
            $user->money = $user->money - $this->item->need_money;
            $item_user->integral = $item_user->integral + $this->item->need_integral;
            $item_user->money = $item_user->money + $this->item->need_money;
            if ($user->save() && $item_user->save()) {
                \Yii::$app->session->setFlash('success', "获取成功！消耗积分{$this->item->need_integral}，金币{$this->item->need_money}。");
                return true;
            } else {
                $user->integral = $user->integral + $this->item->need_integral;
                $user->money = $user->money + $this->item->need_money;
                return false;
            }
        }
    }
}