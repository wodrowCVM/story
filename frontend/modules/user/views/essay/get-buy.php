<?php
/* @var $this yii\web\View */
/* @var common\models\UserEssay[] $user_essays */
/**
 * @var \yii\data\Pagination $pages
 */

$this->title = "已经获取的随笔";
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['/user']];
$this->params['breadcrumbs'][] = ['label' => '随笔列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="essay-default-get-buy">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="items">
                    <?php foreach($user_essays as $k => $v): ?>
                        <div class="col-sm-12 item-list">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="item-head">
                                        <h3><?=\yii\helpers\Html::a($v->essay->title, $v->essay->urls['view_arr'], []) ?></h3>
                                    </div>
                                    <div class="item-body">
                                        <p><?=$v->essay->desc ?></p>
                                    </div>
                                    <div class="item-foot">
                                        <small>
                                            <?=\kartik\icons\Icon::show('user') ?> 发布者: <?=$v->essay->createdBy->urls['info_show_username'] ?>
                                            <span style="margin-left: 2em;"></span>
                                            <?=\kartik\icons\Icon::show('calendar') ?> 发布日期: <?=date("Y-m-d", $v->essay->created_at) ?>
                                            <span style="margin-left: 2em;"></span>
                                            <?=\kartik\icons\Icon::show('comment') ?> 评论: <code>0</code>条
                                        </small>
                                        <small class="pull-right">
                                            <?php if($v->essay->isYouBuy||$v->essay->created_by==Yii::$app->user->id){ ?>
                                                <?=\yii\bootstrap\Html::a('阅读', $v->essay->urls['view_arr'], ['class'=>"btn btn-default btn-xs"]) ?>
                                            <?php }else{ ?>
                                                <?=\yii\bootstrap\Html::a('获取', $v->essay->urls['buy_arr'], ['class'=>"btn btn-default btn-xs"]) ?>
                                            <?php }; ?>
                                            <?=$v->essay->canAdmin?\yii\bootstrap\Html::a('修改', $v->essay->urls['update_arr'], ['class'=>"btn btn-default btn-xs"]):'' ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="pages">
                    <?=\yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'maxButtonCount' => 10, //控制每页显示的页数
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
