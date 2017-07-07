<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\Essay */

?>
<div class="essay-view">
    <div class="row">
            <?=$model->content ?>
    </div>
    <div class="row">
        <?php
        $gridColumn = [
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy->username,
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>