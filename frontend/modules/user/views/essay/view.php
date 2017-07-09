<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\Essay */

$this->title = "随笔详细[" . $model->title . "]";
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['/user']];
$this->params['breadcrumbs'][] = ['label' => '随笔列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="essay-view">
    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            'id',
            'title',
            'desc',
            [
                'attribute' => 'type',
                'value' => $model::getType()[$model->type],
            ],
            [
                'attribute' => 'status',
                'value' => $model::getType()[$model->status],
            ],
            'need_money',
            'need_integral',
            'need_xp',
            [
                'label' => '标签',
                'value' => $model->tagsShow,
                'format' => 'raw',
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
    <div class="row">
        <?=$model->content ?>
    </div>
    <div class="row">
        <?php
        /*if ($providerBindEssayTag->totalCount) {
            $gridColumnBindEssayTag = [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'tag.id',
                'tag.name',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerBindEssayTag,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-bind-essay-tag']],
                'panel' => [
                    'type' => GridView::TYPE_DEFAULT,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('标签'),
                    'options' => [
                        'class' => 'hidden',
                    ],
                    'class' => 'hidden',
                ],
                'columns' => $gridColumnBindEssayTag,
            ]);
        }*/
        ?>
    </div>
</div>