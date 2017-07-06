<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\tag\models\Tag */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Tag'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
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
        'name',
        'desc',
        'type',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerBindEssayTag->totalCount){
    $gridColumnBindEssayTag = [
        ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'essay.id',
                'label' => 'Essay'
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerBindEssayTag,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-bind-essay-tag']],
        'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Bind Essay Tag'),
        ],
        'columns' => $gridColumnBindEssayTag
    ]);
}
?>
    </div>
</div>