<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\user\models\UserAuthCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = '授权码列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-auth-code-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('生成授权码', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'code',
        [
            'attribute' => 'bind_user',
//                'label' => 'Bind User',
            'value' => function ($model) {
                if ($model->bindUser) {
                    return $model->bindUser->username;
                } else {
                    return NULL;
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\user\models\User::find()->asArray()->all(), 'id', 'username'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '用户', 'id' => 'grid-user-auth-code-search-bind_user']
        ],
        [
            'attribute'=>'bind_at',
            'format' => ['date', 'php:Y-m-d H:i:s'],
            'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
            'filterWidgetOptions' =>[
                'model'=>$searchModel,
                'attribute'=>'bind_at',
                'presetDropdown'=>TRUE,
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'format'=>'Y-m-d',
                    'opens'=>'left',
                    'locale' => [
                        'cancelLabel' => 'Clear',
                        'format' => 'Y-m-d',
                    ],
                ]
            ],
        ],
        [
            'attribute' => 'created_by',
            'value' => function ($model) {
                return $model->createdBy->username;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\user\models\User::find()->asArray()->all(), 'id', 'username'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '用户', 'id' => 'grid-user-auth-code-search-created_by']
        ],
        [
            'attribute'=>'created_at',
            'format' => ['date', 'php:Y-m-d H:i:s'],
            'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
            'filterWidgetOptions' =>[
                'model'=>$searchModel,
                'attribute'=>'created_at',
                'presetDropdown'=>TRUE,
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'format'=>'Y-m-d',
                    'opens'=>'left',
                    'locale' => [
                        'cancelLabel' => 'Clear',
                        'format' => 'Y-m-d',
                    ],
                ]
            ],
        ],
        [
            'attribute' => 'updated_by',
            'value' => function ($model) {
                return $model->updatedBy->username;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\user\models\User::find()->asArray()->all(), 'id', 'username'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => '用户', 'id' => 'grid-user-auth-code-search-updated_by']
        ],
        [
            'attribute'=>'updated_at',
            'format' => ['date', 'php:Y-m-d H:i:s'],
            'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
            'filterWidgetOptions' =>[
                'model'=>$searchModel,
                'attribute'=>'updated_at',
                'presetDropdown'=>TRUE,
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'format'=>'Y-m-d',
                    'opens'=>'left',
                    'locale' => [
                        'cancelLabel' => 'Clear',
                        'format' => 'Y-m-d',
                    ],
                ]
            ],
        ],
        [
            'class' => \common\components\grid\KEnumColumn::className(),
            'attribute' => 'status',
            'enum' => $searchModel::getStatus(),
        ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user-auth-code']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => '导出所有',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">导出所有数据</li>',
                    ],
                ],
            ]),
        ],
    ]); ?>

</div>
