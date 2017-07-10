<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Essay[] $essays
 * @var \yii\data\Pagination $pages
 */
$this->title = "随笔列表";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="essay-default-index">
    <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-7">
            <div class="row">
                <div class="items">
                    <?php foreach($essays as $k => $v): ?>
                        <div class="col-sm-12 item-list">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="item-head">
                                        <h3><?=\yii\helpers\Html::a($v->title, $v->urls['view_arr'], []) ?></h3>
                                    </div>
                                    <div class="item-body">
                                        <p><?=$v->desc ?></p>
                                    </div>
                                    <div class="item-foot">
                                        <small>
                                            <?=\kartik\icons\Icon::show('user') ?> 发布者: <?=$v->createdBy->urls['info_show_username'] ?>
                                            <span style="margin-left: 2em;"></span>
                                            <?=\kartik\icons\Icon::show('calendar') ?> 发布日期: <?=date("Y-m-d", $v->created_at) ?>
                                            <span style="margin-left: 2em;"></span>
                                            <?=\kartik\icons\Icon::show('comment') ?> 评论: <code>0</code>条
                                        </small>
                                        <small class="pull-right">
                                            <?php if($v->isYouBuy||$v->created_by==Yii::$app->user->id){ ?>
                                                <?=\yii\bootstrap\Html::a('阅读', $v->urls['view_arr'], ['class'=>"btn btn-default btn-xs"]) ?>
                                            <?php }else{ ?>
                                                <?=\yii\bootstrap\Html::a('获取', $v->urls['buy_arr'], ['class'=>"btn btn-default btn-xs"]) ?>
                                            <?php }; ?>
                                            <?=$v->canAdmin?\yii\bootstrap\Html::a('修改', $v->urls['update_arr'], ['class'=>"btn btn-default btn-xs"]):'' ?>
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
        <div class="col-lg-3 col-md-4 col-sm-5">
            <?=$this->render('_state') ?>
        </div>
    </div>
</div>
