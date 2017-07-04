<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\UserAuthCode */

?>
<div class="user-auth-code-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id',
        'code',
        [
            'attribute' => 'bindUser.id',
            'label' => 'Bind User',
        ],
        'bind_at',
        [
            'attribute' => 'createdBy.id',
            'label' => 'Created By',
        ],
        'created_at',
        [
            'attribute' => 'updatedBy.id',
            'label' => 'Updated By',
        ],
        'updated_at',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>