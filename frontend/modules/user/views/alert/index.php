<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\EssaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var \common\models\UserAlert[] $user_alerts
 * @var \yii\data\Pagination $pages
 */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = '我的提醒';
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['/user']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-alert-index">
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <caption><?=$this->title ?></caption>
                <thead>
                <tr>
                    <th>状态</th>
                    <th>标题</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($user_alerts as $k => $v): ?>
                    <?php
                    switch ($v->status){
                        case $v::STATUS_UNREAD:
                            $c = "danger";
                            break;
                        default:
                            $c = "default";
                            break;
                    }
                    ?>
                    <tr class="<?=$c ?>">
                        <td><?=$v::getStatus()[$v->status] ?></td>
                        <td><?=$v->title ?></td>
                        <td>
                            <?=Html::a('查看', $v->urls['view_arr']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12">
            <?php if ($pages->totalCount > $pages->pageSize): ?>
                <div class="pages">
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'maxButtonCount' => 10, //控制每页显示的页数
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
