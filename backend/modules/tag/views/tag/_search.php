<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\tag\models\TagSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-tag-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->textInput(['placeholder' => 'Id']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true, 'placeholder' => 'Desc']) ?>

    <?= $form->field($model, 'type')->textInput(['placeholder' => 'Type']) ?>

    <?= $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

    <?php /* echo $form->field($model, 'created_at')->textInput(['placeholder' => 'Created At']) */ ?>

    <?php /* echo $form->field($model, 'created_by')->textInput(['placeholder' => 'Created By']) */ ?>

    <?php /* echo $form->field($model, 'updated_at')->textInput(['placeholder' => 'Updated At']) */ ?>

    <?php /* echo $form->field($model, 'updated_by')->textInput(['placeholder' => 'Updated By']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
