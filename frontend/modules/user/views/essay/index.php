<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\EssaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = '我的随笔';
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['/user']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="essay-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('创建随笔', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('已获取的随笔', ['get-buy'], ['class' => 'btn btn-info']) ?>
    </p>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        'id',
        'title',
        'desc',
        [
            'class' => \common\components\grid\KEnumColumn::className(),
            'attribute' => 'type',
            'enum' => $searchModel::getType(),
        ],
        [
            'class' => \common\components\grid\KEnumColumn::className(),
            'attribute' => 'status',
            'enum' => $searchModel::getStatus(),
        ],
        'need_money',
        'need_integral',
        'need_xp',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {link}',
            'buttons' => [
                'link' => function($url, $model, $key){
                    return \yii\helpers\Html::a(\kartik\icons\Icon::show('link'), $model->urls['view_arr'], [
                        'class' => 'data-view',
                        'data-id' => $key,
                        'title' => '在前台查看',
                    ]);
                },
            ],
        ],
//        'createdBy.username',
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-essay']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => '全部',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">导出所有内容</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
