<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\Essay */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Essays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="essay-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Essay'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id',
        'title',
        'desc',
        'content:ntext',
        'type',
        'status',
        'need_money',
        'need_integral',
        'need_xp',
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
                'attribute' => 'tag.id',
                'label' => 'Tag'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBindEssayTag,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Bind Essay Tag'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnBindEssayTag
    ]);
}
?>
    </div>
</div>
