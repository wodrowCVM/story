<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserAuthCode */

$this->title = "授权码:".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Auth Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-auth-code-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?=Html::encode($this->title)."详细" ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?php // Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?php echo Html::a('返回列表', ['index'], ['class' => 'btn btn-info']) ?>
            <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
        'code',
        [
            'attribute' => 'bindUser.username',
            'label' => '绑定用户',
        ],
        'bind_at:datetime',
        [
            'attribute' => 'createdBy.username',
            'label' => '创建人',
        ],
        'created_at:datetime',
        [
            'attribute' => 'updatedBy.username',
            'label' => '修改人',
        ],
        'updated_at:datetime',
        [
            'attribute' => 'status',
            'value' => function($model){
                return $model::getStatus()[$model->status];
            }
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
