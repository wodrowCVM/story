<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Tag $tag
 * @var \common\models\ItemTag $item_tags
 * @var \yii\data\Pagination $pages
 */
$this->title = '标签搜索';
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('所有标签', $tag->urls['list_arr'], []);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tag-default-search">
    <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-7">
            <div class="row">
                <div class="items">
                    <?php foreach($item_tags as $k => $v): ?>
                        <div class="col-sm-12 item-list">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="item-head">
                                        <h3><?=\yii\helpers\Html::a($v->item->title, $v->item->urls['view_arr'], []) ?></h3>
                                    </div>
                                    <div class="item-foot">
                                        <small>
                                            <?=\kartik\icons\Icon::show('user') ?> 发布者: <?=$v->item->createdBy->urls['info_show_username'] ?>
                                            <span style="margin-left: 2em;"></span>
                                            <?=\kartik\icons\Icon::show('calendar') ?> 发布日期: <?=date("Y-m-d", $v->item->created_at) ?>
                                            <span style="margin-left: 2em;"></span>
                                            <?=\kartik\icons\Icon::show('tumblr') ?> 类型: <?=\common\components\nav\Item::getType()[$v->item_type] ?>
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
            <?=$this->render('_hot') ?>
        </div>
    </div>
</div>
